<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>DELEUMASSHOP — Boissons, Bijoux & Cosmétiques Longrich</title>
<link rel="preconnect" href="https://fonts.googleapis.com"/>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet"/>
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
  --blanc:       #ffffff;
  --creme:       #f8fafc;
  --gris:        #6b7280;
  --gris-fonce:  #374151;
  --noir:        #0f172a;
  --transition:  all 0.35s cubic-bezier(0.4,0,0.2,1);
  --radius:      12px;
  --shadow:      0 8px 32px rgba(22,163,74,0.12);
  --shadow-vert: 0 8px 32px rgba(22,163,74,0.28);
}
*{margin:0;padding:0;box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{font-family:'Nunito',sans-serif;background:var(--creme);color:var(--noir);min-height:100vh;display:flex;flex-direction:column;overflow-x:hidden;}
a{text-decoration:none;color:inherit;}
::-webkit-scrollbar{width:5px;}
::-webkit-scrollbar-track{background:var(--vert-pale);}
::-webkit-scrollbar-thumb{background:var(--vert);border-radius:3px;}

/* ===== HEADER ===== */
#header{position:fixed;top:0;left:0;right:0;z-index:1000;background:rgba(255,255,255,0.95);backdrop-filter:blur(16px);border-bottom:2px solid var(--vert-pale);transition:var(--transition);}
#header.scrolled{box-shadow:0 4px 24px rgba(22,163,74,0.12);}
.header-inner{max-width:1280px;margin:0 auto;padding:0 24px;height:68px;display:flex;align-items:center;justify-content:space-between;gap:16px;}

.logo{display:flex;align-items:center;gap:12px;cursor:pointer;flex-shrink:0;}
.logo-icon{width:44px;height:44px;background:linear-gradient(135deg,var(--vert),var(--bleu-clair));border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;color:white;box-shadow:var(--shadow-vert);flex-shrink:0;}
.logo-text{display:flex;flex-direction:column;line-height:1.1;}
.logo-main{font-family:'Playfair Display',serif;font-size:20px;font-weight:900;color:var(--noir);}
.logo-sub{font-size:10px;font-weight:700;letter-spacing:3px;color:var(--vert);text-transform:uppercase;}

.nav{display:flex;align-items:center;gap:4px;}
.nav-link{display:flex;flex-direction:column;align-items:center;gap:4px;padding:8px 18px;border-radius:10px;cursor:pointer;transition:var(--transition);color:var(--gris);font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;}
.nav-link i{font-size:17px;}
.nav-link:hover,.nav-link.active{color:var(--vert);background:var(--vert-pale);}

.header-actions{display:flex;align-items:center;gap:10px;}
.btn-login{display:flex;align-items:center;gap:8px;padding:9px 20px;background:linear-gradient(135deg,var(--vert),var(--bleu-clair));border:none;border-radius:30px;color:white;font-family:'Nunito',sans-serif;font-size:13px;font-weight:700;cursor:pointer;transition:var(--transition);box-shadow:var(--shadow-vert);}
.btn-login:hover{transform:translateY(-2px);box-shadow:0 12px 28px rgba(22,163,74,0.38);}
.user-badge{display:none;align-items:center;gap:8px;padding:6px 14px;background:var(--vert-pale);border:1px solid rgba(22,163,74,0.3);border-radius:30px;font-size:13px;font-weight:700;color:var(--vert);}
.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;padding:8px;}
.hamburger span{display:block;width:22px;height:2px;background:var(--vert);border-radius:1px;transition:var(--transition);}
.hamburger.open span:nth-child(1){transform:translateY(7px)rotate(45deg);}
.hamburger.open span:nth-child(2){opacity:0;}
.hamburger.open span:nth-child(3){transform:translateY(-7px)rotate(-45deg);}

.mobile-nav{display:none;position:fixed;top:68px;left:0;right:0;background:white;border-bottom:2px solid var(--vert-pale);z-index:999;padding:12px;flex-direction:column;gap:4px;animation:slideDown 0.3s ease;}
.mobile-nav.open{display:flex;}
.mobile-nav-link{display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:10px;cursor:pointer;transition:var(--transition);color:var(--gris);font-weight:700;font-size:15px;}
.mobile-nav-link:hover,.mobile-nav-link.active{color:var(--vert);background:var(--vert-pale);}

/* ===== SECTIONS ===== */
.sections-wrapper{flex:1;display:flex;overflow:hidden;position:relative;margin-top:68px;}
.section-page{min-width:100%;width:100%;opacity:0;transform:translateX(60px);transition:opacity 0.45s ease,transform 0.45s ease;pointer-events:none;position:absolute;top:0;left:0;min-height:calc(100vh - 68px);}
.section-page.active{opacity:1;transform:translateX(0);pointer-events:all;position:relative;}
.section-page.leaving{opacity:0;transform:translateX(-60px);pointer-events:none;}

