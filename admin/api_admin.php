<?php
// ============================================
// API ADMIN - Gestion produits, catégories, utilisateurs
// ============================================
ob_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config.php';

// Vérification admin obligatoire
if (!isAdminLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Non autorisé', 'redirect' => '../index.php']);
    exit;
}

$action = $_POST['action'] ?? $_GET['action'] ?? '';
$db = getDB();

try {
    switch ($action) {

        // ---- CATÉGORIES ----
        case 'get_categories':
            $stmt = $db->query("SELECT c.*, COUNT(p.id) as nb_produits FROM categories c 
                                LEFT JOIN produits p ON p.categorie_id = c.id 
                                GROUP BY c.id ORDER BY c.ordre ASC, c.nom ASC");
            echo json_encode(['success' => true, 'data' => $stmt->fetchAll()]);
            break;

        case 'create_category':
            $nom = sanitize($_POST['nom'] ?? '');
            $description = sanitize($_POST['description'] ?? '');
            $icone = sanitize($_POST['icone'] ?? 'fa-box');
            if (!$nom) { echo json_encode(['success' => false, 'message' => 'Nom requis']); exit; }
            $stmt = $db->prepare("INSERT INTO categories (nom, description, icone) VALUES (?,?,?)");
            $stmt->execute([$nom, $description, $icone]);
            echo json_encode(['success' => true, 'id' => $db->lastInsertId(), 'message' => 'Catégorie créée']);
            break;

        case 'update_category':
            $id = intval($_POST['id'] ?? 0);
            $nom = sanitize($_POST['nom'] ?? '');
            $description = sanitize($_POST['description'] ?? '');
            $icone = sanitize($_POST['icone'] ?? 'fa-box');
            if (!$id || !$nom) { echo json_encode(['success' => false, 'message' => 'Données invalides']); exit; }
            $stmt = $db->prepare("UPDATE categories SET nom=?, description=?, icone=? WHERE id=?");
            $stmt->execute([$nom, $description, $icone, $id]);
            echo json_encode(['success' => true, 'message' => 'Catégorie mise à jour']);
            break;

        case 'delete_category':
            $id = intval($_POST['id'] ?? 0);
            if (!$id) { echo json_encode(['success' => false, 'message' => 'ID invalide']); exit; }
            $db->prepare("DELETE FROM categories WHERE id=?")->execute([$id]);
            echo json_encode(['success' => true, 'message' => 'Catégorie supprimée (et ses produits)']);
            break;

        // ---- PRODUITS ----
        case 'get_produits':
            $cat_id = intval($_GET['categorie'] ?? 0);
            if ($cat_id > 0) {
                $stmt = $db->prepare("SELECT p.*, c.nom as cat_nom FROM produits p JOIN categories c ON p.categorie_id=c.id WHERE p.categorie_id=? ORDER BY p.ordre ASC, p.nom ASC");
                $stmt->execute([$cat_id]);
            } else {
                $stmt = $db->query("SELECT p.*, c.nom as cat_nom FROM produits p JOIN categories c ON p.categorie_id=c.id ORDER BY c.ordre ASC, p.nom ASC");
            }
            echo json_encode(['success' => true, 'data' => $stmt->fetchAll()]);
            break;

        case 'create_product':
            $nom = sanitize($_POST['nom'] ?? '');
            $cat_id = intval($_POST['categorie_id'] ?? 0);
            $description = sanitize($_POST['description'] ?? '');
            $prix = floatval($_POST['prix'] ?? 0);
            $unite = sanitize($_POST['unite'] ?? 'unité');

            if (!$nom || !$cat_id) { echo json_encode(['success' => false, 'message' => 'Nom et catégorie requis']); exit; }

            // Traitement image
            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $result = uploadImage($_FILES['image']);
                if (isset($result['error'])) {
                    echo json_encode(['success' => false, 'message' => $result['error']]);
                    exit;
                }
                $imagePath = $result['path'];
            }

            $stmt = $db->prepare("INSERT INTO produits (categorie_id, nom, description, image, prix, unite) VALUES (?,?,?,?,?,?)");
            $stmt->execute([$cat_id, $nom, $description, $imagePath, $prix ?: null, $unite]);
            echo json_encode(['success' => true, 'id' => $db->lastInsertId(), 'message' => 'Produit créé avec succès !', 'image' => $imagePath]);
            break;

        case 'update_product':
            $id = intval($_POST['id'] ?? 0);
            $nom = sanitize($_POST['nom'] ?? '');
            $cat_id = intval($_POST['categorie_id'] ?? 0);
            $description = sanitize($_POST['description'] ?? '');
            $prix = floatval($_POST['prix'] ?? 0);
            $unite = sanitize($_POST['unite'] ?? 'unité');

            if (!$id || !$nom) { echo json_encode(['success' => false, 'message' => 'Données invalides']); exit; }

            $imagePath = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $result = uploadImage($_FILES['image']);
                if (isset($result['error'])) {
                    echo json_encode(['success' => false, 'message' => $result['error']]);
                    exit;
                }
                $imagePath = $result['path'];
            }

            if ($imagePath) {
                $stmt = $db->prepare("UPDATE produits SET nom=?, categorie_id=?, description=?, image=?, prix=?, unite=? WHERE id=?");
                $stmt->execute([$nom, $cat_id, $description, $imagePath, $prix ?: null, $unite, $id]);
            } else {
                $stmt = $db->prepare("UPDATE produits SET nom=?, categorie_id=?, description=?, prix=?, unite=? WHERE id=?");
                $stmt->execute([$nom, $cat_id, $description, $prix ?: null, $unite, $id]);
            }
            echo json_encode(['success' => true, 'message' => 'Produit mis à jour']);
            break;

        case 'delete_product':
            $id = intval($_POST['id'] ?? 0);
            if (!$id) { echo json_encode(['success' => false, 'message' => 'ID invalide']); exit; }
            $db->prepare("DELETE FROM produits WHERE id=?")->execute([$id]);
            echo json_encode(['success' => true, 'message' => 'Produit supprimé']);
            break;

        // ---- UTILISATEURS ----
        case 'get_utilisateurs':
            $stmt = $db->query("SELECT id, nom, prenom, email, telephone, date_inscription, statut FROM utilisateurs ORDER BY date_inscription DESC");
            echo json_encode(['success' => true, 'data' => $stmt->fetchAll()]);
            break;

        // ---- VISITES ----
        case 'get_visites':
            $total = $db->query("SELECT COUNT(*) FROM visites")->fetchColumn();
            $aujourdhui = $db->query("SELECT COUNT(*) FROM visites WHERE DATE(date_visite) = CURDATE()")->fetchColumn();
            $semaine = $db->query("SELECT COUNT(*) FROM visites WHERE date_visite >= DATE_SUB(NOW(), INTERVAL 7 DAY)")->fetchColumn();
            $mois = $db->query("SELECT COUNT(*) FROM visites WHERE date_visite >= DATE_SUB(NOW(), INTERVAL 30 DAY)")->fetchColumn();
            echo json_encode(['success' => true, 'data' => compact('total', 'aujourdhui', 'semaine', 'mois')]);
            break;

        // ---- CHANGER INFOS ADMIN ----
        case 'update_admin':
            $nouveau_nom = sanitize($_POST['nouveau_nom'] ?? '');
            $nouveau_mdp = $_POST['nouveau_mdp'] ?? '';
            $confirmer_mdp = $_POST['confirmer_mdp'] ?? '';
            $admin_id = $_SESSION['admin_id'];

            if (!$nouveau_nom) { echo json_encode(['success' => false, 'message' => 'Nom requis']); exit; }
            if ($nouveau_mdp && $nouveau_mdp !== $confirmer_mdp) { echo json_encode(['success' => false, 'message' => 'Les mots de passe ne correspondent pas']); exit; }
            if ($nouveau_mdp && strlen($nouveau_mdp) < 4) { echo json_encode(['success' => false, 'message' => 'Mot de passe trop court']); exit; }

            if ($nouveau_mdp) {
                $hash = password_hash($nouveau_mdp, PASSWORD_DEFAULT);
                $db->prepare("UPDATE administrateurs SET nom=?, mot_de_passe=? WHERE id=?")->execute([$nouveau_nom, $hash, $admin_id]);
            } else {
                $db->prepare("UPDATE administrateurs SET nom=? WHERE id=?")->execute([$nouveau_nom, $admin_id]);
            }
            $_SESSION['admin_nom'] = $nouveau_nom;
            echo json_encode(['success' => true, 'message' => 'Informations mises à jour avec succès']);
            break;

        default:
            echo json_encode(['error' => 'Action non reconnue']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur serveur: ' . $e->getMessage()]);
}

// ============================================
// Fonction upload image — Compatible XAMPP/Windows
// ============================================
function uploadImage($file) {
    // Chemin absolu avec DIRECTORY_SEPARATOR pour Windows
    $baseDir = dirname(__DIR__);
    $uploadDir = $baseDir . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR;

    // Créer le dossier automatiquement s'il n'existe pas
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            return ['error' => 'Impossible de créer le dossier uploads. Créez-le manuellement : uploads/products/'];
        }
    }

    // Vérifier taille (max 10 Mo)
    if ($file['size'] > 10 * 1024 * 1024) {
        return ['error' => 'Image trop lourde (maximum 10 Mo)'];
    }

    if ($file['size'] === 0) {
        return ['error' => 'Fichier vide reçu'];
    }

    // Vérifier par extension (plus fiable que MIME sur Windows)
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    if (!in_array($ext, $allowedExt)) {
        return ['error' => 'Format non supporté. Utilisez : JPG, PNG, GIF ou WEBP'];
    }

    // Vérification MIME avec finfo (si disponible)
    if (function_exists('finfo_open')) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp', 'image/x-ms-bmp', 'image/bmp'];
        if (!in_array($mimeType, $allowedMimes)) {
            return ['error' => 'Fichier non reconnu comme image (' . $mimeType . ')'];
        }
    }

    // Nom unique pour éviter les conflits
    $filename = 'prod_' . uniqid() . '_' . time() . '.' . $ext;
    $destination = $uploadDir . $filename;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return ['path' => 'uploads/products/' . $filename];
    }

    return ['error' => 'Échec sauvegarde image. Vérifiez que le dossier uploads/products/ existe dans C:\\xampp\\htdocs\\sophia\\'];
}
?>
