<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
require_once __DIR__ . '/../config.php';
if (!isAdminLoggedIn()) { header('Location: ../index.php'); exit; }
$adminNom = $_SESSION['admin_nom'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Administration — DELEUMASSHOP</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<style>
:root {
  --vert:        #16a34a;
  --vert-clair:  #22c55e;
  --vert-pale:   #dcfce7;
  --vert-bg:     #f0fdf4;
  --bleu:        #1d4ed8;
  --bleu-clair:  #3b82f6;
  --bleu-pale:   #dbeafe;
  --bleu-bg:     #eff6ff;
  --or:          #f59e0b;
  --or-pale:     #fef3c7;
  --rouge:       #ef4444;
  --rouge-pale:  #fee2e2;
  --violet:      #7c3aed;
  --violet-pale: #ede9fe;
  --blanc:       #ffffff;
  --creme:       #f8fafc;
  --gris:        #6b7280;
  --gris-fonce:  #374151;
  --noir:        #0f172a;
  --sidebar-w:   250px;
  --transition:  all 0.3s cubic-bezier(0.4,0,0.2,1);
  --radius:      12px;
  --shadow:      0 4px 20px rgba(22,163,74,0.1);
  --shadow-vert: 0 8px 24px rgba(22,163,74,0.28);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Nunito',sans-serif;background:var(--creme);color:var(--noir);min-height:100vh;display:flex;overflow-x:hidden;}
a{text-decoration:none;color:inherit;}
::-webkit-scrollbar{width:5px;}
::-webkit-scrollbar-track{background:var(--vert-pale);}
::-webkit-scrollbar-thumb{background:var(--vert);border-radius:3px;}

/* SIDEBAR */
.sidebar{width:var(--sidebar-w);background:var(--blanc);border-right:2px solid var(--vert-pale);position:fixed;top:0;left:0;bottom:0;display:flex;flex-direction:column;z-index:100;box-shadow:4px 0 20px rgba(22,163,74,0.08);}
.sidebar-brand{padding:22px 20px;background:linear-gradient(135deg,var(--vert),var(--bleu-clair));position:relative;overflow:hidden;}
.sidebar-brand::before{content:'';position:absolute;top:-20px;right:-20px;width:100px;height:100px;border-radius:50%;background:rgba(255,255,255,0.1);}
.sidebar-brand::after{content:'';position:absolute;bottom:-30px;left:-10px;width:80px;height:80px;border-radius:50%;background:rgba(255,255,255,0.08);}
.brand-icon{width:42px;height:42px;border-radius:12px;background:rgba(255,255,255,0.25);display:flex;align-items:center;justify-content:center;font-size:20px;color:white;margin-bottom:10px;position:relative;z-index:1;}
.brand-name{font-family:'Playfair Display',serif;font-size:18px;font-weight:900;color:white;position:relative;z-index:1;line-height:1.1;}
.brand-sub{font-size:10px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:rgba(255,255,255,0.8);position:relative;z-index:1;}
.sidebar-nav{flex:1;padding:16px 12px;overflow-y:auto;}
.nav-section-title{font-size:10px;font-weight:800;letter-spacing:3px;text-transform:uppercase;color:var(--gris);margin:16px 8px 8px;}
.sidebar-item{display:flex;align-items:center;gap:11px;padding:11px 14px;border-radius:var(--radius);cursor:pointer;transition:var(--transition);color:var(--gris);font-size:14px;font-weight:600;margin-bottom:3px;}
.sidebar-item i{width:18px;text-align:center;font-size:15px;flex-shrink:0;}
.sidebar-item:hover{background:var(--vert-pale);color:var(--vert);}
.sidebar-item.active{background:linear-gradient(135deg,var(--vert-pale),var(--bleu-pale));color:var(--vert);font-weight:700;border-left:3px solid var(--vert);padding-left:11px;}
.sidebar-item .badge{margin-left:auto;background:var(--vert);color:white;font-size:10px;font-weight:800;padding:2px 8px;border-radius:20px;}
.sidebar-footer{padding:14px 12px;border-top:2px solid var(--vert-pale);}
.admin-info{display:flex;align-items:center;gap:10px;padding:12px 14px;border-radius:var(--radius);background:linear-gradient(135deg,var(--vert-pale),var(--bleu-pale));margin-bottom:10px;}
.admin-avatar{width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,var(--vert),var(--bleu-clair));display:flex;align-items:center;justify-content:center;font-size:15px;color:white;flex-shrink:0;}
.admin-name{font-size:13px;font-weight:800;color:var(--noir);}
.admin-role{font-size:10px;color:var(--vert);font-weight:700;letter-spacing:1px;text-transform:uppercase;}
.btn-logout{display:flex;align-items:center;justify-content:center;gap:8px;padding:10px;border-radius:var(--radius);background:var(--rouge-pale);border:2px solid rgba(239,68,68,0.2);color:var(--rouge);font-size:13px;font-weight:700;cursor:pointer;width:100%;transition:var(--transition);font-family:'Nunito',sans-serif;}
.btn-logout:hover{background:var(--rouge);color:white;}

/* MAIN */
.main{margin-left:var(--sidebar-w);flex:1;min-width:0;display:flex;flex-direction:column;}
.topbar{background:var(--blanc);border-bottom:2px solid var(--vert-pale);padding:0 28px;height:66px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;box-shadow:0 2px 12px rgba(22,163,74,0.07);}
.topbar-title{font-family:'Playfair Display',serif;font-size:22px;font-weight:900;color:var(--noir);}
.topbar-title span{background:linear-gradient(135deg,var(--vert),var(--bleu-clair));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.link-site{display:flex;align-items:center;gap:8px;padding:9px 18px;border-radius:30px;background:linear-gradient(135deg,var(--vert),var(--bleu-clair));color:white;font-family:'Nunito',sans-serif;font-size:13px;font-weight:700;cursor:pointer;transition:var(--transition);box-shadow:var(--shadow-vert);}
.link-site:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(22,163,74,0.35);}
.content{padding:28px;flex:1;}
.page{display:none;}.page.active{display:block;}

/* WELCOME */
.welcome-card{background:linear-gradient(135deg,var(--vert),var(--bleu-clair));border-radius:20px;padding:28px 32px;margin-bottom:24px;color:white;display:flex;align-items:center;gap:24px;position:relative;overflow:hidden;}
.welcome-card::before{content:'';position:absolute;top:-30px;right:-30px;width:160px;height:160px;border-radius:50%;background:rgba(255,255,255,0.08);}
.welcome-card::after{content:'';position:absolute;bottom:-40px;right:80px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,0.06);}
.welcome-icon{width:60px;height:60px;border-radius:16px;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;font-size:26px;flex-shrink:0;position:relative;z-index:1;}
.welcome-text{position:relative;z-index:1;}
.welcome-text h3{font-family:'Playfair Display',serif;font-size:20px;font-weight:900;margin-bottom:4px;}
.welcome-text p{font-size:14px;opacity:0.85;font-weight:500;}

