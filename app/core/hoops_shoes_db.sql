        DROP DATABASE if EXISTS hoops_shoes_db;

CREATE DATABASE hoops_shoes_db;
USE hoops_shoes_db;

-- Creer un utilisateur
CREATE TABLE utilisateurs (
    utilisateur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    solde DECIMAL(10,2) DEFAULT 1200.00
);

-- Creer d'un soulier
CREATE TABLE souliers (
    soulier_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    image_soulier VARCHAR(255) NOT NULL,
    DESCRIPTION VARCHAR(10000) NOT null
);

-- Creer un commande
CREATE TABLE commandes (
    commande_id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    total DECIMAL (10,2) NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(utilisateur_id)
);

-- Tailles des souliers
CREATE TABLE tailles (
    taille_id INT AUTO_INCREMENT PRIMARY KEY,
    taille VARCHAR(10) NOT NULL
);

-- Couleurs des souliers
CREATE TABLE couleurs (
    couleur_id INT AUTO_INCREMENT PRIMARY KEY,
    couleur VARCHAR(255) NOT NULL
);

-- Disponibilite des souliers selon la taille et couleur
CREATE TABLE souliers_disponible (
    soulier_disponibilite_id INT AUTO_INCREMENT PRIMARY KEY,
    soulier_id INT,
    taille_id INT,
    couleur_id INT,
    disponible BOOLEAN DEFAULT TRUE,  -- TRUE signifie que c'est disponible
    FOREIGN KEY (soulier_id) REFERENCES souliers(soulier_id),
    FOREIGN KEY (taille_id) REFERENCES tailles(taille_id),
    FOREIGN KEY (couleur_id) REFERENCES couleurs(couleur_id)
);

-- Creation d'un panier
CREATE TABLE paniers (
    panier_id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    soulier_disponibilite_id INT NOT NULL,
    quantite INT NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(utilisateur_id),
    FOREIGN KEY (soulier_disponibilite_id) REFERENCES souliers_disponible(soulier_disponibilite_id)
);


-- Insertion des tailles
INSERT INTO tailles (taille) VALUES
('5'),
('6'),
('7'),
('8'),
('9'),
('10'),
('11'),
('12');

-- Insertion des souliers
INSERT INTO souliers (nom, prix, image_soulier, description) VALUES
('Edwards', 140.00, 'public/photo/anthony-removebg-preview.png', 'Le look stylé de l''une des stars montantes du game. Cette sneaker signature d''Anthony Edwards par adidas Basketball est conçue pour les scoreurs. La semelle intermédiaire BOOST et Lightstrike est ultra légère pour ajouter un retour d''énergie infini à chaque mouvement explosif. La semelle extérieure en caoutchouc assure tout le maintien nécessaire pour attaquer le cercle, tandis que le logo signature d''Anthony Edwards complète le look.'),
('Harden', 210.00, 'public/photo/harden-removebg.png', 'Perpétuant la légende et l''héritage du célèbre basketteur, la nouvelle chaussure signature de James Harden et adidas Basketball est destinée aux joueurs qui font la différence sur le parquet. Cette chaussure de basketball performante a été conçue pour accompagner les mouvements qui ont propulsé James Harden au rang de star. Son style unique l''a également fait connaître en dehors du terrain. La semelle intermédiaire combinant BOOST et Lightstrike offre un retour d''énergie tout en légèreté pour une détente exceptionnelle, tandis que la semelle extérieure en caoutchouc t''assure toute la traction nécessaire pour tirer de loin.'),
('Kevin', 180.00, 'public/photo/kevin-removebg.png', 'La KD 17 Slim Reaper reprend les éléments caractéristiques du modèle tout en intégrant des détails distinctifs. La tige en mesh apporte un bon compromis entre légèreté et maintien. L''ensemble est dominé par une teinte orange avec un dégradé jaune, renforcé par un cadre en TPU noir qui stabilise la structure.'),
('Kyrie', 110.00, 'public/photo/kyrie.png', 'La Kyrie 7, septième chaussure signature de Kyrie Irving, vient tout juste d''être officialisée par Nike. On vous présente les premières images et caractéristiques de la nouvelle chaussure du meneur des Brooklyn Nets.'),
('Giannis', 130.00, 'public/photo/giannis.png', 'Giannis a besoin d''une chaussure pour dominer le jeu moderne à tous les postes. C''est pourquoi nous avons amélioré le motif d''adhérence de la Giannis Freak 6. La semelle extérieure à chevrons lui permet de s''arrêter net dans les actions décisives. Et pour les statistiques, l''amorti Air Zoom lui permet de rester au top jusqu''à la fin du match.'),
('Tatum', 150.00, 'public/photo/tatum.png', 'Cette chaussure présente une structure légère enveloppée de mousse et une unité Zoom Air à l''avant-pied. Elle garantit confort et réactivité ainsi qu''un bon ressenti du terrain. La version enfant de la Tatum 1 est équipée d''un talon rétractable qui permet de mettre et de retirer la chaussure sans les mains.');

