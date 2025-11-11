<?php
namespace NewClass;
use Lib\Data;
use Abonnement\Boutique;
use PDO;
class Transaction
{

    protected static $cle = 261700;
    protected static function data()
    {
        return Data::data();
    }
    static public function TransactionAbonnement(int $balance, string $device, string $typeAbonnement)
    {
        $id = $_SESSION['id'];
        $id_debiter = $_SESSION['id'];
        $id_crediter = self::$cle;
        $data = self::data();
        $cle = self::$cle;
        $debut = time();
        $fin = $debut + (31 * 24 * 60 * 60); // 31 jour
        try {
            $data->beginTransaction();
            $sql_user = "UPDATE user_portefeuille SET balance = balance - ? WHERE id_user = ? ";
            // Sécurisation : utilisation de paramètre lié pour éviter l'injection SQL
            $sql_kephale = "UPDATE kephale_balance SET balance = balance + ? WHERE cle = ? AND device = ?";
            $sql_transactins = "INSERT INTO transactions ( id_debiter, id_crediter, motif, balance, devise) VALUES (?, ?, ?, ?, ?)";
            $sql_user_transaction = "INSERT INTO user_transaction ( id_user, id_transaction) VALUES (?, ?)";
            $sql_abonnement_facture = "INSERT INTO abonnement_facture ( id_transaction, id_user, type_abonnement, debut, fin) VALUES (?, ?, ?, ?, ?)";
            $boutique = "INSERT INTO boutique (id_user, nom, img_profile, img_couverture) VALUES (?,?,?,?)";
            $boutique_portefeuille = "INSERT INTO boutique_portefeuille (id_boutique) VALUES (?)";
            $stmt = $data->prepare($sql_user);
            $stmt_ = $data->prepare($sql_kephale);
            $stmt_transactins = $data->prepare($sql_transactins);
            $stmt_user_transaction = $data->prepare($sql_user_transaction);
            $stmt_abonnement_facture = $data->prepare($sql_abonnement_facture);
            $stmt_boutique = $data->prepare($boutique);
            $stmt_boutique_portefeuille = $data->prepare($boutique_portefeuille);
            $execute = $stmt->execute(array($balance, $id));
            $execute = $stmt_->execute(array($balance, $cle, $device));
            $execute = $stmt_transactins->execute(array($id_debiter, $id_crediter, 'Abonnement', $balance, $device));
            $transactionId = $data->lastInsertId();
            $execute = $stmt_user_transaction->execute(array($id, $transactionId));
            $execute = $stmt_abonnement_facture->execute(array($transactionId, $id, $typeAbonnement, $debut, $fin));
            $execute = $stmt_boutique->execute(array($id, 'nom', 'img_profile', 'img_couverture'));
            $boutique_Id = $data->lastInsertId();
            $execute = $stmt_boutique_portefeuille->execute(array($boutique_Id));
            if ($execute === false) {
                $data->rollBack();
                return false;
            }
            $data->commit();
            return true;
        } catch (Exception $e) {
            $data->rollBack();
            return false;
        }
    }

    static public function TransactionAchatProduit(int $totale, int $quantite, string $device, int $id_boutique, int $id_produit, int $id_varient, string $type_abonnement)
    {
        $data = self::data();
        $id = $_SESSION['id'];
        $id_debiter = $_SESSION['id'];
        $id_crediter = $id_boutique;
        $motif = 'Achats produit';
        $cle = self::$cle;
        $Boutique = Boutique::infoOffre($type_abonnement);
        if ($Boutique !== false) {
            $reduction = $Boutique['poursantage'];
            $prix_final_boutique = $totale - ($totale * $reduction / 100);
            $valeur = ($totale * $reduction) / 100;
        } else {
            return false;
        }
        try {
            $data->beginTransaction();
            $sql_user = "UPDATE user_portefeuille SET balance = balance - ? WHERE id_user = ? ";
            // Sécurisation : utilisation de paramètre lié pour éviter l'injection SQL
            $sql_boutique = "UPDATE boutique_portefeuille SET balance = balance + ? WHERE id_boutique = ? AND devise = ?";
            $sql_transactins = "INSERT INTO transactions ( id_debiter, id_crediter, motif, balance, devise) VALUES (?, ?, ?, ?, ?)";
            $sql_user_transaction = "INSERT INTO user_transaction ( id_user, id_transaction) VALUES (?, ?)";
            $sql_boutique_transaction = "INSERT INTO boutique_transaction ( id_boutique, id_transaction) VALUES (?, ?)";
            $sql_achat = "INSERT INTO liste_achat (id_boutique, id_user, id_transaction, id_produit, id_variants, quantite) VALUES (?,?,?,?,?,?)";
            $sql_variants = "UPDATE product_variants SET stock_qty = stock_qty - ? WHERE id = ? ";
            // Sécurisation : utilisation de paramètre lié pour éviter l'injection SQL
            $sql_kephale = "UPDATE kephale_balance SET balance = balance + ? WHERE cle = ? AND device = ?";
            $sql_kephale_entre = "INSERT INTO kephale_entre ( id_balance, id_transaction, balance) VALUES (?, ?, ?)";
            

            $stmt_user = $data->prepare($sql_user);
            $stmt_boutique = $data->prepare($sql_boutique);
            $stmt_transactins = $data->prepare($sql_transactins);
            $stmt_user_transaction = $data->prepare($sql_user_transaction);
            $stmt_boutique_transaction = $data->prepare($sql_boutique_transaction);
            $stmt_achat = $data->prepare($sql_achat);
            $stmt_variants = $data->prepare($sql_variants);
            $stmt_kephale = $data->prepare($sql_kephale);
            $stmt_kephale_entre = $data->prepare($sql_kephale_entre);

            $execute = $stmt_user->execute(array($totale, $id));
            $execute = $stmt_boutique->execute(array($prix_final_boutique, $id_boutique, $device));
            $execute = $stmt_transactins->execute(array($id_debiter, $id_crediter, $motif, $totale, $device));
            $transactionId = $data->lastInsertId();
            $execute = $stmt_user_transaction->execute(array($id, $transactionId));
            $execute = $stmt_boutique_transaction->execute(array($id_boutique, $transactionId));
            $execute = $stmt_achat->execute(array($id_boutique, $id, $transactionId, $id_produit, $id_varient, $quantite));
            $execute = $stmt_variants->execute(array($quantite, $id_varient));
            $execute = $stmt_kephale->execute(array($valeur, $cle, $device));
            $execute = $stmt_kephale_entre->execute(array( 1, $transactionId, $valeur));

            if ($execute === false) {
                $data->rollBack();
                return false;
            }
            $data->commit();
            return true;
        } catch (Exception $e) {
            $data->rollBack();
            return false;
        }
    }
}