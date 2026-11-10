<?php

require_once 'app/models/Article.php';
class ArticleController
{
    public function chaussure()
    {

        // $shoes = Article::getAllSoulier($nom);

        if (isset($_GET['shoe'])) {
            $nom = urldecode($_GET['shoe']);
            // Traitement pour trouver le soulier dans la base de données
            $shoe = Article::getSoulier($nom);

            include 'app/views/partials/header.php';
            require "app/views/articles.php";
            include 'app/views/partials/footer.php';
        } else {
            echo "Aucun soulier sélectionné.";
        }
    }

    public function ajouterPanier()
    {
        // Vérifier si l'utilisateur est connecté
        // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
        if (!isset($_SESSION['utilisateur']['utilisateur_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
        // Récupérer l'ID de l'utilisateur à partir de la session
        $utilisateurId = $_SESSION['utilisateur']['utilisateur_id'];

        if (isset($_POST['shoe_id'], $_POST['taille_id'], $_POST['couleur_id'])) {
            $shoeId = $_POST['shoe_id'];
            $tailleId = $_POST['taille_id'];
            $couleurId = $_POST['couleur_id'];
            Article::ajouterPanier($utilisateurId, $shoeId, $tailleId, $couleurId);
        }

        // Rediriger vers la page du panier après modification
        header('Location: index.php?controller=panier&action=index');
        exit();
    }
}
