<?php
header('Content-Type: application/json');
require_once __DIR__ . '/config.php';
$action = $_GET['action'] ?? '';
try {
    $db = getDB();
    switch ($action) {
        case 'categories':
            $stmt = $db->query("SELECT * FROM categories ORDER BY ordre ASC, nom ASC");
            echo json_encode(['success'=>true,'data'=>$stmt->fetchAll()]); break;
        case 'produits':
            $cat = intval($_GET['categorie']??0);
            if ($cat>0) {
                $stmt=$db->prepare("SELECT p.*,c.nom as categorie_nom,c.icone as categorie_icone FROM produits p JOIN categories c ON p.categorie_id=c.id WHERE p.categorie_id=? ORDER BY p.ordre,p.nom");
                $stmt->execute([$cat]);
            } else {
                $stmt=$db->query("SELECT p.*,c.nom as categorie_nom,c.icone as categorie_icone FROM produits p JOIN categories c ON p.categorie_id=c.id ORDER BY c.ordre,p.nom");
            }
            echo json_encode(['success'=>true,'data'=>$stmt->fetchAll()]); break;
        case 'enregistrer_visite':
            enregistrerVisite(); echo json_encode(['success'=>true]); break;
        default: echo json_encode(['error'=>'Action inconnue']);
    }
} catch(Exception $e) { echo json_encode(['error'=>'Erreur serveur','success'=>false]); }
?>
