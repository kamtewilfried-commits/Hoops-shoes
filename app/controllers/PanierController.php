<?php
require_once 'app/models/Panier.php';

class PanierController {
    
    public function index() {


        // Vérifier si l'utilisateur est connecté
        // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
         if (!isset($_SESSION['utilisateur']['utilisateur_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
        // Récupérer l'ID de l'utilisateur à partir de la session
        $utilisateur_id = $_SESSION['utilisateur']['utilisateur_id'];


        $articles = Panier::getPanier($utilisateur_id);
        $total = Panier::calculerTotal($utilisateur_id);


        if (empty($articles)) {
            include 'app/views/partials/header.php';
            include 'app/views/panier/panier_vide.php';
            include 'app/views/partials/footer.php';
            
        } else {
            include 'app/views/partials/header.php';
            include 'app/views/panier/paniers.php';
            include 'app/views/partials/footer.php';
        }
    }

    public function modifierQuantite() {

        if (!isset($_SESSION['utilisateur']['utilisateur_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $utilisateur_id = $_SESSION['utilisateur']['utilisateur_id'];
    
        if (isset($_POST['soulier_disponibilite_id'], $_POST['action'])) {
            $soulier_disponibilite_id = $_POST['soulier_disponibilite_id'];
            $action = $_POST['action'];
    
            Panier::modifierQuantite($utilisateur_id, $soulier_disponibilite_id, $action);
        }
    
        // Rediriger vers la page du panier après modification
        header('Location: index.php?controller=panier&action=index');
        exit();
    }

    public function passerCommande() {
        if (!isset($_SESSION['utilisateur']['utilisateur_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        $utilisateur_id = $_SESSION['utilisateur']['utilisateur_id'];

        $total = Panier::calculerTotal($utilisateur_id);
        
        // Le solde actuel de l'utilisateur
        $solde = Panier::getSoldeUtilisateur($utilisateur_id);

        if ($solde >= $total) {
            
                // Déduire le montant du solde de l'utilisateur
                Panier::updateSolde($utilisateur_id, $solde - $total);

                // Enregistre commande dans la table commandes
                $commande_id = Panier::enregistrerCommande($utilisateur_id, $total);

                // Vider panier
                Panier::viderPanier($utilisateur_id);

                
            require_once 'app/models/Utilisateur.php';
            $utilisateur = Utilisateur::getUtilisateurID($utilisateur_id);

            // ✅ Met à jour la session utilisateur avec le nouveau solde
            $_SESSION['utilisateur']['solde'] = $utilisateur['solde'];

            include 'app/views/panier/panier_confirmer.php';
            exit();
                
            
        } else {
            $articles = Panier::getPanier($utilisateur_id);
            $total = Panier::calculerTotal($utilisateur_id);
            $messageErreur = "Solde insuffisant. Veuillez ajouter des fonds à votre compte.";

            include 'app/views/partials/header.php';
            include 'app/views/panier/paniers.php';
            include 'app/views/partials/footer.php';
        }
    }

    
    
}
?>