/* STATS */
.stats-row{display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:16px;margin-bottom:28px;}
.stat-card{background:var(--blanc);border-radius:16px;padding:22px;border:2px solid var(--vert-pale);transition:var(--transition);box-shadow:0 2px 8px rgba(22,163,74,0.06);}
.stat-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-vert);}
.stat-card-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:14px;}
.stat-icon{width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;}
.stat-icon.g{background:var(--vert-pale);color:var(--vert);}
.stat-icon.b{background:var(--bleu-pale);color:var(--bleu);}
.stat-icon.o{background:var(--or-pale);color:var(--or);}
.stat-icon.v{background:var(--violet-pale);color:var(--violet);}
.stat-num{font-family:'Playfair Display',serif;font-size:38px;font-weight:900;color:var(--noir);line-height:1;}
.stat-lbl{font-size:12px;font-weight:700;color:var(--gris);text-transform:uppercase;letter-spacing:1px;margin-top:4px;}

/* SEC HEADER */
.sec-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;}
.sec-title{font-family:'Playfair Display',serif;font-size:22px;font-weight:900;color:var(--noir);}
.sec-title span{background:linear-gradient(135deg,var(--vert),var(--bleu-clair));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.btn-add{display:flex;align-items:center;gap:8px;padding:11px 22px;border-radius:30px;background:linear-gradient(135deg,var(--vert),var(--bleu-clair));color:white;font-family:'Nunito',sans-serif;font-size:13px;font-weight:800;border:none;cursor:pointer;transition:var(--transition);box-shadow:var(--shadow-vert);}
.btn-add:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(22,163,74,0.38);}

/* TABLE */
.table-wrap{background:var(--blanc);border:2px solid var(--vert-pale);border-radius:16px;overflow:hidden;box-shadow:0 2px 12px rgba(22,163,74,0.06);}
.data-table{width:100%;border-collapse:collapse;}
.data-table th{background:linear-gradient(135deg,var(--vert-pale),var(--bleu-pale));font-size:11px;font-weight:800;letter-spacing:2.5px;text-transform:uppercase;color:var(--vert);padding:14px 20px;text-align:left;border-bottom:2px solid var(--vert-pale);}
.data-table td{padding:14px 20px;font-size:14px;font-weight:600;border-bottom:1px solid rgba(22,163,74,0.07);vertical-align:middle;color:var(--gris-fonce);}
.data-table tr:last-child td{border-bottom:none;}
.data-table tr:hover td{background:var(--vert-bg);}
.td-icon{width:44px;height:44px;border-radius:10px;background:linear-gradient(135deg,var(--vert-pale),var(--bleu-pale));display:flex;align-items:center;justify-content:center;color:var(--vert);font-size:18px;}
.td-img{width:48px;height:48px;border-radius:10px;object-fit:cover;}
.td-img-ph{width:48px;height:48px;border-radius:10px;background:linear-gradient(135deg,var(--vert-pale),var(--bleu-pale));display:flex;align-items:center;justify-content:center;color:rgba(22,163,74,0.4);font-size:20px;}

/* TAGS */
.tag{display:inline-block;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:800;letter-spacing:1px;text-transform:uppercase;}
.tag-g{background:var(--vert-pale);color:var(--vert);}
.tag-b{background:var(--bleu-pale);color:var(--bleu);}
.tag-o{background:var(--or-pale);color:var(--or);}
.tag-r{background:var(--rouge-pale);color:var(--rouge);}

