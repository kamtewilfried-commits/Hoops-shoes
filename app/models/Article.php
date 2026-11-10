<?php
require_once 'config/db.php';

class Article
{
    public static function getAllSoulier()
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM souliers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getSoulier($nom)
    {
        $pdo = Database::getConnection();
        // details du souliers
        $stmt = $pdo->prepare("SELECT * FROM souliers Where nom = ?");
        $stmt->execute([$nom]);
        $shoe = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($shoe) {
            $soulierId = $shoe['soulier_id'];
            
            // Requête pour trouver les tailles disponibles
            $tailleDispoStmt = $pdo->prepare("
                SELECT DISTINCT sd.taille_id, t.taille
                FROM souliers_disponible sd
                JOIN tailles t ON sd.taille_id = t.taille_id
                WHERE sd.soulier_id = ? AND sd.disponible = TRUE
                ORDER BY t.taille_id
            ");
            $tailleDispoStmt->execute([$soulierId]);
            $shoe['tailles'] = $tailleDispoStmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Requête pour trouver les couleurs disponibles
            $couleurDispoStmt = $pdo->prepare("
                SELECT DISTINCT sd.couleur_id, c.couleur 
                FROM souliers_disponible sd 
                JOIN couleurs c ON sd.couleur_id = c.couleur_id
                WHERE sd.soulier_id = ? AND sd.disponible = TRUE
                ORDER BY c.couleur_id
            ");
            $couleurDispoStmt->execute([$soulierId]);
            $shoe['couleurs'] = $couleurDispoStmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Requête pour toutes les combinaison disponibles (pour le JavaScript)
            $combinationsStmt = $pdo->prepare("
                SELECT sd.taille_id, t.taille, sd.couleur_id, c.couleur
                FROM souliers_disponible sd
                JOIN tailles t ON sd.taille_id = t.taille_id
                JOIN couleurs c ON sd.couleur_id = c.couleur_id
                WHERE sd.soulier_id = ? AND sd.disponible = TRUE
                ORDER BY t.taille_id, c.couleur_id
            ");
            $combinationsStmt->execute([$soulierId]);
            $shoe['combinations'] = $combinationsStmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $shoe;
    }

    public static function ajouterPanier($utilisateurId, $shoeId, $tailleId, $couleurId)
    {
        $pdo = Database::getConnection();
        
        // Vérifier que les paramètres ne sont pas vides
        if (empty($tailleId) || empty($couleurId)) {
            throw new Exception("Veuillez sélectionner une taille et une couleur.");
        }
        
        // Trouver le soulier basé sur l'id, taille et couleur
        $stmt = $pdo->prepare(
            "SELECT soulier_disponibilite_id
            FROM souliers_disponible
            WHERE soulier_id = ? AND taille_id = ? AND couleur_id = ? AND disponible = TRUE"
        );
        $stmt->execute([$shoeId, $tailleId, $couleurId]);
        $shoe_dispo = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si le soulier est disponible
        if ($shoe_dispo) {
            $disponibiliteId = $shoe_dispo["soulier_disponibilite_id"];

            // Vérifier si l'article est déjà dans le panier
            $checkStmt = $pdo->prepare(
                "SELECT panier_id, quantite FROM paniers 
                WHERE utilisateur_id = ? AND soulier_disponibilite_id = ?"
            );
            $checkStmt->execute([$utilisateurId, $disponibiliteId]);
            $existingItem = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if ($existingItem) {
                // Mettre à jour la quantité
                $newQuantity = $existingItem['quantite'] + 1;
                $updateStmt = $pdo->prepare(
                    "UPDATE paniers SET quantite = ? WHERE panier_id = ?"
                );
                $updateStmt->execute([$newQuantity, $existingItem['panier_id']]);
                return "Quantité mise à jour dans le panier.";
            } else {
                // Insérer le soulier dans le panier
                $stmt = $pdo->prepare(
                    "INSERT INTO paniers (utilisateur_id, soulier_disponibilite_id, quantite) VALUES (?, ?, ?)"
                );
                $stmt->execute([$utilisateurId, $disponibiliteId, 1]);
                return "Soulier ajouté au panier avec succès.";
            }
        } else {
            throw new Exception("Cette combinaison taille/couleur n'est pas disponible.");
        }
    }
}