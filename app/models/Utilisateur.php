<?php
require_once 'config/db.php';

class Utilisateur {


    // Fonction pour créer un compte
    public static function creerCompte($prenom, $nom, $email, $motdepasse) {
        $pdo = Database::getConnection();
    
        // Vérifier si l'email est déjà utilisé
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $existe = $stmt->fetchColumn();
    
        if ($existe > 0) {
            return "Cette adresse e-mail est déjà utilisée.";
        }
    
        // Insérer le nouvel utilisateur
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (prenom, nom, email, mot_de_passe) VALUES (?, ?, ?, ?)");
        $stmt->execute([$prenom, $nom, $email, $motdepasse]);
    
        return true;
    }
    

    // Fonction pour vérifier la connexion
    public static function verifier_connexion($email, $motdepasse) {
        $pdo = Database::getConnection();

        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return "Aucun compte n'est associé à cette adresse e-mail.";
        }

        // Vérifie le mot de passe en clair
        if ($user['mot_de_passe'] !== $motdepasse) {
            return "Les informations de connexion sont incorrectes.";
        }

        return $user;
    }

    public static function getId($email) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn(); // retourne l'ID ou false
    }

    // Fonction pour récupérer les informations d'un utilisateur par son ID
    public static function getUtilisateurID($utilisateur_id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE utilisateur_id = ?");
        $stmt->execute([$utilisateur_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateSolde($utilisateur_id, $nouveauSolde, $db) {
    $sql = "UPDATE utilisateurs SET solde = :solde WHERE utilisateur_id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':solde', $nouveauSolde);
    $stmt->bindValue(':id', $utilisateur_id);
    return $stmt->execute();
}

    
}
