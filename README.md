# Hoops & Shoes

Boutique en ligne de chaussures de basketball, réalisée en équipe dans le cadre d'un cours de développement web au Cégep Rosemont.

## Fonctionnalités

- Page d'accueil et catalogue d'articles avec tri
- Panier d'achat et confirmation de commande
- Création de compte et connexion

## Technologies

PHP, MySQL, JavaScript, HTML5, CSS3. Les maquettes ont été conçues avec Figma.

## Structure du projet

- `app/controllers`, `app/models`, `app/views` : logique de l'application
- `app/core/hoops_shoes_db.sql` : script de création de la base de données
- `public/` : feuilles de style, scripts et images
- `config/db.example.php` : modèle de configuration de la base de données
- `index.php` : point d'entrée

## Installation

1. Importer `app/core/hoops_shoes_db.sql` dans MySQL.
2. Copier `config/db.example.php` en `config/db.php`, puis y mettre les identifiants de votre base de données.
3. Placer le dossier dans votre serveur local (XAMPP, WAMP ou MAMP) et ouvrir `index.php` dans le navigateur.
