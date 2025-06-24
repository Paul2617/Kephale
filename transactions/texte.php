<?php
require_once 'config.php';
secure_session_start();
header('Content-Type: application/json');

$response = ['success' => false, 'message' => '', 'errors' => []];
$pdo = getDBConnection();

// Vérifier l'authentification
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    $response['message'] = 'Non autorisé';
    echo json_encode($response);
    exit;
}

// Récupérer l'utilisateur courant
$current_user_id = $_SESSION['user_id'];

// Vérifier le token CSRF pour les requêtes POST/PUT/DELETE
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    $csrf_token = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (!validateCSRFToken($csrf_token)) {
        http_response_code(403);
        $response['message'] = 'Token CSRF invalide ou expiré';
        echo json_encode($response);
        exit;
    }
}

// Enregistrer une tentative de transaction dans les logs
function logTransactionAttempt($pdo, $user_id, $action, $details = '', $transaction_id = null) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    
    $stmt = $pdo->prepare("
        INSERT INTO transaction_security_logs 
        (transaction_id, user_id, action_type, details, ip_address) 
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([$transaction_id, $user_id, $action, $details, $ip]);
}

// Effectuer une transaction
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'transfer') {
    // Validation des données
    $receiver_identifier = trim($_POST['receiver'] ?? '');
    $amount = filter_var($_POST['amount'] ?? 0, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $description = substr(trim($_POST['description'] ?? ''), 0, 255);
    
    // Validation des entrées
    if (empty($receiver_identifier)) {
        $response['errors']['receiver'] = 'Destinataire requis';
    }
    
    if (!is_numeric($amount) || $amount <= 0) {
        $response['errors']['amount'] = 'Montant invalide';
    } elseif ($amount < MIN_TRANSACTION_AMOUNT) {
        $response['errors']['amount'] = 'Le montant minimum est '.MIN_TRANSACTION_AMOUNT;
    } elseif ($amount > MAX_TRANSACTION_AMOUNT) {
        $response['errors']['amount'] = 'Le montant maximum est '.MAX_TRANSACTION_AMOUNT;
    }
    
    // Vérifier le solde de l'utilisateur
    $transaction_fee = $amount * TRANSACTION_FEE_RATE;
    $total_debit = $amount + $transaction_fee;
    
    $stmt = $pdo->prepare("SELECT balance FROM users WHERE id = ?");
    $stmt->execute([$current_user_id]);
    $sender = $stmt->fetch();
    
    if ($sender['balance'] < $total_debit) {
        $response['errors']['amount'] = 'Solde insuffisant';
    }
    
    // Trouver le destinataire
    $stmt = $pdo->prepare("
        SELECT id FROM users 
        WHERE (username = ? OR email = ?) AND id != ? AND is_active = TRUE
    ");
    $stmt->execute([$receiver_identifier, $receiver_identifier, $current_user_id]);
    $receiver = $stmt->fetch();
    
    if (!$receiver) {
        $response['errors']['receiver'] = 'Destinataire invalide ou inactif';
    }
    
    // Si aucune erreur, procéder à la transaction
    if (empty($response['errors'])) {
        $pdo->beginTransaction();
        
        try {
            // Générer une référence unique
            $reference = uniqid('TRX').bin2hex(random_bytes(4));
            
            // Créer la transaction
            $stmt = $pdo->prepare("
                INSERT INTO transactions 
                (sender_id, receiver_id, amount, transaction_fee, status, description, reference, ip_address, user_agent) 
                VALUES (?, ?, ?, ?, 'pending', ?, ?, ?, ?)
            ");
            $stmt->execute([
                $current_user_id,
                $receiver['id'],
                $amount,
                $transaction_fee,
                $description,
                $reference,
                $_SERVER['REMOTE_ADDR'],
                $_SERVER['HTTP_USER_AGENT'] ?? ''
            ]);
            $transaction_id = $pdo->lastInsertId();
            
            // Débiter le compte de l'expéditeur
            $stmt = $pdo->prepare("
                UPDATE users SET balance = balance - ? 
                WHERE id = ? AND balance >= ?
            ");
            $stmt->execute([$total_debit, $current_user_id, $total_debit]);
            
            if ($stmt->rowCount() === 0) {
                throw new Exception("Échec du débit - Solde insuffisant");
            }
            
            // Créditer le compte du destinataire
            $stmt = $pdo->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
            $stmt->execute([$amount, $receiver['id']]);
            
            // Marquer la transaction comme complétée
            $stmt = $pdo->prepare("UPDATE transactions SET status = 'completed' WHERE id = ?");
            $stmt->execute([$transaction_id]);
            
            $pdo->commit();
            
            $response['success'] = true;
            $response['message'] = 'Transaction effectuée avec succès';
            $response['transaction_id'] = $transaction_id;
            $response['reference'] = $reference;
            
            logTransactionAttempt($pdo, $current_user_id, 'transfer_success', "Montant: $amount", $transaction_id);
            
        } catch (Exception $e) {
            $pdo->rollBack();
            
            // Enregistrer l'échec de la transaction
            if (isset($transaction_id)) {
                $stmt = $pdo->prepare("UPDATE transactions SET status = 'failed' WHERE id = ?");
                $stmt->execute([$transaction_id]);
            }
            
            $response['message'] = 'Échec de la transaction: '.$e->getMessage();
            logTransactionAttempt($pdo, $current_user_id, 'transfer_failed', $e->getMessage(), $transaction_id ?? null);
        }
    }
}

// Récupérer l'historique des transactions
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'history') {
    $page = max(1, intval($_GET['page'] ?? 1));
    $limit = 10;
    $offset = ($page - 1) * $limit;
    
    try {
        // Transactions envoyées
        $stmt = $pdo->prepare("
            SELECT t.*, u.username as receiver_username 
            FROM transactions t
            JOIN users u ON t.receiver_id = u.id
            WHERE t.sender_id = ?
            ORDER BY t.created_at DESC
            LIMIT ? OFFSET ?
        ");
        $stmt->execute([$current_user_id, $limit, $offset]);
        $sent_transactions = $stmt->fetchAll();
        
        // Transactions reçues
        $stmt = $pdo->prepare("
            SELECT t.*, u.username as sender_username 
            FROM transactions t
            JOIN users u ON t.sender_id = u.id
            WHERE t.receiver_id = ?
            ORDER BY t.created_at DESC
            LIMIT ? OFFSET ?
        ");
        $stmt->execute([$current_user_id, $limit, $offset]);
        $received_transactions = $stmt->fetchAll();
        
        $response['success'] = true;
        $response['sent'] = $sent_transactions;
        $response['received'] = $received_transactions;
        
    } catch (Exception $e) {
        $response['message'] = 'Erreur lors de la récupération de l\'historique';
    }
}

echo json_encode($response);