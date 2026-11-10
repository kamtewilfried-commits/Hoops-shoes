<?php
require_once 'config/db.php';

class Panier {
    public static function getPanier($utilisateur_id) {
        $pdo = Database::getConnection();
        $sql = "SELECT p.quantite, p.soulier_disponibilite_id, s.nom, s.prix, s.image_soulier, c.couleur, t.taille
            FROM paniers p
            JOIN souliers_disponible sd ON p.soulier_disponibilite_id = sd.soulier_disponibilite_id
            JOIN souliers s ON sd.soulier_id = s.soulier_id
            JOIN tailles t ON sd.taille_id = t.taille_id
            JOIN couleurs c ON sd.couleur_id = c.couleur_id
            WHERE p.utilisateur_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$utilisateur_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public static function calculerTotal($utilisateur_id) {
        $pdo = Database::getConnection();
        $sql = "SELECT SUM(s.prix * p.quantite) AS total
                FROM paniers p
                JOIN souliers_disponible sd ON p.soulier_disponibilite_id = sd.soulier_disponibilite_id
                JOIN souliers s ON sd.soulier_id = s.soulier_id
                WHERE p.utilisateur_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$utilisateur_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public static function modifierQuantite($utilisateur_id, $soulier_disponibilite_id, $action) {
        $pdo = Database::getConnection();
    
        $stmt = $pdo->prepare("SELECT quantite FROM paniers WHERE utilisateur_id = ? AND soulier_disponibilite_id = ?");
        $stmt->execute([$utilisateur_id, $soulier_disponibilite_id]);
        $ligne = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($ligne) {
            $quantite = $ligne['quantite'];
            
            // Ajoute +1 a la quantité
            if ($action === 'plus') {
                $quantite++;
                $stmt = $pdo->prepare("UPDATE paniers SET quantite = ? WHERE utilisateur_id = ? AND soulier_disponibilite_id = ?");
                $stmt->execute([$quantite, $utilisateur_id, $soulier_disponibilite_id]);

                // Soustrait -1 à la quantité
            } elseif ($action === 'moins') {
                $quantite--;
    
                if ($quantite <= 0) {
                    // Supprimer la ligne du panier
                    $stmt = $pdo->prepare("DELETE FROM paniers WHERE utilisateur_id = ? AND soulier_disponibilite_id = ?");
                    $stmt->execute([$utilisateur_id, $soulier_disponibilite_id]);
                } else {
                    // Mettre à jour la quantité
                    $stmt = $pdo->prepare("UPDATE paniers SET quantite = ? WHERE utilisateur_id = ? AND soulier_disponibilite_id = ?");
                    $stmt->execute([$quantite, $utilisateur_id, $soulier_disponibilite_id]);
                }
            }
        }
    }

    public static function getSoldeUtilisateur($utilisateur_id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT solde FROM utilisateurs WHERE utilisateur_id = ?");
        $stmt->execute([$utilisateur_id]);
        return $stmt->fetchColumn();
    }

    public static function updateSolde($utilisateur_id, $nouveau_solde) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("UPDATE utilisateurs SET solde = ? WHERE utilisateur_id = ?");
        $stmt->execute([$nouveau_solde, $utilisateur_id]);
    }

    public static function enregistrerCommande($utilisateur_id, $total) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("INSERT INTO commandes (utilisateur_id, total) VALUES (?, ?)");
        $stmt->execute([$utilisateur_id, $total]);
        return $pdo->lastInsertId(); // 
    }

    public static function viderPanier($utilisateur_id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("DELETE FROM paniers WHERE utilisateur_id = ?");
        $stmt->execute([$utilisateur_id]);
    }
    
    
    
}

?>