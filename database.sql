 

CREATE TABLE IF NOT EXISTS administrateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100),
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    telephone VARCHAR(20),
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    statut ENUM('actif','inactif') DEFAULT 'actif'
);

CREATE TABLE IF NOT EXISTS visites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(45),
    date_visite TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    page VARCHAR(100) DEFAULT 'home'
);

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    icone VARCHAR(50) DEFAULT 'fa-box',
    ordre INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categorie_id INT NOT NULL,
    nom VARCHAR(200) NOT NULL,
    description TEXT,
    image VARCHAR(500),
    prix DECIMAL(10,2),
    unite VARCHAR(50) DEFAULT 'unité',
    stock_disponible BOOLEAN DEFAULT TRUE,
    ordre INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Admin par défaut (mot de passe: yougo19 — à changer après installation)
INSERT INTO administrateurs (nom, mot_de_passe) VALUES ('yougo', '$2y$10$defaulthashwillbereplaced');

-- Catégories par défaut
INSERT INTO categories (nom, description, icone, ordre) VALUES
('Boissons', 'Jus, sodas, eaux, boissons énergisantes et alcoolisées', 'fa-wine-bottle', 1),
('Bijoux', 'Colliers, bracelets, bagues, boucles d\'oreilles et accessoires', 'fa-gem', 2),
('Cosmétiques Longrich', 'Produits de beauté, soins, parfums et cosmétiques de la marque Longrich', 'fa-spray-can-sparkles', 3);

CREATE INDEX idx_produits_categorie ON produits(categorie_id);
CREATE INDEX idx_visites_date ON visites(date_visite);
CREATE INDEX idx_utilisateurs_email ON utilisateurs(email);
