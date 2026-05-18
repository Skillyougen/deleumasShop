<?php
ob_start();
header('Content-Type: application/json');
require_once __DIR__ . '/config.php';
$action = $_POST['action'] ?? $_GET['action'] ?? '';
try {
    $db = getDB();
    switch($action) {
        case 'login':
            $nom = sanitize($_POST['nom']??''); $pwd = $_POST['password']??'';
            if(!$nom||!$pwd){echo json_encode(['success'=>false,'message'=>'Identifiants requis']);exit;}
            $stmt=$db->prepare("SELECT * FROM administrateurs WHERE nom=? LIMIT 1");
            $stmt->execute([$nom]); $admin=$stmt->fetch();
            if($admin){
                $valid=false;
                if(password_verify($pwd,$admin['mot_de_passe'])) $valid=true;
                elseif($admin['mot_de_passe']==='$2y$10$defaulthashwillbereplaced'&&$pwd==='yougo19'){
                    $valid=true;
                    $db->prepare("UPDATE administrateurs SET mot_de_passe=? WHERE id=?")->execute([password_hash($pwd,PASSWORD_DEFAULT),$admin['id']]);
                }
                if($valid){
                    $_SESSION['admin_logged']=true; $_SESSION['admin_id']=$admin['id']; $_SESSION['admin_nom']=$admin['nom'];
                    echo json_encode(['success'=>true,'role'=>'admin','redirect'=>'admin/dashboard.php']); exit;
                } else { echo json_encode(['success'=>false,'message'=>'Identifiants incorrects']); exit; }
            }
            $stmt=$db->prepare("SELECT * FROM utilisateurs WHERE email=? AND statut='actif' LIMIT 1");
            $stmt->execute([$nom]); $user=$stmt->fetch();
            if($user&&password_verify($pwd,$user['mot_de_passe'])){
                $_SESSION['user_id']=$user['id']; $_SESSION['user_nom']=$user['nom']; $_SESSION['user_email']=$user['email'];
                echo json_encode(['success'=>true,'role'=>'user','nom'=>$user['nom']]);
            } else { echo json_encode(['success'=>false,'message'=>'Email ou mot de passe incorrect']); }
            break;
        case 'register':
            $nom=sanitize($_POST['nom']??''); $prenom=sanitize($_POST['prenom']??'');
            $email=filter_var($_POST['email']??'',FILTER_VALIDATE_EMAIL);
            $pwd=$_POST['password']??''; $tel=sanitize($_POST['telephone']??'');
            if(!$nom||!$email||strlen($pwd)<6){echo json_encode(['success'=>false,'message'=>'Données invalides']);exit;}
            $stmt=$db->prepare("SELECT id FROM utilisateurs WHERE email=? LIMIT 1"); $stmt->execute([$email]);
            if($stmt->fetch()){echo json_encode(['success'=>false,'message'=>'Email déjà utilisé']);exit;}
            $db->prepare("INSERT INTO utilisateurs (nom,prenom,email,mot_de_passe,telephone) VALUES(?,?,?,?,?)")->execute([$nom,$prenom,$email,password_hash($pwd,PASSWORD_DEFAULT),$tel]);
            echo json_encode(['success'=>true,'message'=>'Compte créé avec succès !']); break;
        case 'logout':
            session_destroy(); echo json_encode(['success'=>true]); break;
        case 'status':
            if(isAdminLoggedIn()) echo json_encode(['logged'=>true,'role'=>'admin','nom'=>$_SESSION['admin_nom']]);
            elseif(isUserLoggedIn()) echo json_encode(['logged'=>true,'role'=>'user','nom'=>$_SESSION['user_nom']]);
            else echo json_encode(['logged'=>false]); break;
        default: echo json_encode(['error'=>'Action inconnue']);
    }
} catch(Exception $e){ echo json_encode(['success'=>false,'message'=>'Erreur serveur']); }
?>
