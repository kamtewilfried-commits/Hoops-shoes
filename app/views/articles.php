<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($shoe['nom']); ?></title>
    <link rel="stylesheet" href="public/css/article.css" />
</head>

<body>
    <form action="index.php?controller=article&action=ajouterPanier" method="POST">
        <a href="index.php" class="retour"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="contenu">
            <div class="photo">
                <img src="<?= htmlspecialchars($shoe['image_soulier']); ?>" alt="<?= htmlspecialchars($shoe['nom']); ?>" />
                <hr />
                <div class="details">
                    <h3>Détails du produit :</h3>
                    <p><?= $shoe['DESCRIPTION']; ?></p>
                </div>
            </div>

            <div class="informations">
                <h1><?= htmlspecialchars($shoe['nom']); ?></h1>
                <h1>Prix : <?= $shoe['prix']; ?>$</h1>

                <div class="selection-info">
                    <h3>Sélection actuelle</h3>
                    <p>Taille: <span id="taille-selectionnee">-</span></p>
                    <p>Couleur: <span id="couleur-selectionnee">-</span></p>
                </div>

                <p>Choisir la taille :</p>
                <div class="grid">
                    <?php foreach ($shoe['tailles'] as $taille): ?>
                        <p data-taille-id="<?= $taille['taille_id'] ?>" data-taille="<?= $taille['taille'] ?>">
                            <?= $taille['taille'] ?>
                        </p>
                    <?php endforeach; ?>
                </div>

                <p>Choisir la couleur :</p>
                <div class="couleur-grid">
                    <?php 
                    $couleurFrancais = [
                        'bleu' => 'blue',
                        'rouge' => 'red',
                        'vert' => 'green',
                        'jaune' => 'yellow',
                        'noir' => 'black',
                        'blanc' => 'white',
                    ];
                    
                    foreach ($shoe['couleurs'] as $couleur): 
                        $couleurLower = strtolower($couleur['couleur']);
                        $bgColor = isset($couleurFrancais[$couleurLower]) ? $couleurFrancais[$couleurLower] : $couleurLower;
                    ?>
                        <p 
                            data-couleur-id="<?= $couleur['couleur_id'] ?>"
                            data-couleur="<?= htmlspecialchars($couleur['couleur']) ?>"
                            class="couleur-item"
                            style="background-color: <?= $bgColor ?>;"
                        >
                            <?= htmlspecialchars($couleur['couleur']) ?>
                        </p>
                    <?php endforeach; ?>
                </div>

                <input type="hidden" name="taille_id" id="taille-input" value="" required>
                <input type="hidden" name="couleur_id" id="couleur-input" value="" required>
                <input type="hidden" name="shoe_id" value="<?= $shoe['soulier_id'] ?>">
                <button type="submit">Ajouter au panier</button>
            </div>
        </div>
    </form>
    
    <script>
        window.combinaisons = <?= json_encode($shoe['combinations'] ?? []); ?>;
    </script>
    <script src="/hoops-shoes/public/js/trier.js"></script>
</body>

</html>