-- Insertion des couleurs
INSERT INTO couleurs (couleur) VALUES
('Blanc'),
('Noir'),
('Rouge'),
('Bleu'),
('Vert');


INSERT INTO souliers_disponible (soulier_id, taille_id, couleur_id, disponible) VALUES
-- Soulier 1
(1, 1, 1, TRUE), (1, 2, 1, FALSE), (1, 3, 1, TRUE), (1, 4, 1, TRUE),
(1, 5, 1, TRUE), (1, 6, 1, TRUE), (1, 7, 1, FALSE), (1, 8, 1, TRUE),

(1, 1, 2, TRUE), (1, 2, 2, TRUE), (1, 3, 2, TRUE), (1, 4, 2, FALSE),
(1, 5, 2, TRUE), (1, 6, 2, TRUE), (1, 7, 2, TRUE), (1, 8, 2, FALSE),

(1, 1, 3, TRUE), (1, 2, 3, TRUE), (1, 3, 3, FALSE), (1, 4, 3, TRUE),
(1, 5, 3, TRUE), (1, 6, 3, TRUE), (1, 7, 3, TRUE), (1, 8, 3, FALSE),

(1, 1, 4, TRUE), (1, 2, 4, TRUE), (1, 3, 4, TRUE), (1, 4, 4, TRUE),
(1, 5, 4, TRUE), (1, 6, 4, FALSE), (1, 7, 4, TRUE), (1, 8, 4, TRUE),

(1, 1, 5, TRUE), (1, 2, 5, FALSE), (1, 3, 5, TRUE), (1, 4, 5, TRUE),
(1, 5, 5, TRUE), (1, 6, 5, TRUE), (1, 7, 5, TRUE), (1, 8, 5, FALSE),

-- Soulier 2
(2, 1, 1, TRUE), (2, 2, 1, TRUE), (2, 3, 1, FALSE), (2, 4, 1, TRUE),
(2, 5, 1, TRUE), (2, 6, 1, TRUE), (2, 7, 1, TRUE), (2, 8, 1, FALSE),

(2, 1, 2, TRUE), (2, 2, 2, TRUE), (2, 3, 2, TRUE), (2, 4, 2, FALSE),
(2, 5, 2, TRUE), (2, 6, 2, TRUE), (2, 7, 2, TRUE), (2, 8, 2, TRUE),

(2, 1, 3, TRUE), (2, 2, 3, TRUE), (2, 3, 3, TRUE), (2, 4, 3, FALSE),
(2, 5, 3, TRUE), (2, 6, 3, TRUE), (2, 7, 3, TRUE), (2, 8, 3, TRUE),

(2, 1, 4, TRUE), (2, 2, 4, TRUE), (2, 3, 4, TRUE), (2, 4, 4, TRUE),
(2, 5, 4, FALSE), (2, 6, 4, TRUE), (2, 7, 4, TRUE), (2, 8, 4, TRUE),

(2, 1, 5, TRUE), (2, 2, 5, TRUE), (2, 3, 5, FALSE), (2, 4, 5, TRUE),
(2, 5, 5, TRUE), (2, 6, 5, TRUE), (2, 7, 5, TRUE), (2, 8, 5, TRUE),

-- Soulier 3
(3, 1, 1, TRUE), (3, 2, 1, FALSE), (3, 3, 1, TRUE), (3, 4, 1, TRUE),
(3, 5, 1, TRUE), (3, 6, 1, TRUE), (3, 7, 1, TRUE), (3, 8, 1, FALSE),

(3, 1, 2, TRUE), (3, 2, 2, TRUE), (3, 3, 2, TRUE), (3, 4, 2, FALSE),
(3, 5, 2, TRUE), (3, 6, 2, TRUE), (3, 7, 2, TRUE), (3, 8, 2, TRUE),

(3, 1, 3, TRUE), (3, 2, 3, TRUE), (3, 3, 3, TRUE), (3, 4, 3, TRUE),
(3, 5, 3, TRUE), (3, 6, 3, FALSE), (3, 7, 3, TRUE), (3, 8, 3, TRUE),

(3, 1, 4, TRUE), (3, 2, 4, TRUE), (3, 3, 4, FALSE), (3, 4, 4, TRUE),
(3, 5, 4, TRUE), (3, 6, 4, TRUE), (3, 7, 4, TRUE), (3, 8, 4, TRUE),

(3, 1, 5, TRUE), (3, 2, 5, TRUE), (3, 3, 5, TRUE), (3, 4, 5, TRUE),
(3, 5, 5, FALSE), (3, 6, 5, TRUE), (3, 7, 5, TRUE), (3, 8, 5, TRUE);