/* ===== HOME ===== */
.hero{position:relative;min-height:86vh;display:flex;align-items:center;overflow:hidden;padding:60px 24px;}
.hero-bg{position:absolute;inset:0;background:linear-gradient(135deg,#f0fdf4 0%,#eff6ff 50%,#f8fafc 100%);}
.hero-circles::before{content:'';position:absolute;top:-10%;right:-5%;width:600px;height:600px;border-radius:50%;background:radial-gradient(circle,rgba(22,163,74,0.10) 0%,transparent 70%);}
.hero-circles::after{content:'';position:absolute;bottom:-15%;left:-8%;width:500px;height:500px;border-radius:50%;background:radial-gradient(circle,rgba(29,78,216,0.08) 0%,transparent 70%);}
.hero-circles{position:absolute;inset:0;overflow:hidden;}
.hero-content{position:relative;max-width:1280px;margin:0 auto;width:100%;display:grid;grid-template-columns:1.1fr 0.9fr;gap:60px;align-items:center;}
.hero-tag{display:inline-flex;align-items:center;gap:8px;padding:7px 16px;background:white;border-radius:30px;box-shadow:var(--shadow);font-size:12px;font-weight:700;color:var(--vert);letter-spacing:1.5px;text-transform:uppercase;margin-bottom:24px;animation:fadeInUp 0.7s ease 0.1s both;}
.hero-tag i{color:var(--bleu-clair);}
.hero-title{font-family:'Playfair Display',serif;font-size:clamp(42px,5.5vw,72px);font-weight:900;line-height:1.05;margin-bottom:24px;animation:fadeInUp 0.7s ease 0.2s both;}
.hero-title .grad{background:linear-gradient(135deg,var(--vert),var(--bleu-clair));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.hero-desc{font-size:16px;line-height:1.9;color:var(--gris);max-width:460px;margin-bottom:36px;animation:fadeInUp 0.7s ease 0.3s both;}
.hero-desc strong{color:var(--vert);font-weight:700;}
.hero-cta{display:flex;gap:14px;flex-wrap:wrap;animation:fadeInUp 0.7s ease 0.4s both;}
.btn-primary{display:inline-flex;align-items:center;gap:10px;padding:14px 32px;background:linear-gradient(135deg,var(--vert),var(--bleu-clair));color:white;border:none;border-radius:30px;font-family:'Nunito',sans-serif;font-size:14px;font-weight:800;cursor:pointer;transition:var(--transition);box-shadow:var(--shadow-vert);}
.btn-primary:hover{transform:translateY(-3px);box-shadow:0 14px 32px rgba(22,163,74,0.38);}
.btn-secondary{display:inline-flex;align-items:center;gap:10px;padding:14px 32px;background:white;color:var(--vert);border:2px solid var(--vert);border-radius:30px;font-family:'Nunito',sans-serif;font-size:14px;font-weight:800;cursor:pointer;transition:var(--transition);}
.btn-secondary:hover{background:var(--vert-pale);}

.hero-visual{display:grid;grid-template-columns:1fr 1fr;gap:14px;animation:fadeInUp 0.7s ease 0.5s both;}
.float-card{background:white;border-radius:16px;padding:22px;box-shadow:var(--shadow);transition:var(--transition);display:flex;flex-direction:column;align-items:flex-start;gap:10px;}
.float-card:hover{transform:translateY(-6px);}
.float-card:first-child{grid-column:1/-1;background:linear-gradient(135deg,var(--vert),var(--bleu-clair));color:white;}
.float-card-icon{font-size:28px;}
.float-card:first-child .float-card-icon{color:rgba(255,255,255,0.9);}
.float-card h4{font-family:'Playfair Display',serif;font-size:16px;font-weight:700;line-height:1.2;}
.float-card:first-child h4{color:white;}
.float-card p{font-size:12px;color:var(--gris);}
.float-card:first-child p{color:rgba(255,255,255,0.85);}

/* CAT STRIP */
.cat-strip{background:white;border-top:2px solid var(--vert-pale);padding:56px 24px;}
.strip-inner{max-width:1280px;margin:0 auto;}
.sec-badge{display:inline-flex;align-items:center;gap:8px;padding:6px 16px;background:var(--vert-pale);border-radius:30px;font-size:11px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:var(--vert);margin-bottom:16px;}
.sec-heading{font-family:'Playfair Display',serif;font-size:clamp(28px,3.5vw,42px);font-weight:900;margin-bottom:36px;line-height:1.1;}
.sec-heading span{background:linear-gradient(135deg,var(--vert),var(--bleu-clair));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.cats-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:20px;}
.cat-card{position:relative;overflow:hidden;border-radius:20px;padding:32px 28px;cursor:pointer;transition:var(--transition);display:flex;align-items:center;gap:20px;border:2px solid transparent;}
.cat-card:hover{transform:translateY(-5px);border-color:rgba(22,163,74,0.3);}
.cat-card.green{background:linear-gradient(135deg,#dcfce7,#f0fdf4);}
.cat-card.blue{background:linear-gradient(135deg,#dbeafe,#eff6ff);}
.cat-card.teal{background:linear-gradient(135deg,#ccfbf1,#f0fdfa);}
.cat-card-icon{width:60px;height:60px;border-radius:16px;display:flex;align-items:center;justify-content:center;font-size:26px;flex-shrink:0;}
.cat-card.green .cat-card-icon{background:var(--vert);color:white;}
.cat-card.blue .cat-card-icon{background:var(--bleu);color:white;}
.cat-card.teal .cat-card-icon{background:#0d9488;color:white;}
.cat-card-info h3{font-family:'Playfair Display',serif;font-size:20px;font-weight:700;margin-bottom:5px;}
.cat-card-info p{font-size:13px;color:var(--gris);line-height:1.5;}
.cat-arrow{margin-left:auto;width:36px;height:36px;border-radius:50%;background:white;display:flex;align-items:center;justify-content:center;font-size:13px;color:var(--vert);flex-shrink:0;box-shadow:0 2px 8px rgba(0,0,0,0.1);transition:var(--transition);}
.cat-card:hover .cat-arrow{background:var(--vert);color:white;}
.cat-badge{position:absolute;top:16px;right:16px;padding:4px 10px;border-radius:20px;font-size:10px;font-weight:800;letter-spacing:1px;text-transform:uppercase;}
.cat-card.green .cat-badge{background:var(--vert);color:white;}
.cat-card.teal .cat-badge{background:#0d9488;color:white;}

/* ABOUT */
.about-strip{padding:72px 24px;background:var(--creme);}
.about-inner{max-width:1280px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:72px;align-items:center;}
.about-text-content p{font-size:15px;line-height:1.9;color:var(--gris);margin-bottom:28px;}
.about-text-content strong{color:var(--vert);}
.about-list{display:flex;flex-direction:column;gap:14px;}
.about-item{display:flex;align-items:center;gap:14px;}
.about-item-icon{width:38px;height:38px;border-radius:10px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:16px;}
.about-item-icon.g{background:var(--vert-pale);color:var(--vert);}
.about-item-icon.b{background:var(--bleu-pale);color:var(--bleu);}
.about-item span{font-size:14px;font-weight:600;color:var(--gris-fonce);}
.about-visual{position:relative;}
.about-card-main{background:linear-gradient(135deg,var(--vert),var(--bleu-clair));border-radius:24px;padding:44px;text-align:center;color:white;box-shadow:0 20px 60px rgba(22,163,74,0.3);}
.about-card-main i{font-size:72px;opacity:0.9;display:block;margin-bottom:20px;}
.about-card-main h4{font-family:'Playfair Display',serif;font-size:24px;font-weight:700;margin-bottom:8px;}
.about-card-main p{font-size:14px;opacity:0.85;line-height:1.7;}
.about-floating{position:absolute;bottom:-20px;right:-16px;background:white;border-radius:16px;padding:18px 22px;box-shadow:0 8px 32px rgba(0,0,0,0.12);text-align:center;border:2px solid var(--vert-pale);}
.about-floating .num{font-family:'Playfair Display',serif;font-size:32px;font-weight:900;color:var(--vert);line-height:1;}
.about-floating .lbl{font-size:11px;font-weight:700;color:var(--gris);letter-spacing:1.5px;text-transform:uppercase;}

/* PRODUITS */
#section-produits{min-height:calc(100vh - 68px);padding:56px 24px;}
.products-inner{max-width:1280px;margin:0 auto;}
.filter-bar{display:flex;gap:10px;flex-wrap:wrap;margin-bottom:36px;}
.filter-btn{display:flex;align-items:center;gap:8px;padding:10px 20px;border-radius:30px;cursor:pointer;transition:var(--transition);background:white;border:2px solid #e5e7eb;color:var(--gris);font-family:'Nunito',sans-serif;font-size:13px;font-weight:700;}
.filter-btn:hover,.filter-btn.active{background:var(--vert);border-color:var(--vert);color:white;box-shadow:var(--shadow-vert);}
.products-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:22px;}
.product-card{background:white;border-radius:20px;overflow:hidden;transition:var(--transition);cursor:pointer;box-shadow:0 2px 12px rgba(0,0,0,0.06);animation:fadeInUp 0.5s ease both;border:2px solid transparent;}
.product-card:hover{transform:translateY(-7px);box-shadow:0 16px 48px rgba(22,163,74,0.15);border-color:var(--vert-pale);}
.product-img{width:100%;height:210px;object-fit:cover;display:block;}
.product-img-ph{width:100%;height:210px;background:linear-gradient(135deg,var(--vert-pale),var(--bleu-pale));display:flex;align-items:center;justify-content:center;font-size:56px;color:rgba(22,163,74,0.3);}
.product-body{padding:20px;}
.product-cat{font-size:10px;font-weight:800;letter-spacing:2px;text-transform:uppercase;color:var(--vert);margin-bottom:8px;display:flex;align-items:center;gap:6px;}
.product-name{font-family:'Playfair Display',serif;font-size:18px;font-weight:700;margin-bottom:7px;line-height:1.2;}
.product-desc{font-size:13px;color:var(--gris);line-height:1.6;margin-bottom:14px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.product-footer{display:flex;align-items:center;justify-content:space-between;}
.product-price{font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:var(--vert);}
.product-price span{font-size:12px;font-weight:400;color:var(--gris);font-family:'Nunito',sans-serif;}
.product-price.noprice{font-size:13px;color:var(--gris);font-weight:600;font-family:'Nunito',sans-serif;}
.btn-detail{padding:8px 16px;background:var(--vert-pale);border:none;border-radius:20px;color:var(--vert);font-family:'Nunito',sans-serif;font-size:12px;font-weight:700;cursor:pointer;transition:var(--transition);}
.btn-detail:hover{background:var(--vert);color:white;}

/* CONTACT */
#section-contact{min-height:calc(100vh - 68px);padding:56px 24px;}
.contact-inner{max-width:960px;margin:0 auto;}
.contact-grid{display:grid;grid-template-columns:1fr 1fr;gap:22px;margin-top:40px;}
.contact-card{background:white;border:2px solid var(--vert-pale);border-radius:20px;padding:32px;transition:var(--transition);display:flex;flex-direction:column;gap:16px;}
.contact-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-vert);}
.contact-icon{width:54px;height:54px;border-radius:14px;background:linear-gradient(135deg,var(--vert),var(--bleu-clair));display:flex;align-items:center;justify-content:center;font-size:22px;color:white;}
.contact-label{font-size:11px;font-weight:800;letter-spacing:2.5px;text-transform:uppercase;color:var(--vert);}
.contact-value{font-size:15px;color:var(--gris-fonce);line-height:1.7;}
.contact-value a{color:var(--vert);font-weight:700;}
.wa-btn{display:flex;align-items:center;justify-content:center;gap:12px;padding:16px 32px;background:#25D366;color:white;border:none;border-radius:30px;font-family:'Nunito',sans-serif;font-size:15px;font-weight:800;cursor:pointer;transition:var(--transition);text-decoration:none;width:100%;box-shadow:0 6px 20px rgba(37,211,102,0.35);margin-top:4px;}
.wa-btn:hover{background:#20c55e;transform:translateY(-2px);}
.wa-btn i{font-size:22px;}
.map-ph{grid-column:1/-1;background:var(--vert-bg);border:2px dashed rgba(22,163,74,0.3);border-radius:16px;height:180px;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:10px;color:var(--gris);}
.map-ph i{font-size:36px;color:var(--vert);}
.map-ph a{color:var(--vert);font-size:13px;font-weight:700;}

/* FOOTER */
footer{background:var(--noir);padding:52px 24px 24px;}
.footer-inner{max-width:1280px;margin:0 auto;}
.footer-top{display:grid;grid-template-columns:2fr 1fr 1fr;gap:48px;margin-bottom:40px;}
.footer-brand p{font-size:14px;color:#9ca3af;line-height:1.8;margin-top:14px;max-width:300px;}
.footer-col h4{font-size:11px;font-weight:800;letter-spacing:3px;text-transform:uppercase;color:var(--vert-clair);margin-bottom:18px;}
.footer-links{display:flex;flex-direction:column;gap:10px;}
.footer-link{font-size:14px;color:#9ca3af;cursor:pointer;transition:var(--transition);display:flex;align-items:center;gap:8px;}
.footer-link:hover{color:var(--vert-clair);}
.footer-bottom{display:flex;align-items:center;justify-content:space-between;padding-top:24px;border-top:1px solid rgba(255,255,255,0.06);flex-wrap:wrap;gap:14px;}
.footer-copy{font-size:12px;color:#6b7280;}
.footer-wa{display:flex;align-items:center;gap:8px;padding:8px 20px;background:rgba(37,211,102,0.1);border:1px solid rgba(37,211,102,0.3);border-radius:30px;color:#25D366;font-size:13px;font-weight:700;text-decoration:none;transition:var(--transition);}
.footer-wa:hover{background:rgba(37,211,102,0.2);}

/* MODALS */
.modal-overlay{display:none;position:fixed;inset:0;background:rgba(15,23,42,0.65);backdrop-filter:blur(8px);z-index:2000;align-items:center;justify-content:center;padding:20px;}
.modal-overlay.open{display:flex;}
.modal{background:white;border-radius:24px;width:100%;max-width:420px;overflow:hidden;animation:modalIn 0.35s cubic-bezier(0.34,1.56,0.64,1);border:2px solid var(--vert-pale);}
.modal-head{padding:32px 32px 20px;text-align:center;position:relative;background:linear-gradient(135deg,var(--vert-pale),var(--bleu-pale));}
.modal-logo{width:56px;height:56px;border-radius:14px;background:linear-gradient(135deg,var(--vert),var(--bleu-clair));display:flex;align-items:center;justify-content:center;font-size:22px;color:white;margin:0 auto 14px;}
.modal-title{font-family:'Playfair Display',serif;font-size:22px;font-weight:900;}
.modal-subtitle{font-size:13px;color:var(--gris);margin-top:5px;}
.modal-close{position:absolute;top:14px;right:14px;width:32px;height:32px;background:white;border:none;border-radius:8px;font-size:16px;color:var(--gris);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:var(--transition);}
.modal-close:hover{color:var(--vert);background:var(--vert-pale);}
.modal-tabs{display:flex;margin:0 28px;background:#f3f4f6;border-radius:10px;padding:4px;}
.modal-tab{flex:1;padding:8px;text-align:center;border-radius:7px;cursor:pointer;font-size:13px;font-weight:700;color:var(--gris);transition:var(--transition);}
.modal-tab.active{background:linear-gradient(135deg,var(--vert),var(--bleu-clair));color:white;}
.modal-body{padding:22px 28px 28px;}
.modal-form{display:none;}
.modal-form.active{display:block;}
.form-group{margin-bottom:14px;}
.form-label{display:block;font-size:11px;font-weight:800;letter-spacing:2px;text-transform:uppercase;color:var(--vert);margin-bottom:7px;}
.form-input{width:100%;padding:11px 14px;background:var(--vert-bg);border:2px solid var(--vert-pale);border-radius:10px;color:var(--noir);font-size:14px;font-family:'Nunito',sans-serif;transition:var(--transition);outline:none;}
.form-input::placeholder{color:#9ca3af;}
.form-input:focus{border-color:var(--vert);background:var(--vert-pale);}
.form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px;}
.btn-submit{width:100%;padding:13px;background:linear-gradient(135deg,var(--vert),var(--bleu-clair));color:white;border:none;border-radius:30px;font-family:'Nunito',sans-serif;font-size:14px;font-weight:800;cursor:pointer;transition:var(--transition);margin-top:8px;box-shadow:var(--shadow-vert);}
.btn-submit:hover{opacity:0.9;transform:translateY(-1px);}
.form-msg{text-align:center;margin-top:10px;font-size:13px;font-weight:600;min-height:18px;}
.form-msg.success{color:var(--vert);}
.form-msg.error{color:#ef4444;}

/* Modal produit */
.mprod-img{width:100%;max-height:280px;object-fit:cover;border-radius:14px;margin-bottom:18px;}
.mprod-cat{font-size:10px;font-weight:800;letter-spacing:2px;text-transform:uppercase;color:var(--vert);margin-bottom:7px;}
.mprod-name{font-family:'Playfair Display',serif;font-size:26px;font-weight:700;margin-bottom:10px;}
.mprod-desc{font-size:14px;color:var(--gris);line-height:1.8;margin-bottom:16px;}
.mprod-price{font-family:'Playfair Display',serif;font-size:26px;font-weight:700;color:var(--vert);margin-bottom:18px;}

.empty-state{grid-column:1/-1;text-align:center;padding:72px 20px;}
.empty-state i{font-size:56px;color:rgba(22,163,74,0.2);display:block;margin-bottom:16px;}
.loading{grid-column:1/-1;text-align:center;padding:60px;}
.spinner{width:38px;height:38px;border:3px solid var(--vert-pale);border-top-color:var(--vert);border-radius:50%;animation:spin 0.8s linear infinite;margin:0 auto 14px;}
.db-warn{background:#fef2f2;border:2px solid #fecaca;border-radius:10px;padding:14px;color:#dc2626;font-size:13px;font-weight:600;margin-bottom:20px;display:none;}
.toast-cont{position:fixed;bottom:24px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:8px;}
.toast{padding:12px 18px;border-radius:12px;font-size:14px;font-weight:600;display:flex;align-items:center;gap:10px;animation:toastIn 0.3s ease;max-width:300px;}
.toast.success{background:rgba(22,163,74,0.92);color:white;}
.toast.error{background:rgba(239,68,68,0.92);color:white;}
.toast.info{background:linear-gradient(135deg,var(--vert),var(--bleu-clair));color:white;}

@keyframes fadeInUp{from{opacity:0;transform:translateY(28px)}to{opacity:1;transform:translateY(0)}}
@keyframes spin{to{transform:rotate(360deg)}}
@keyframes modalIn{from{opacity:0;transform:scale(0.9)translateY(20px)}to{opacity:1;transform:scale(1)translateY(0)}}
@keyframes toastIn{from{opacity:0;transform:translateX(30px)}to{opacity:1;transform:translateX(0)}}
@keyframes slideDown{from{opacity:0;transform:translateY(-10px)}to{opacity:1;transform:translateY(0)}}

@media(max-width:900px){.hero-content{grid-template-columns:1fr;}.hero-visual,.about-visual{display:none;}.footer-top{grid-template-columns:1fr 1fr;}.nav{display:none;}.hamburger{display:flex;}}
@media(max-width:600px){.logo-text{display:none;}.contact-grid{grid-template-columns:1fr;}.footer-top{grid-template-columns:1fr;}.hero-cta{flex-direction:column;}.btn-primary,.btn-secondary{width:100%;justify-content:center;}.form-row{grid-template-columns:1fr;}.cats-grid{grid-template-columns:1fr;}.products-grid{grid-template-columns:1fr;}}
</style>
</head>
<body>

<header id="header">
  <div class="header-inner">
    <div class="logo" onclick="navigateTo('home')">
      <div class="logo-icon"><i class="fa-solid fa-store"></i></div>
      <div class="logo-text">
        <span class="logo-main">DELEUMASSHOP</span>
        <span class="logo-sub">Ari-Village, Douala</span>
      </div>
    </div>
    <nav class="nav" id="desktopNav">
      <a class="nav-link active" data-section="home" onclick="navigateTo('home')"><i class="fa-solid fa-house"></i><span>Accueil</span></a>
      <a class="nav-link" data-section="produits" onclick="navigateTo('produits')"><i class="fa-solid fa-bag-shopping"></i><span>Boutique</span></a>
      <a class="nav-link" data-section="contact" onclick="navigateTo('contact')"><i class="fa-solid fa-location-dot"></i><span>Contact</span></a>
    </nav>
    <div class="header-actions">
      <div class="user-badge" id="userBadge">
        <i class="fa-solid fa-circle-user"></i>
        <span id="userBadgeName"></span>
        <i class="fa-solid fa-chevron-down" style="font-size:10px;cursor:pointer" onclick="logout()"></i>
      </div>
      <button class="btn-login" id="loginBtn" onclick="openModal()"><i class="fa-regular fa-circle-user"></i> Connexion</button>
      <div class="hamburger" id="hamburger" onclick="toggleMobileNav()"><span></span><span></span><span></span></div>
    </div>
  </div>
</header>

<nav class="mobile-nav" id="mobileNav">
  <a class="mobile-nav-link active" data-section="home" onclick="navigateTo('home');toggleMobileNav()"><i class="fa-solid fa-house"></i> Accueil</a>
  <a class="mobile-nav-link" data-section="produits" onclick="navigateTo('produits');toggleMobileNav()"><i class="fa-solid fa-bag-shopping"></i> Boutique</a>
  <a class="mobile-nav-link" data-section="contact" onclick="navigateTo('contact');toggleMobileNav()"><i class="fa-solid fa-location-dot"></i> Contact</a>
</nav>

<div class="sections-wrapper">

  <!-- HOME -->
  <section class="section-page active" id="section-home">
    <div class="hero">
      <div class="hero-bg"></div>
      <div class="hero-circles"></div>
      <div class="hero-content">
        <div class="hero-left">
          <div class="hero-tag"><i class="fa-solid fa-location-dot"></i> Ari-Village, NGODI BAKOKO — Douala</div>
          <h1 class="hero-title">Votre boutique<br><span class="grad">tendance &</span><br>bien-être</h1>
          <p class="hero-desc">Boissons fraîches, <strong>bijoux élégants</strong> et produits cosmétiques <strong>Longrich</strong> de qualité. Tout ce dont vous avez besoin, au carrefour Barrière à Douala.</p>
          <div class="hero-cta">
            <button class="btn-primary" onclick="navigateTo('produits')"><i class="fa-solid fa-bag-shopping"></i> Découvrir la boutique</button>
            <button class="btn-secondary" onclick="navigateTo('contact')"><i class="fa-brands fa-whatsapp"></i> Nous contacter</button>
          </div>
        </div>
        <div class="hero-visual">
          <div class="float-card">
            <div class="float-card-icon"><i class="fa-solid fa-sparkles"></i></div>
            <div><h4>Cosmétiques Longrich</h4><p>Produits phares de beauté & bien-être</p></div>
          </div>
          <div class="float-card">
            <div class="float-card-icon" style="color:var(--bleu)"><i class="fa-solid fa-gem"></i></div>
            <div><h4>Bijoux</h4><p>Collections élégantes</p></div>
          </div>
          <div class="float-card">
            <div class="float-card-icon" style="color:var(--vert)"><i class="fa-solid fa-wine-bottle"></i></div>
            <div><h4>Boissons</h4><p>Fraîches & variées</p></div>
          </div>
        </div>
      </div>
    </div>

    <div class="cat-strip">
      <div class="strip-inner">
        <div class="sec-badge"><i class="fa-solid fa-grid-2"></i> Nos rayons</div>
        <h2 class="sec-heading">Explorez notre <span>boutique</span></h2>
        <div class="cats-grid" id="homeCatsGrid"><div class="loading"><div class="spinner"></div></div></div>
      </div>
    </div>

    <div class="about-strip">
      <div class="about-inner">
        <div class="about-text-content">
          <div class="sec-badge"><i class="fa-solid fa-store"></i> Notre boutique</div>
          <h2 class="sec-heading" style="margin-bottom:20px">À propos de<br><span>DELEUMASSHOP</span></h2>
          <p>DELEUMASSHOP est votre supérette de quartier à Ari-Village, NGODI BAKOKO, à Douala. Nous proposons une sélection soignée de boissons, de bijoux tendance et de produits cosmétiques de la marque <strong>Longrich</strong>.</p>
          <p>Idéalement situés <strong>avant le carrefour Barrière</strong>, nous vous accueillons chaleureusement tous les jours.</p>
          <div class="about-list">
            <div class="about-item"><div class="about-item-icon g"><i class="fa-solid fa-spray-can-sparkles"></i></div><span>Cosmétiques Longrich certifiés & authentiques</span></div>
            <div class="about-item"><div class="about-item-icon b"><i class="fa-solid fa-gem"></i></div><span>Bijoux de qualité pour toutes les occasions</span></div>
            <div class="about-item"><div class="about-item-icon g"><i class="fa-solid fa-wine-bottle"></i></div><span>Large choix de boissons fraîches</span></div>
            <div class="about-item"><div class="about-item-icon b"><i class="fa-brands fa-whatsapp"></i></div><span>Commandes disponibles via WhatsApp</span></div>
          </div>
        </div>
        <div class="about-visual">
          <div class="about-card-main">
            <i class="fa-solid fa-store"></i>
            <h4>DELEUMASSHOP</h4>
            <p>Ari-Village, NGODI BAKOKO<br>Avant carrefour Barrière — Douala</p>
          </div>
          <div class="about-floating"><div class="num">3</div><div class="lbl">Univers</div></div>
        </div>
      </div>
    </div>
  </section>

  <!-- PRODUITS -->
  <section class="section-page" id="section-produits">
    <div class="products-inner">
      <div style="margin-bottom:36px">
        <div class="sec-badge"><i class="fa-solid fa-bag-shopping"></i> Catalogue</div>
        <h2 class="sec-heading" style="margin-bottom:4px">Notre <span>Boutique</span></h2>
        <p style="color:var(--gris);font-size:15px">Découvrez tous nos produits soigneusement sélectionnés.</p>
      </div>
      <div class="db-warn" id="dbWarn"><i class="fa-solid fa-triangle-exclamation"></i> Connexion base de données impossible. Vérifiez config.php.</div>
      <div class="filter-bar" id="filterBar">
        <button class="filter-btn active" data-cat="0" onclick="filterProd(0,this)"><i class="fa-solid fa-border-all"></i> Tout voir</button>
      </div>
      <div class="products-grid" id="productsGrid"><div class="loading"><div class="spinner"></div></div></div>
    </div>
  </section>

  <!-- CONTACT -->
  <section class="section-page" id="section-contact">
    <div class="contact-inner">
      <div class="sec-badge"><i class="fa-solid fa-location-dot"></i> Nous trouver</div>
      <h2 class="sec-heading" style="margin-bottom:6px">Nous <span>Contacter</span></h2>
      <p style="color:var(--gris);font-size:15px">Venez nous rendre visite ou écrivez-nous sur WhatsApp !</p>
      <div class="contact-grid">
        <div class="contact-card">
          <div class="contact-icon"><i class="fa-solid fa-location-dot"></i></div>
          <div><div class="contact-label">Adresse</div><div class="contact-value">Ari-Village, NGODI BAKOKO<br><strong>Avant le carrefour Barrière</strong><br>Douala, Cameroun</div></div>
        </div>
        <div class="contact-card">
          <div class="contact-icon"><i class="fa-solid fa-phone"></i></div>
          <div><div class="contact-label">Téléphones</div><div class="contact-value">
            <a href="tel:+237695939037">+237 695 93 90 37</a><br>
            <a href="tel:+237675949522">+237 675 94 95 22</a><br>
            <a href="tel:+237650592255">+237 650 59 22 55</a>
          </div></div>
        </div>
        <div class="contact-card">
          <div class="contact-icon"><i class="fa-regular fa-clock"></i></div>
          <div><div class="contact-label">Horaires</div><div class="contact-value" style="font-size:14px">Lundi – Samedi : 7h – 21h<br>Dimanche : 8h – 18h<br><span style="font-size:12px;color:var(--gris)">Ouvert tous les jours</span></div></div>
        </div>
        <div class="contact-card">
          <div class="contact-icon" style="background:linear-gradient(135deg,#25D366,#20c55e)"><i class="fa-brands fa-whatsapp"></i></div>
          <div style="flex:1">
            <div class="contact-label">WhatsApp</div>
            <div class="contact-value" style="font-size:14px;margin-bottom:14px">Commandez ou posez vos questions directement sur WhatsApp.</div>
            <a href="https://wa.me/237695939037?text=Bonjour%20DELEUMASSHOP%2C%20je%20souhaite%20des%20informations%20sur%20vos%20produits." target="_blank" class="wa-btn"><i class="fa-brands fa-whatsapp"></i> Écrire sur WhatsApp</a>
          </div>
        </div>
        <div class="map-ph">
          <i class="fa-solid fa-map-location-dot"></i>
          <span>Ari-Village, NGODI BAKOKO — Douala</span>
          <a href="https://maps.google.com?q=Ngodi+Bakoko+Douala+Cameroun" target="_blank"><i class="fa-solid fa-external-link-alt"></i> Voir sur Google Maps</a>
        </div>
      </div>
    </div>
  </section>
</div>

<footer>
  <div class="footer-inner">
    <div class="footer-top">
      <div class="footer-brand">
        <div class="logo" style="cursor:default">
          <div class="logo-icon"><i class="fa-solid fa-store"></i></div>
          <div class="logo-text"><span class="logo-main" style="color:white">DELEUMASSHOP</span><span class="logo-sub">Ari-Village, Douala</span></div>
        </div>
        <p>Votre boutique de quartier — Boissons, Bijoux & Cosmétiques Longrich. Ari-Village, NGODI BAKOKO, Douala.</p>
      </div>
      <div class="footer-col">
        <h4>Navigation</h4>
        <div class="footer-links">
          <a class="footer-link" onclick="navigateTo('home')"><i class="fa-solid fa-chevron-right"></i> Accueil</a>
          <a class="footer-link" onclick="navigateTo('produits')"><i class="fa-solid fa-chevron-right"></i> Boutique</a>
          <a class="footer-link" onclick="navigateTo('contact')"><i class="fa-solid fa-chevron-right"></i> Contact</a>
        </div>
      </div>
      <div class="footer-col">
        <h4>Contact</h4>
        <div class="footer-links">
          <a class="footer-link" href="tel:+237695939037"><i class="fa-solid fa-phone"></i> 695 93 90 37</a>
          <a class="footer-link" href="tel:+237675949522"><i class="fa-solid fa-phone"></i> 675 94 95 22</a>
          <a class="footer-link" href="https://wa.me/237695939037" target="_blank"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
          <span class="footer-link" style="cursor:default"><i class="fa-solid fa-location-dot"></i> Ari-Village, Douala</span>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <span class="footer-copy">© 2025 DELEUMASSHOP — Tous droits réservés</span>
      <a href="https://wa.me/237695939037" target="_blank" class="footer-wa"><i class="fa-brands fa-whatsapp"></i> WhatsApp : 695 93 90 37</a>
    </div>
  </div>
</footer>

<!-- MODAL CONNEXION -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModalOutside(event)">
  <div class="modal">
    <div class="modal-head">
      <div class="modal-logo"><i class="fa-solid fa-store"></i></div>
      <h3 class="modal-title">DELEUMASSHOP</h3>
      <p class="modal-subtitle">Connectez-vous ou créez un compte</p>
      <button class="modal-close" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-tabs">
      <div class="modal-tab active" onclick="switchTab('login')">Connexion</div>
      <div class="modal-tab" onclick="switchTab('register')">Créer un compte</div>
    </div>
    <div class="modal-body">
      <form class="modal-form active" id="formLogin" onsubmit="doLogin(event)">
        <div class="form-group"><label class="form-label">Email ou identifiant</label><input type="text" class="form-input" id="loginNom" placeholder="votre@email.com" required/></div>
        <div class="form-group"><label class="form-label">Mot de passe</label><input type="password" class="form-input" id="loginMdp" placeholder="••••••••" required/></div>
        <button type="submit" class="btn-submit"><i class="fa-solid fa-arrow-right-to-bracket"></i> Se connecter</button>
        <div class="form-msg" id="loginMsg"></div>
      </form>
      <form class="modal-form" id="formRegister" onsubmit="doRegister(event)">
        <div class="form-row">
          <div class="form-group"><label class="form-label">Nom *</label><input type="text" class="form-input" id="regNom" placeholder="Dupont" required/></div>
          <div class="form-group"><label class="form-label">Prénom</label><input type="text" class="form-input" id="regPrenom" placeholder="Marie"/></div>
        </div>
        <div class="form-group"><label class="form-label">Email *</label><input type="email" class="form-input" id="regEmail" placeholder="votre@email.com" required/></div>
        <div class="form-group"><label class="form-label">Téléphone</label><input type="tel" class="form-input" id="regTel" placeholder="+237 6XX XXX XXX"/></div>
        <div class="form-group"><label class="form-label">Mot de passe * (min. 6)</label><input type="password" class="form-input" id="regMdp" placeholder="••••••••" required/></div>
        <button type="submit" class="btn-submit"><i class="fa-solid fa-user-plus"></i> Créer mon compte</button>
        <div class="form-msg" id="registerMsg"></div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL PRODUIT -->
<div class="modal-overlay" id="modalProduit" onclick="closeProdModal(event)">
  <div class="modal" style="max-width:480px">
    <div class="modal-head" style="padding:16px 20px">
      <button class="modal-close" onclick="closeProdModal()"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="modal-body" style="padding-top:0">
      <div id="modalProdContent"></div>
      <a id="prodWA" href="#" target="_blank" class="wa-btn"><i class="fa-brands fa-whatsapp"></i> Renseigner sur ce produit</a>
    </div>
  </div>
</div>

<div class="toast-cont" id="toastCont"></div>

<script>
const API='api.php',AUTH='auth.php';
let currentSection='home',allProducts=[],categories=[];
const catStyles=['green','blue','teal'];

function navigateTo(s){
  if(s===currentSection)return;
  const cur=document.getElementById('section-'+currentSection);
  cur.classList.add('leaving');cur.classList.remove('active');
  setTimeout(()=>cur.classList.remove('leaving'),450);
  document.getElementById('section-'+s).classList.add('active');
  currentSection=s;
  document.querySelectorAll('.nav-link,.mobile-nav-link').forEach(el=>el.classList.toggle('active',el.dataset.section===s));
  if(s==='produits'&&!allProducts.length)loadProducts();
  window.scrollTo({top:0,behavior:'smooth'});
}
function toggleMobileNav(){document.getElementById('mobileNav').classList.toggle('open');document.getElementById('hamburger').classList.toggle('open');}
window.addEventListener('scroll',()=>document.getElementById('header').classList.toggle('scrolled',window.scrollY>30));

async function loadHomeCategories(){
  const grid=document.getElementById('homeCatsGrid');
  try{
    const r=await fetch(API+'?action=categories');const d=await r.json();
    if(!d.success||!d.data.length){grid.innerHTML='<div class="empty-state"><i class="fa-solid fa-box-open"></i><p>Aucune catégorie</p></div>';return;}
    categories=d.data;
    grid.innerHTML=categories.map((c,i)=>`
      <div class="cat-card ${catStyles[i%3]}" onclick="navigateTo('produits');setTimeout(()=>filterProd(${c.id},null),400)">
        ${i===0?'<span class="cat-badge">Populaire</span>':''}
        ${i===2?'<span class="cat-badge" style="background:#0d9488">Longrich</span>':''}
        <div class="cat-card-icon"><i class="fa-solid ${c.icone||'fa-box'}"></i></div>
        <div class="cat-card-info"><h3>${escH(c.nom)}</h3><p>${escH(c.description||'')}</p></div>
        <div class="cat-arrow"><i class="fa-solid fa-chevron-right"></i></div>
      </div>`).join('');
  }catch(e){grid.innerHTML='<div class="empty-state"><i class="fa-solid fa-triangle-exclamation"></i><p>Erreur de chargement</p></div>';}
}

async function loadProducts(){
  const grid=document.getElementById('productsGrid');
  grid.innerHTML='<div class="loading"><div class="spinner"></div></div>';
  try{
    if(!categories.length){
      const cr=await fetch(API+'?action=categories');const cd=await cr.json();
      if(cd.success){categories=cd.data;const fb=document.getElementById('filterBar');
        categories.forEach(c=>{const b=document.createElement('button');b.className='filter-btn';b.dataset.cat=c.id;b.innerHTML=`<i class="fa-solid ${c.icone||'fa-box'}"></i> ${escH(c.nom)}`;b.onclick=function(){filterProd(c.id,this)};fb.appendChild(b);});}
    }
    const r=await fetch(API+'?action=produits');const d=await r.json();
    if(!d.success)throw new Error();
    document.getElementById('dbWarn').style.display='none';
    allProducts=d.data||[];renderProducts(allProducts);
  }catch(e){document.getElementById('dbWarn').style.display='block';grid.innerHTML='<div class="empty-state"><i class="fa-solid fa-plug-circle-xmark"></i><p>Impossible de charger les produits</p></div>';}
}
function renderProducts(products){
  const grid=document.getElementById('productsGrid');
  if(!products.length){grid.innerHTML='<div class="empty-state"><i class="fa-solid fa-box-open"></i><p>Aucun produit dans cette catégorie</p></div>';return;}
  grid.innerHTML=products.map((p,i)=>`
    <div class="product-card" style="animation-delay:${i*0.06}s" onclick="openProduit(${p.id})">
      ${p.image?`<img class="product-img" src="${escH(p.image)}" alt="${escH(p.nom)}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">`:'' }
      <div class="product-img-ph" ${p.image?'style="display:none"':''}><i class="fa-solid ${p.categorie_icone||'fa-box'}"></i></div>
      <div class="product-body">
        <div class="product-cat"><i class="fa-solid ${escH(p.categorie_icone||'fa-box')}"></i>${escH(p.categorie_nom||'')}</div>
        <div class="product-name">${escH(p.nom)}</div>
        ${p.description?`<div class="product-desc">${escH(p.description)}</div>`:''}
        <div class="product-footer">
          ${p.prix?`<div class="product-price">${parseFloat(p.prix).toLocaleString('fr-FR')} <span>FCFA / ${escH(p.unite||'unité')}</span></div>`:`<div class="product-price noprice">Prix sur demande</div>`}
          <button class="btn-detail">Détails</button>
        </div>
      </div>
    </div>`).join('');
}
function filterProd(catId,btn){
  document.querySelectorAll('.filter-btn').forEach(b=>b.classList.remove('active'));
  if(btn)btn.classList.add('active');
  else{const t=document.querySelector(`.filter-btn[data-cat="${catId}"]`);if(t)t.classList.add('active');}
  renderProducts(catId===0?allProducts:allProducts.filter(p=>parseInt(p.categorie_id)===parseInt(catId)));
}
function openProduit(id){
  const p=allProducts.find(x=>x.id==id);if(!p)return;
  document.getElementById('modalProdContent').innerHTML=`
    ${p.image?`<img class="mprod-img" src="${escH(p.image)}" alt="" onerror="this.style.display='none'">`:`<div style="height:100px;background:linear-gradient(135deg,var(--vert-pale),var(--bleu-pale));border-radius:14px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;font-size:52px;color:rgba(22,163,74,0.3)"><i class="fa-solid ${p.categorie_icone||'fa-box'}"></i></div>`}
    <div class="mprod-cat"><i class="fa-solid ${escH(p.categorie_icone||'fa-box')}"></i> ${escH(p.categorie_nom||'')}</div>
    <div class="mprod-name">${escH(p.nom)}</div>
    ${p.description?`<div class="mprod-desc">${escH(p.description)}</div>`:''}
    ${p.prix?`<div class="mprod-price">${parseFloat(p.prix).toLocaleString('fr-FR')} FCFA <span style="font-size:14px;color:var(--gris);font-weight:400;font-family:'Nunito',sans-serif">/ ${escH(p.unite||'unité')}</span></div>`:'<div style="color:var(--gris);font-size:14px;margin-bottom:16px">Prix disponible sur demande</div>'}`;
  const msg=`Bonjour DELEUMASSHOP, je souhaite des informations sur : *${p.nom}*`;
  document.getElementById('prodWA').href=`https://wa.me/237695939037?text=${encodeURIComponent(msg)}`;
  document.getElementById('modalProduit').classList.add('open');
}
function closeProdModal(e){if(!e||e.target===document.getElementById('modalProduit'))document.getElementById('modalProduit').classList.remove('open');}

function openModal(){document.getElementById('modalOverlay').classList.add('open');switchTab('login');}
function closeModal(){document.getElementById('modalOverlay').classList.remove('open');}
function closeModalOutside(e){if(e.target===document.getElementById('modalOverlay'))closeModal();}
function switchTab(t){
  document.querySelectorAll('.modal-tab').forEach((el,i)=>el.classList.toggle('active',(i===0&&t==='login')||(i===1&&t==='register')));
  document.getElementById('formLogin').classList.toggle('active',t==='login');
  document.getElementById('formRegister').classList.toggle('active',t==='register');
}
async function doLogin(e){
  e.preventDefault();const msg=document.getElementById('loginMsg');msg.className='form-msg';msg.textContent='Connexion...';
  const fd=new FormData();fd.append('action','login');fd.append('nom',document.getElementById('loginNom').value);fd.append('password',document.getElementById('loginMdp').value);
  try{const r=await fetch(AUTH,{method:'POST',body:fd});const d=await r.json();
    if(d.success){if(d.role==='admin'){window.location.href=d.redirect;}else{setUser(d.nom);closeModal();toast('Bienvenue '+d.nom+' !','success');}}
    else{msg.className='form-msg error';msg.textContent=d.message||'Identifiants incorrects';}
  }catch{msg.className='form-msg error';msg.textContent='Erreur de connexion';}
}
async function doRegister(e){
  e.preventDefault();const msg=document.getElementById('registerMsg');msg.className='form-msg';msg.textContent='Création...';
  const fd=new FormData();fd.append('action','register');fd.append('nom',document.getElementById('regNom').value);fd.append('prenom',document.getElementById('regPrenom').value);fd.append('email',document.getElementById('regEmail').value);fd.append('telephone',document.getElementById('regTel').value);fd.append('password',document.getElementById('regMdp').value);
  try{const r=await fetch(AUTH,{method:'POST',body:fd});const d=await r.json();
    if(d.success){msg.className='form-msg success';msg.textContent=d.message;setTimeout(()=>switchTab('login'),1500);}
    else{msg.className='form-msg error';msg.textContent=d.message;}
  }catch{msg.className='form-msg error';msg.textContent='Erreur serveur';}
}
async function checkSession(){try{const r=await fetch(AUTH+'?action=status');const d=await r.json();if(d.logged&&d.role==='user')setUser(d.nom);}catch{}}
function setUser(nom){document.getElementById('loginBtn').style.display='none';const b=document.getElementById('userBadge');b.style.display='flex';document.getElementById('userBadgeName').textContent=nom;}
async function logout(){await fetch(AUTH+'?action=logout');document.getElementById('loginBtn').style.display='';document.getElementById('userBadge').style.display='none';toast('Déconnecté','info');}
function toast(msg,type='info'){const c=document.getElementById('toastCont');const t=document.createElement('div');t.className=`toast ${type}`;const icons={success:'fa-check-circle',error:'fa-times-circle',info:'fa-info-circle'};t.innerHTML=`<i class="fa-solid ${icons[type]}"></i> ${msg}`;c.appendChild(t);setTimeout(()=>t.remove(),3500);}
function escH(s){if(!s)return'';return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');}

document.addEventListener('DOMContentLoaded',()=>{loadHomeCategories();checkSession();fetch(API+'?action=enregistrer_visite').catch(()=>{});});
</script>
</body>
</html>
