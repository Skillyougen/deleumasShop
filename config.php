<?php
// ============================================
// DELEUMASSHOP — Configuration Base de Données
// ============================================
// ⚠️ ZONES DE CONNEXION IMPORTANTES :
// Modifiez les 4 constantes ci-dessous
// ============================================

define('DB_HOST', 'db52861.databaseasp.net');         // ← Adresse serveur MySQL
define('DB_NAME', 'db52861');   // ← Nom de la base de données
define('DB_USER', 'db52861');              // ← Utilisateur MySQL
define('DB_PASS', 'f!5H6mT#s?3J');                  // ← Mot de passe MySQL
define('DB_CHARSET', 'utf8mb4');

function getDB() {
    static $pdo = null;
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
            $pdo = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die(json_encode(['error' => 'Connexion base de données échouée.']));
        }
    }
    return $pdo;
}

if (session_status() === PHP_SESSION_NONE) {
    $isHttps = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
    session_set_cookie_params(['lifetime'=>86400,'path'=>'/','secure'=>$isHttps,'httponly'=>true,'samesite'=>'Lax']);
    session_start();
}

function isAdminLoggedIn() { return isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true; }
function isUserLoggedIn() { return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']); }
function sanitize($v) { return htmlspecialchars(strip_tags(trim($v ?? '')), ENT_QUOTES, 'UTF-8'); }

function enregistrerVisite() {
    try {
        $db = getDB();
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $db->prepare("INSERT INTO visites (ip_address, page) VALUES (?,?)")->execute([$ip, basename($_SERVER['PHP_SELF'],'.php')]);
    } catch (Exception $e) {}
}
?>