/* ACTIONS */
.actions{display:flex;gap:8px;}
.btn-edit{padding:7px 14px;background:var(--bleu-pale);border:2px solid rgba(59,130,246,0.2);color:var(--bleu);border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;transition:var(--transition);font-family:'Nunito',sans-serif;}
.btn-edit:hover{background:var(--bleu);color:white;}
.btn-del{padding:7px 14px;background:var(--rouge-pale);border:2px solid rgba(239,68,68,0.2);color:var(--rouge);border-radius:20px;font-size:12px;font-weight:700;cursor:pointer;transition:var(--transition);font-family:'Nunito',sans-serif;}
.btn-del:hover{background:var(--rouge);color:white;}

/* MODAL */
.modal-ov{display:none;position:fixed;inset:0;background:rgba(15,23,42,0.6);backdrop-filter:blur(8px);z-index:1000;align-items:center;justify-content:center;padding:20px;}
.modal-ov.open{display:flex;}
.modal-box{background:var(--blanc);border-radius:24px;width:100%;max-width:480px;animation:modalIn 0.35s cubic-bezier(0.34,1.56,0.64,1);max-height:90vh;overflow-y:auto;border:2px solid var(--vert-pale);box-shadow:0 20px 60px rgba(22,163,74,0.2);}
.modal-box-header{padding:24px 24px 16px;background:linear-gradient(135deg,var(--vert-pale),var(--bleu-pale));display:flex;align-items:center;justify-content:space-between;border-bottom:2px solid var(--vert-pale);}
.modal-box-title{font-family:'Playfair Display',serif;font-size:20px;font-weight:900;color:var(--noir);}
.modal-box-title span{color:var(--vert);}
.btn-close{width:34px;height:34px;background:white;border:2px solid var(--vert-pale);border-radius:10px;color:var(--gris);font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:var(--transition);}
.btn-close:hover{background:var(--vert);color:white;border-color:var(--vert);}
.modal-box-body{padding:24px;}