-- Soulier ID 4
INSERT INTO souliers_disponible (soulier_id, taille_id, couleur_id, disponible) VALUES
(4, 1, 1, TRUE), (4, 2, 1, TRUE), (4, 3, 1, FALSE), (4, 4, 1, TRUE),
(4, 5, 1, TRUE), (4, 6, 1, FALSE), (4, 7, 1, TRUE), (4, 8, 1, FALSE),

(4, 1, 2, FALSE), (4, 2, 2, TRUE), (4, 3, 2, TRUE), (4, 4, 2, FALSE),
(4, 5, 2, TRUE), (4, 6, 2, TRUE), (4, 7, 2, TRUE), (4, 8, 2, FALSE),

(4, 1, 3, TRUE), (4, 2, 3, FALSE), (4, 3, 3, TRUE), (4, 4, 3, TRUE),
(4, 5, 3, TRUE), (4, 6, 3, TRUE), (4, 7, 3, TRUE), (4, 8, 3, TRUE),

(4, 1, 4, TRUE), (4, 2, 4, TRUE), (4, 3, 4, FALSE), (4, 4, 4, TRUE),
(4, 5, 4, FALSE), (4, 6, 4, TRUE), (4, 7, 4, TRUE), (4, 8, 4, TRUE),

(4, 1, 5, FALSE), (4, 2, 5, TRUE), (4, 3, 5, FALSE), (4, 4, 5, TRUE),
(4, 5, 5, TRUE), (4, 6, 5, TRUE), (4, 7, 5, TRUE), (4, 8, 5, FALSE);

-- Soulier ID 5
INSERT INTO souliers_disponible (soulier_id, taille_id, couleur_id, disponible) VALUES
(5, 1, 1, TRUE), (5, 2, 1, FALSE), (5, 3, 1, TRUE), (5, 4, 1, TRUE),
(5, 5, 1, FALSE), (5, 6, 1, FALSE), (5, 7, 1, TRUE), (5, 8, 1, FALSE),

(5, 1, 2, TRUE), (5, 2, 2, FALSE), (5, 3, 2, TRUE), (5, 4, 2, FALSE),
(5, 5, 2, TRUE), (5, 6, 2, TRUE), (5, 7, 2, TRUE), (5, 8, 2, TRUE),

(5, 1, 3, TRUE), (5, 2, 3, TRUE), (5, 3, 3, FALSE), (5, 4, 3, TRUE),
(5, 5, 3, TRUE), (5, 6, 3, FALSE), (5, 7, 3, TRUE), (5, 8, 3, TRUE),

(5, 1, 4, FALSE), (5, 2, 4, TRUE), (5, 3, 4, FALSE), (5, 4, 4, TRUE),
(5, 5, 4, TRUE), (5, 6, 4, TRUE), (5, 7, 4, TRUE), (5, 8, 4, TRUE),

(5, 1, 5, TRUE), (5, 2, 5, FALSE), (5, 3, 5, TRUE), (5, 4, 5, TRUE),
(5, 5, 5, FALSE), (5, 6, 5, TRUE), (5, 7, 5, FALSE), (5, 8, 5, TRUE);

-- Soulier ID 6
INSERT INTO souliers_disponible (soulier_id, taille_id, couleur_id, disponible) VALUES
(6, 1, 1, TRUE), (6, 2, 1, FALSE), (6, 3, 1, TRUE), (6, 4, 1, TRUE),
(6, 5, 1, TRUE), (6, 6, 1, TRUE), (6, 7, 1, TRUE), (6, 8, 1, FALSE),

(6, 1, 2, TRUE), (6, 2, 2, TRUE), (6, 3, 2, TRUE), (6, 4, 2, FALSE),
(6, 5, 2, TRUE), (6, 6, 2, TRUE), (6, 7, 2, TRUE), (6, 8, 2, TRUE),

(6, 1, 3, TRUE), (6, 2, 3, TRUE), (6, 3, 3, TRUE), (6, 4, 3, TRUE),
(6, 5, 3, TRUE), (6, 6, 3, FALSE), (6, 7, 3, TRUE), (6, 8, 3, TRUE),

(6, 1, 4, TRUE), (6, 2, 4, TRUE), (6, 3, 4, FALSE), (6, 4, 4, TRUE),
(6, 5, 4, TRUE), (6, 6, 4, TRUE), (6, 7, 4, TRUE), (6, 8, 4, TRUE),

(6, 1, 5, TRUE), (6, 2, 5, TRUE), (6, 3, 5, TRUE), (6, 4, 5, TRUE),
(6, 5, 5, FALSE), (6, 6, 5, TRUE), (6, 7, 5, TRUE), (6, 8, 5, TRUE);

INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, solde) VALUES
("Myguel", "Ariel", "MyguelAriel@example.com", "test123", 1000);
