<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="public/css/panier.css">

<?php if (!empty($messageErreur)): ?>
    <div class="message-erreur">
        <?= htmlspecialchars($messageErreur) ?>
    </div>
<?php endif; ?>

<div class="page-panier">
    <h3>Votre Panier</h3>
    
    <div class="panier-container">
        <div class="panier-gauche">
            <?php foreach ($articles as $article): ?>
                <div class="panier-item-wrapper">
                    <div class="panier-item">
                        <img class="img-panier" src="<?= $article['image_soulier'] ?>">
    
                        <div class="panier-info">
                            <div class="ligne-nom-prix">
                                <p class="nom-produit"><?= $article['nom'] ?></p>
                                <p class="prix-produit"><?= number_format($article['prix'], 2) ?> $</p>
                            </div>
                            <p><?= $article['couleur'] ?></p>
                            <p>Taille : <?= $article['taille'] ?></p>
    
    
    
                            <form action="index.php?controller=panier&action=modifierQuantite" method="post">
                                <input type="hidden" name="soulier_disponibilite_id" value="<?= $article['soulier_disponibilite_id'] ?>" />
                                <div class="btn-quantite">
                                    <button type="submit" name="action" value="moins">-</button>
                                    <span><?= $article['quantite'] ?></span>
                                    <button type="submit" name="action" value="plus">+</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr class="ligne-produit">
                </div>
            <?php endforeach; ?>
        </div>
    
        <div class="recapitulatif">
            <h2>Recapulatif</h2>
            <p>Sous-total : <span><?= number_format($total, 2) ?></span></p>
            <p>Frais de livraison : <span>Gratuit</span></p>
            <p>Tax : <span>Inclus</span></p>
            <hr>
            <p>Total : <span><?= number_format($total, 2) ?></span></p>
            <form action="index.php?controller=panier&action=passerCommande" method="post">
                <button class="btn-commander" type="submit">Passer la commande</button>
            </form>
        </div>
    </div>
</div>