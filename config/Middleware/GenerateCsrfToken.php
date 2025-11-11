<?php
namespace Middleware;
class GenerateCsrfToken {
// Générer un jeton CSRF
static function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
}