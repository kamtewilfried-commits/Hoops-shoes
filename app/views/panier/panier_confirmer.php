<?php include 'app/views/partials/header.php'; ?>
<link rel="stylesheet" href="public/css/panier.css">


<h1 class="merci">Merci à vous!</h1>
<div class="container-confirmation">
<p>Cher <?= htmlspecialchars($utilisateur['prenom']) ?></p><br><br>
<p>Votre commande a été soumise!</p><br><br>
<p>Merci d'avoir fait vos achats chez Hoops&Dreams!</p>
<p>Un courriel de confirmation a été envoyé à <span class="utilisateurEmail"><?= htmlspecialchars($utilisateur['email']) ?></span></p>
</div>


<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>


<script src="public/js/confetti.js"></script>


<?php include 'app/views/partials/footer.php'; ?>