/* FORM */
.form-group{margin-bottom:16px;}
.form-label{display:block;font-size:11px;font-weight:800;letter-spacing:2px;text-transform:uppercase;color:var(--vert);margin-bottom:7px;}
.form-input,.form-select,.form-textarea{width:100%;padding:11px 14px;background:var(--vert-bg);border:2px solid var(--vert-pale);border-radius:var(--radius);color:var(--noir);font-size:14px;font-family:'Nunito',sans-serif;font-weight:600;transition:var(--transition);outline:none;}
.form-input::placeholder,.form-textarea::placeholder{color:#9ca3af;font-weight:400;}
.form-input:focus,.form-select:focus,.form-textarea:focus{border-color:var(--vert);background:var(--vert-pale);}
.form-select option{background:white;}
.form-textarea{min-height:90px;resize:vertical;}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
.btn-save{width:100%;padding:13px;background:linear-gradient(135deg,var(--vert),var(--bleu-clair));color:white;border:none;border-radius:30px;font-family:'Nunito',sans-serif;font-size:14px;font-weight:800;cursor:pointer;transition:var(--transition);margin-top:8px;box-shadow:var(--shadow-vert);}
.btn-save:hover{opacity:0.9;transform:translateY(-1px);}
.form-msg{text-align:center;margin-top:10px;font-size:13px;font-weight:700;min-height:18px;}
.form-msg.success{color:var(--vert);}
.form-msg.error{color:var(--rouge);}

/* IMAGE */
.img-btn{display:flex;align-items:center;justify-content:center;gap:10px;padding:12px;border-radius:var(--radius);background:var(--vert-bg);border:2px dashed var(--vert-pale);color:var(--vert);font-size:13px;font-weight:700;cursor:pointer;width:100%;transition:var(--transition);font-family:'Nunito',sans-serif;}
.img-btn:hover{border-color:var(--vert);background:var(--vert-pale);}
.img-preview{width:100%;max-height:180px;object-fit:cover;border-radius:var(--radius);display:none;margin-top:10px;}

/* CONFIRM */
.confirm-box{max-width:360px;}
.confirm-msg{text-align:center;padding:14px 0;color:var(--gris);font-size:15px;font-weight:600;line-height:1.7;}
.confirm-btns{display:flex;gap:12px;justify-content:center;padding-top:8px;}
.btn-confirm-cancel{padding:10px 24px;background:var(--creme);border:2px solid var(--vert-pale);border-radius:30px;color:var(--gris);cursor:pointer;transition:var(--transition);font-size:14px;font-weight:700;font-family:'Nunito',sans-serif;}
.btn-confirm-cancel:hover{border-color:var(--gris);color:var(--noir);}
.btn-confirm-ok{padding:10px 24px;background:var(--rouge);border:none;border-radius:30px;color:white;cursor:pointer;font-size:14px;font-weight:800;font-family:'Nunito',sans-serif;transition:var(--transition);}
.btn-confirm-ok:hover{opacity:0.85;}

/* FILTER */
.filter-row{display:flex;gap:10px;margin-bottom:16px;flex-wrap:wrap;}
.filter-select{padding:9px 14px;background:var(--blanc);border:2px solid var(--vert-pale);border-radius:30px;color:var(--gris-fonce);font-size:13px;font-weight:700;font-family:'Nunito',sans-serif;outline:none;cursor:pointer;transition:var(--transition);}
.filter-select:focus{border-color:var(--vert);}

/* SETTINGS */
.settings-card{background:var(--blanc);border:2px solid var(--vert-pale);border-radius:20px;padding:32px;max-width:500px;box-shadow:0 2px 12px rgba(22,163,74,0.06);}
.settings-card h3{font-family:'Playfair Display',serif;font-size:20px;font-weight:900;color:var(--noir);margin-bottom:24px;display:flex;align-items:center;gap:10px;}
.settings-card h3 i{width:38px;height:38px;border-radius:10px;background:var(--vert-pale);color:var(--vert);display:flex;align-items:center;justify-content:center;font-size:16px;}

.empty-row td{text-align:center;padding:48px;color:var(--gris);}
.empty-row td i{font-size:40px;color:rgba(22,163,74,0.2);display:block;margin-bottom:12px;}
.spinner{width:36px;height:36px;border:3px solid var(--vert-pale);border-top-color:var(--vert);border-radius:50%;animation:spin 0.8s linear infinite;margin:0 auto;}
.loading-row td{text-align:center;padding:40px;}

.toast-cont{position:fixed;bottom:24px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:8px;}
.toast{padding:12px 18px;border-radius:14px;font-size:14px;font-weight:700;display:flex;align-items:center;gap:10px;animation:toastIn 0.3s ease;max-width:300px;font-family:'Nunito',sans-serif;}
.toast.success{background:rgba(22,163,74,0.93);color:white;}
.toast.error{background:rgba(239,68,68,0.93);color:white;}
.toast.info{background:linear-gradient(135deg,var(--vert),var(--bleu-clair));color:white;}

@keyframes modalIn{from{opacity:0;transform:scale(0.9)translateY(20px)}to{opacity:1;transform:scale(1)translateY(0)}}
@keyframes toastIn{from{opacity:0;transform:translateX(30px)}to{opacity:1;transform:translateX(0)}}
@keyframes spin{to{transform:rotate(360deg)}}
</style>
</head>
<body>

<aside class="sidebar">
  <div class="sidebar-brand">
    <div class="brand-icon"><i class="fa-solid fa-store"></i></div>
    <div class="brand-name">DELEUMASSHOP</div>
    <div class="brand-sub">Administration</div>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-section-title">Principal</div>
    <div class="sidebar-item active" onclick="showPage('dashboard',this)"><i class="fa-solid fa-chart-line"></i> Tableau de bord</div>
    <div class="nav-section-title">Catalogue</div>
    <div class="sidebar-item" onclick="showPage('categories',this)"><i class="fa-solid fa-layer-group"></i> Catégories<span class="badge" id="badgeCat">–</span></div>
    <div class="sidebar-item" onclick="showPage('produits',this)"><i class="fa-solid fa-bag-shopping"></i> Produits<span class="badge" id="badgeProd">–</span></div>
    <div class="nav-section-title">Gestion</div>
    <div class="sidebar-item" onclick="showPage('utilisateurs',this)"><i class="fa-solid fa-users"></i> Clients<span class="badge" id="badgeUsers">–</span></div>
    <div class="nav-section-title">Compte</div>
    <div class="sidebar-item" onclick="showPage('parametres',this)"><i class="fa-solid fa-gear"></i> Paramètres</div>
  </nav>
  <div class="sidebar-footer">
    <div class="admin-info">
      <div class="admin-avatar"><i class="fa-solid fa-user-shield"></i></div>
      <div><div class="admin-name"><?= htmlspecialchars($adminNom) ?></div><div class="admin-role">Administrateur</div></div>
    </div>
    <button class="btn-logout" onclick="doLogout()"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</button>
  </div>
</aside>

<div class="main">
  <div class="topbar">
    <div class="topbar-title" id="topbarTitle">Tableau de <span>Bord</span></div>
    <a href="../index.php" target="_blank" class="link-site"><i class="fa-solid fa-external-link-alt"></i> Voir la boutique</a>
  </div>

  <div class="content">

    <!-- DASHBOARD -->
    <div class="page active" id="page-dashboard">
      <div class="welcome-card">
        <div class="welcome-icon"><i class="fa-solid fa-store"></i></div>
        <div class="welcome-text">
          <h3>Bonjour, <?= htmlspecialchars($adminNom) ?> ! 👋</h3>
          <p>Bienvenue dans l'espace de gestion de DELEUMASSHOP — Boissons · Bijoux · Cosmétiques Longrich</p>
        </div>
      </div>
      <div class="stats-row">
        <div class="stat-card"><div class="stat-card-header"><div><div class="stat-num" id="statVisitesToday">–</div><div class="stat-lbl">Visites aujourd'hui</div></div><div class="stat-icon g"><i class="fa-solid fa-eye"></i></div></div></div>
        <div class="stat-card"><div class="stat-card-header"><div><div class="stat-num" id="statVisitesTotal">–</div><div class="stat-lbl">Visites totales</div></div><div class="stat-icon b"><i class="fa-solid fa-chart-bar"></i></div></div></div>
        <div class="stat-card"><div class="stat-card-header"><div><div class="stat-num" id="statProduits">–</div><div class="stat-lbl">Produits</div></div><div class="stat-icon o"><i class="fa-solid fa-bag-shopping"></i></div></div></div>
        <div class="stat-card"><div class="stat-card-header"><div><div class="stat-num" id="statCategories">–</div><div class="stat-lbl">Catégories</div></div><div class="stat-icon g"><i class="fa-solid fa-layer-group"></i></div></div></div>
        <div class="stat-card"><div class="stat-card-header"><div><div class="stat-num" id="statUsers">–</div><div class="stat-lbl">Clients</div></div><div class="stat-icon b"><i class="fa-solid fa-users"></i></div></div></div>
      </div>
      <div class="sec-header">
        <div class="sec-title">Derniers <span>Produits</span></div>
        <button class="btn-add" onclick="showPage('produits',null)"><i class="fa-solid fa-plus"></i> Ajouter</button>
      </div>
      <div class="table-wrap">
        <table class="data-table">
          <thead><tr><th></th><th>Nom</th><th>Catégorie</th><th>Prix</th></tr></thead>
          <tbody id="dashProduits"><tr class="loading-row"><td colspan="4"><div class="spinner"></div></td></tr></tbody>
        </table>
      </div>
    </div>

    <!-- CATÉGORIES -->
    <div class="page" id="page-categories">
      <div class="sec-header">
        <div class="sec-title">Gestion des <span>Catégories</span></div>
        <button class="btn-add" onclick="openModalCat()"><i class="fa-solid fa-plus"></i> Nouvelle Catégorie</button>
      </div>
      <div class="table-wrap">
        <table class="data-table">
          <thead><tr><th></th><th>Nom</th><th>Description</th><th>Produits</th><th>Actions</th></tr></thead>
          <tbody id="tbodyCategories"><tr class="loading-row"><td colspan="5"><div class="spinner"></div></td></tr></tbody>
        </table>
      </div>
    </div>

    <!-- PRODUITS -->
    <div class="page" id="page-produits">
      <div class="sec-header">
        <div class="sec-title">Gestion des <span>Produits</span></div>
        <button class="btn-add" onclick="openModalProd()"><i class="fa-solid fa-plus"></i> Nouveau Produit</button>
      </div>
      <div class="filter-row">
        <select class="filter-select" id="prodFilterCat" onchange="loadProduits()">
          <option value="0">Toutes les catégories</option>
        </select>
      </div>
      <div class="table-wrap">
        <table class="data-table">
          <thead><tr><th></th><th>Nom</th><th>Catégorie</th><th>Prix</th><th>Actions</th></tr></thead>
          <tbody id="tbodyProduits"><tr class="loading-row"><td colspan="5"><div class="spinner"></div></td></tr></tbody>
        </table>
      </div>
    </div>

    <!-- UTILISATEURS -->
    <div class="page" id="page-utilisateurs">
      <div class="sec-header"><div class="sec-title">Clients <span>Inscrits</span></div></div>
      <div class="table-wrap">
        <table class="data-table">
          <thead><tr><th>Nom</th><th>Email</th><th>Téléphone</th><th>Inscription</th><th>Statut</th></tr></thead>
          <tbody id="tbodyUsers"><tr class="loading-row"><td colspan="5"><div class="spinner"></div></td></tr></tbody>
        </table>
      </div>
    </div>

    <!-- PARAMÈTRES -->
    <div class="page" id="page-parametres">
      <div class="settings-card">
        <h3><i class="fa-solid fa-user-shield"></i> Modifier mes informations</h3>
        <form onsubmit="updateAdmin(event)">
          <div class="form-group"><label class="form-label">Nouveau nom</label><input type="text" class="form-input" id="setNom" placeholder="Nouveau nom" required/></div>
          <div class="form-group"><label class="form-label">Nouveau mot de passe (vide = inchangé)</label><input type="password" class="form-input" id="setMdp" placeholder="••••••••"/></div>
          <div class="form-group"><label class="form-label">Confirmer le mot de passe</label><input type="password" class="form-input" id="setMdp2" placeholder="••••••••"/></div>
          <button type="submit" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Enregistrer</button>
          <div class="form-msg" id="setMsg"></div>
        </form>
      </div>
    </div>

  </div>
</div>

<!-- MODAL CAT -->
<div class="modal-ov" id="modalCat">
  <div class="modal-box">
    <div class="modal-box-header">
      <div class="modal-box-title" id="titleModalCat">Nouvelle <span>Catégorie</span></div>
      <button class="btn-close" onclick="closeModal('modalCat')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-box-body">
      <form onsubmit="saveCat(event)">
        <input type="hidden" id="catId"/>
        <div class="form-group"><label class="form-label">Nom *</label><input type="text" class="form-input" id="catNom" placeholder="Ex: Boissons" required/></div>
        <div class="form-group"><label class="form-label">Description</label><textarea class="form-textarea" id="catDesc" placeholder="Description..."></textarea></div>
        <div class="form-group">
          <label class="form-label">Icône Font Awesome</label>
          <input type="text" class="form-input" id="catIcone" placeholder="fa-wine-bottle"/>
          <small style="color:var(--gris);font-size:12px;margin-top:6px;display:block">Exemples : fa-wine-bottle · fa-gem · fa-spray-can-sparkles · fa-box</small>
        </div>
        <button type="submit" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Enregistrer</button>
        <div class="form-msg" id="catMsg"></div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL PRODUIT -->
<div class="modal-ov" id="modalProd">
  <div class="modal-box" style="max-width:540px">
    <div class="modal-box-header">
      <div class="modal-box-title" id="titleModalProd">Nouveau <span>Produit</span></div>
      <button class="btn-close" onclick="closeModal('modalProd')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-box-body">
      <form id="formProd" onsubmit="saveProd(event)">
        <input type="hidden" id="prodId"/>
        <div class="form-group"><label class="form-label">Nom *</label><input type="text" class="form-input" id="prodNom" placeholder="Ex: Jus Tropicana 1L" required/></div>
        <div class="form-group"><label class="form-label">Catégorie *</label><select class="form-select" id="prodCatId" required><option value="">-- Choisir --</option></select></div>
        <div class="form-group"><label class="form-label">Description</label><textarea class="form-textarea" id="prodDesc" placeholder="Description..."></textarea></div>
        <div class="form-row">
          <div class="form-group"><label class="form-label">Prix (FCFA)</label><input type="number" class="form-input" id="prodPrix" placeholder="0" min="0"/></div>
          <div class="form-group"><label class="form-label">Unité</label><input type="text" class="form-input" id="prodUnite" value="unité"/></div>
        </div>
        <div class="form-group">
          <label class="form-label">Image</label>
          <input type="file" id="prodImage" accept="image/*" style="display:none" onchange="previewImg(this)"/>
          <button type="button" class="img-btn" onclick="document.getElementById('prodImage').click()"><i class="fa-solid fa-image"></i> Choisir une image</button>
          <img id="imgPreview" class="img-preview" alt="Aperçu"/>
        </div>
        <button type="submit" class="btn-save"><i class="fa-solid fa-floppy-disk"></i> Enregistrer</button>
        <div class="form-msg" id="prodMsg"></div>
      </form>
    </div>
  </div>
</div>

<!-- CONFIRM -->
<div class="modal-ov" id="modalConfirm">
  <div class="modal-box confirm-box">
    <div class="modal-box-header">
      <div class="modal-box-title">Confirmer la <span>Suppression</span></div>
      <button class="btn-close" onclick="closeModal('modalConfirm')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-box-body">
      <div class="confirm-msg" id="confirmMsg"></div>
      <div class="confirm-btns">
        <button class="btn-confirm-cancel" onclick="closeModal('modalConfirm')">Annuler</button>
        <button class="btn-confirm-ok" id="confirmOk">Supprimer</button>
      </div>
    </div>
  </div>
</div>

<div class="toast-cont" id="toastCont"></div>

<script>
const AAPI='api_admin.php';
let categories=[];
const pageTitles={dashboard:'Tableau de <span>Bord</span>',categories:'Gestion des <span>Catégories</span>',produits:'Gestion des <span>Produits</span>',utilisateurs:'Clients <span>Inscrits</span>',parametres:'Paramètres du <span>Compte</span>'};

function showPage(name,el){
  document.querySelectorAll('.page').forEach(p=>p.classList.remove('active'));
  document.querySelectorAll('.sidebar-item').forEach(i=>i.classList.remove('active'));
  document.getElementById('page-'+name).classList.add('active');
  if(el)el.classList.add('active');
  document.getElementById('topbarTitle').innerHTML=pageTitles[name];
  if(name==='dashboard')loadDashboard();
  if(name==='categories')loadCategories();
  if(name==='produits'){loadCatOptions();loadProduits();}
  if(name==='utilisateurs')loadUsers();
}

async function loadDashboard(){
  try{
    const[visR,prodR,catR,usrR]=await Promise.all([fetch(AAPI+'?action=get_visites'),fetch(AAPI+'?action=get_produits'),fetch(AAPI+'?action=get_categories'),fetch(AAPI+'?action=get_utilisateurs')]);
    const vis=await visR.json(),prods=await prodR.json(),cats=await catR.json(),usrs=await usrR.json();
    if(vis.success){document.getElementById('statVisitesToday').textContent=vis.data.aujourdhui||0;document.getElementById('statVisitesTotal').textContent=vis.data.total||0;}
    if(prods.success){document.getElementById('statProduits').textContent=prods.data.length;document.getElementById('badgeProd').textContent=prods.data.length;
      const tbody=document.getElementById('dashProduits'),last5=prods.data.slice(-5).reverse();
      tbody.innerHTML=last5.length?last5.map(p=>`<tr><td><div class="td-img-ph"><i class="fa-solid fa-bag-shopping"></i></div></td><td><strong>${escH(p.nom)}</strong></td><td><span class="tag tag-g">${escH(p.cat_nom||'')}</span></td><td>${p.prix?parseInt(p.prix).toLocaleString('fr-FR')+' FCFA':'<span style="color:var(--gris)">Sur demande</span>'}</td></tr>`).join(''):'<tr class="empty-row"><td colspan="4"><i class="fa-solid fa-box-open"></i>Aucun produit</td></tr>';
    }
    if(cats.success){document.getElementById('statCategories').textContent=cats.data.length;document.getElementById('badgeCat').textContent=cats.data.length;}
    if(usrs.success){document.getElementById('statUsers').textContent=usrs.data.length;document.getElementById('badgeUsers').textContent=usrs.data.length;}
  }catch(e){toast('Erreur chargement','error');}
}

async function loadCategories(){
  const tbody=document.getElementById('tbodyCategories');
  try{
    const r=await fetch(AAPI+'?action=get_categories');const d=await r.json();
    if(!d.success)throw new Error();
    categories=d.data;document.getElementById('badgeCat').textContent=categories.length;
    tbody.innerHTML=categories.length?categories.map(c=>`<tr>
      <td><div class="td-icon"><i class="fa-solid ${escH(c.icone||'fa-box')}"></i></div></td>
      <td><strong>${escH(c.nom)}</strong></td>
      <td style="color:var(--gris)">${escH(c.description||'—')}</td>
      <td><span class="tag tag-b">${c.nb_produits} produit(s)</span></td>
      <td><div class="actions"><button class="btn-edit" onclick="editCat(${c.id})"><i class="fa-solid fa-pen"></i> Modifier</button><button class="btn-del" onclick="confirmDelete('cat',${c.id},'${escH(c.nom)}')"><i class="fa-solid fa-trash"></i> Supprimer</button></div></td>
    </tr>`).join(''):'<tr class="empty-row"><td colspan="5"><i class="fa-solid fa-layer-group"></i>Aucune catégorie</td></tr>';
  }catch{tbody.innerHTML='<tr class="empty-row"><td colspan="5"><i class="fa-solid fa-triangle-exclamation"></i>Erreur</td></tr>';}
}
function openModalCat(cat=null){
  document.getElementById('catId').value=cat?cat.id:'';
  document.getElementById('catNom').value=cat?cat.nom:'';
  document.getElementById('catDesc').value=cat?(cat.description||''):'';
  document.getElementById('catIcone').value=cat?(cat.icone||'fa-box'):'fa-box';
  document.getElementById('catMsg').textContent='';
  document.getElementById('titleModalCat').innerHTML=cat?'Modifier la <span>Catégorie</span>':'Nouvelle <span>Catégorie</span>';
  openModal('modalCat');
}
function editCat(id){const c=categories.find(x=>x.id==id);if(c)openModalCat(c);}
async function saveCat(e){
  e.preventDefault();const msg=document.getElementById('catMsg');msg.className='form-msg';msg.textContent='Sauvegarde...';
  const fd=new FormData(),id=document.getElementById('catId').value;
  fd.append('action',id?'update_category':'create_category');if(id)fd.append('id',id);
  fd.append('nom',document.getElementById('catNom').value);fd.append('description',document.getElementById('catDesc').value);fd.append('icone',document.getElementById('catIcone').value);
  try{const r=await fetch(AAPI,{method:'POST',body:fd});const d=await r.json();
    if(d.success){msg.className='form-msg success';msg.textContent=d.message;setTimeout(()=>{closeModal('modalCat');loadCategories();loadCatOptions();},900);toast(d.message,'success');}
    else{msg.className='form-msg error';msg.textContent=d.message;}
  }catch{msg.className='form-msg error';msg.textContent='Erreur serveur';}
}

async function loadCatOptions(){
  const r=await fetch(AAPI+'?action=get_categories');const d=await r.json();
  if(!d.success)return;categories=d.data;
  const sf=document.getElementById('prodCatId'),ff=document.getElementById('prodFilterCat');
  sf.innerHTML='<option value="">-- Choisir --</option>';ff.innerHTML='<option value="0">Toutes les catégories</option>';
  categories.forEach(c=>{sf.innerHTML+=`<option value="${c.id}">${escH(c.nom)}</option>`;ff.innerHTML+=`<option value="${c.id}">${escH(c.nom)}</option>`;});
}
async function loadProduits(){
  const tbody=document.getElementById('tbodyProduits'),cat=document.getElementById('prodFilterCat').value;
  try{
    const r=await fetch(AAPI+`?action=get_produits&categorie=${cat}`);const d=await r.json();
    if(!d.success)throw new Error();
    document.getElementById('badgeProd').textContent=d.data.length;
    tbody.innerHTML=d.data.length?d.data.map(p=>`<tr>
      <td>${p.image?`<img class="td-img" src="../${escH(p.image)}" alt="">`:`<div class="td-img-ph"><i class="fa-solid fa-image"></i></div>`}</td>
      <td><strong>${escH(p.nom)}</strong></td>
      <td><span class="tag tag-g">${escH(p.cat_nom||'')}</span></td>
      <td>${p.prix?parseInt(p.prix).toLocaleString('fr-FR')+' FCFA':'<span style="color:var(--gris)">Sur demande</span>'}</td>
      <td><div class="actions"><button class="btn-edit" onclick="editProd(${p.id})"><i class="fa-solid fa-pen"></i> Modifier</button><button class="btn-del" onclick="confirmDelete('prod',${p.id},'${escH(p.nom)}')"><i class="fa-solid fa-trash"></i> Supprimer</button></div></td>
    </tr>`).join(''):'<tr class="empty-row"><td colspan="5"><i class="fa-solid fa-box-open"></i>Aucun produit</td></tr>';
  }catch{tbody.innerHTML='<tr class="empty-row"><td colspan="5"><i class="fa-solid fa-triangle-exclamation"></i>Erreur</td></tr>';}
}
function openModalProd(prod=null){
  document.getElementById('prodId').value=prod?prod.id:'';
  document.getElementById('prodNom').value=prod?prod.nom:'';
  document.getElementById('prodCatId').value=prod?prod.categorie_id:'';
  document.getElementById('prodDesc').value=prod?(prod.description||''):'';
  document.getElementById('prodPrix').value=prod?(prod.prix||''):'';
  document.getElementById('prodUnite').value=prod?(prod.unite||'unité'):'unité';
  document.getElementById('prodMsg').textContent='';
  document.getElementById('imgPreview').style.display='none';
  document.getElementById('prodImage').value='';
  if(prod&&prod.image){const img=document.getElementById('imgPreview');img.src='../'+prod.image;img.style.display='block';}
  document.getElementById('titleModalProd').innerHTML=prod?'Modifier le <span>Produit</span>':'Nouveau <span>Produit</span>';
  openModal('modalProd');
}
async function editProd(id){const r=await fetch(AAPI+'?action=get_produits');const d=await r.json();if(d.success){const p=d.data.find(x=>x.id==id);if(p)openModalProd(p);}}
function previewImg(input){if(input.files&&input.files[0]){const img=document.getElementById('imgPreview');img.src=URL.createObjectURL(input.files[0]);img.style.display='block';}}
async function saveProd(e){
  e.preventDefault();const msg=document.getElementById('prodMsg');msg.className='form-msg';msg.textContent='Sauvegarde...';
  const fd=new FormData(),id=document.getElementById('prodId').value;
  fd.append('action',id?'update_product':'create_product');if(id)fd.append('id',id);
  fd.append('nom',document.getElementById('prodNom').value);fd.append('categorie_id',document.getElementById('prodCatId').value);
  fd.append('description',document.getElementById('prodDesc').value);fd.append('prix',document.getElementById('prodPrix').value);fd.append('unite',document.getElementById('prodUnite').value);
  const img=document.getElementById('prodImage').files[0];if(img)fd.append('image',img);
  try{const r=await fetch(AAPI,{method:'POST',body:fd});const d=await r.json();
    if(d.success){msg.className='form-msg success';msg.textContent=d.message;setTimeout(()=>{closeModal('modalProd');loadProduits();},900);toast(d.message,'success');}
    else{msg.className='form-msg error';msg.textContent=d.message;}
  }catch{msg.className='form-msg error';msg.textContent='Erreur serveur';}
}

async function loadUsers(){
  const tbody=document.getElementById('tbodyUsers');
  try{
    const r=await fetch(AAPI+'?action=get_utilisateurs');const d=await r.json();
    if(!d.success)throw new Error();
    document.getElementById('badgeUsers').textContent=d.data.length;
    tbody.innerHTML=d.data.length?d.data.map(u=>`<tr>
      <td><strong>${escH(u.nom)} ${escH(u.prenom||'')}</strong></td>
      <td style="color:var(--gris)">${escH(u.email)}</td>
      <td style="color:var(--gris)">${escH(u.telephone||'—')}</td>
      <td style="color:var(--gris);font-size:12px">${new Date(u.date_inscription).toLocaleDateString('fr-FR')}</td>
      <td><span class="tag ${u.statut==='actif'?'tag-g':'tag-r'}">${escH(u.statut)}</span></td>
    </tr>`).join(''):'<tr class="empty-row"><td colspan="5"><i class="fa-solid fa-users"></i>Aucun client</td></tr>';
  }catch{tbody.innerHTML='<tr class="empty-row"><td colspan="5"><i class="fa-solid fa-triangle-exclamation"></i>Erreur</td></tr>';}
}

async function updateAdmin(e){
  e.preventDefault();const msg=document.getElementById('setMsg');msg.className='form-msg';msg.textContent='Mise à jour...';
  const fd=new FormData();fd.append('action','update_admin');fd.append('nouveau_nom',document.getElementById('setNom').value);fd.append('nouveau_mdp',document.getElementById('setMdp').value);fd.append('confirmer_mdp',document.getElementById('setMdp2').value);
  try{const r=await fetch(AAPI,{method:'POST',body:fd});const d=await r.json();
    if(d.success){msg.className='form-msg success';msg.textContent=d.message;toast(d.message,'success');}
    else{msg.className='form-msg error';msg.textContent=d.message;}
  }catch{msg.className='form-msg error';msg.textContent='Erreur serveur';}
}

function confirmDelete(type,id,nom){
  document.getElementById('confirmMsg').innerHTML=`Voulez-vous vraiment supprimer<br><strong>"${escH(nom)}"</strong> ?<br><small style="color:var(--rouge)">Action irréversible.</small>`;
  document.getElementById('confirmOk').onclick=()=>doDelete(type,id);
  openModal('modalConfirm');
}
async function doDelete(type,id){
  closeModal('modalConfirm');
  const fd=new FormData();fd.append('action',type==='cat'?'delete_category':'delete_product');fd.append('id',id);
  try{const r=await fetch(AAPI,{method:'POST',body:fd});const d=await r.json();
    if(d.success){toast(d.message,'success');type==='cat'?loadCategories():loadProduits();}
    else toast(d.message||'Erreur','error');
  }catch{toast('Erreur serveur','error');}
}

async function doLogout(){await fetch('../auth.php?action=logout');window.location.href='../index.php';}

function openModal(id){document.getElementById(id).classList.add('open');}
function closeModal(id){document.getElementById(id).classList.remove('open');}
document.querySelectorAll('.modal-ov').forEach(ov=>ov.addEventListener('click',e=>{if(e.target===ov)ov.classList.remove('open');}));

function toast(msg,type='info'){const c=document.getElementById('toastCont'),t=document.createElement('div');t.className=`toast ${type}`;const icons={success:'fa-check-circle',error:'fa-times-circle',info:'fa-info-circle'};t.innerHTML=`<i class="fa-solid ${icons[type]||icons.info}"></i> ${msg}`;c.appendChild(t);setTimeout(()=>t.remove(),3500);}
function escH(s){if(!s)return'';return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');}

window.addEventListener('DOMContentLoaded',()=>{loadDashboard();loadCatOptions();});
</script>
</body>
</html>
