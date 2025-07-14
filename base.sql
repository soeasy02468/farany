CREATE DATABASE projetfinal;
USE projetfinal;

CREATE TABLE membrePf (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    date_de_naissance DATE,
    genre VARCHAR(1),
    email VARCHAR(100),
    ville VARCHAR(50),
    mdp VARCHAR(100),
    image_profil VARCHAR(100)
);

CREATE TABLE categorie_objetPf (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(50)
);

CREATE TABLE objetPf (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objetPf(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES membrePf(id_membre)
);

CREATE TABLE images_objetPf (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(100),
    FOREIGN KEY (id_objet) REFERENCES objetPf(id_objet)
);

CREATE TABLE empruntPf (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES objetPf(id_objet),
    FOREIGN KEY (id_membre) REFERENCES membrePf(id_membre)
);
create TABLE IMAGEPDP_Pf (
    id_membre INT,
    SOURCE VARCHAR(100),
    Date_upload Date
);

-- INSERTION des membres
INSERT INTO membrePf (nom, date_de_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice', '1995-03-12', 'F', 'alice@example.com', 'Tana', 'pass123', 'alice.jpg'),
('Bob', '1990-07-24', 'M', 'bob@example.com', 'Majunga', 'bobpass', 'bob.jpg'),
('Charlie', '1988-11-30', 'M', 'charlie@example.com', 'Toamasina', 'charliepwd', 'charlie.jpg'),
('Dina', '2000-01-05', 'F', 'dina@example.com', 'Fianarantsoa', 'dinapass', 'dina.jpg');

-- INSERTION des catégories
INSERT INTO categorie_objetPf (nom_categorie) VALUES
('esthétique'), ('bricolage'), ('mécanique'), ('cuisine');

-- INSERTION des objets : 10 objets par membre répartis sur les 4 catégories (id_categorie 1 à 4)
-- Membres 1 à 4 (id_membre)
INSERT INTO objetPf (nom_objet, id_categorie, id_membre) VALUES
-- Membre 1
('Sèche-cheveux', 1, 1), ('Tournevis', 2, 1), ('Clé anglaise', 3, 1), ('Mixeur', 4, 1),
('Crème visage', 1, 1), ('Marteau', 2, 1), ('Pince multiprise', 3, 1), ('Four', 4, 1),
('Parfum', 1, 1), ('Batteur', 4, 1),

-- Membre 2
('Brosse à cheveux', 1, 2), ('Scie', 2, 2), ('Jack hydraulique', 3, 2), ('Casserole', 4, 2),
('Rouge à lèvres', 1, 2), ('Perceuse', 2, 2), ('Clé à molette', 3, 2), ('Poêle', 4, 2),
('Mascara', 1, 2), ('Blender', 4, 2),

-- Membre 3
('Lisseur', 1, 3), ('Tournevis électrique', 2, 3), ('Cric', 3, 3), ('Robot de cuisine', 4, 3),
('Crème solaire', 1, 3), ('Pistolet à colle', 2, 3), ('Pompe à air', 3, 3), ('Four micro-ondes', 4, 3),
('Déodorant', 1, 3), ('Moulin à café', 4, 3),

-- Membre 4
('Gel coiffant', 1, 4), ('Scie sauteuse', 2, 4), ('Boulonneuse', 3, 4), ('Friteuse', 4, 4),
('Crayon yeux', 1, 4), ('Cloueuse', 2, 4), ('Pompe hydraulique', 3, 4), ('Grille-pain', 4, 4),
('Lotion', 1, 4), ('Cocotte-minute', 4, 4);

-- INSERTION de 10 emprunts (objets variés empruntés par différents membres)
INSERT INTO empruntPf (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2025-07-01', '2025-07-10'),
(5, 3, '2025-07-02', '2025-07-12'),
(10, 4, '2025-07-03', '2025-07-08'),
(15, 1, '2025-07-01', '2025-07-15'),
(20, 3, '2025-07-04', '2025-07-14'),
(25, 4, '2025-07-06', '2025-07-10'),
(30, 2, '2025-07-07', '2025-07-17'),
(35, 1, '2025-07-08', '2025-07-18'),
(38, 2, '2025-07-09', '2025-07-19'),
(40, 1, '2025-07-10', '2025-07-20');
