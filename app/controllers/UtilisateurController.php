<?php
require_once 'app/models/Utilisateur.php';

class UtilisateurController {

    // Affiche le formulaire + traite la création de compte
    public function index() {
        $message = null;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $prenom = $_POST['prenom'] ?? '';
            $nom = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';
            $motdepasse = $_POST['motdepasse'] ?? '';
    
            $resultat = Utilisateur::creerCompte($prenom, $nom, $email, $motdepasse);
    
            if ($resultat === true) {
                // Redirection après création de compte réussie
                header('Location: index.php?controller=home');
                exit;
            } else {
                // Affiche le message d'erreur dans le formulaire
                $message = $resultat;
            }
        }
    
        // Affiche le formulaire dans tous les cas sauf redirection
        require 'app/views/utilisateurs/creerCompte.php';
    }
    
    

    // Affiche le formulaire de connexion et traite la connexion
    public function connexion() {
        $erreur = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $motdepasse = $_POST['motdepasse'] ?? '';

            $utilisateur = Utilisateur::verifier_connexion($email, $motdepasse);

            if (is_array($utilisateur)) {
                $_SESSION['utilisateur'] = $utilisateur;
                header('Location: index.php?controller=home');
                exit;
            } else {
                $erreur = $utilisateur ?? "Identifiants incorrects.";
            }
        }

        require 'app/views/utilisateurs/connexion.php';
    }

    public function deconnexion() {
    if (isset($_SESSION['utilisateur']['utilisateur_id'])) {
        $utilisateur_id = $_SESSION['utilisateur']['utilisateur_id'];
        $db = new PDO('mysql:host=localhost;dbname=hoops_shoes_db;charset=utf8', 'root', 'crosemont');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        Utilisateur::updateSolde($utilisateur_id, 1000, $db);
    }
    session_destroy();
    header("Location: index.php?controller=utilisateur&action=connexion");
    exit();
}

}
