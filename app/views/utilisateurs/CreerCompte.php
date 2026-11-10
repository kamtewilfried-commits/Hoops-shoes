<?php include 'app/views/partials/header.php'; ?>
<title>Créer un Compte</title>
<link rel="stylesheet" href="public\css\utilisateur.css">

<body>
    <div class="Content">

        <div>
            <p>Saisissez vos informations ci-dessous pour créer un nouveau compte.<br>
                <span>
                    Vous avez déjà un compte ? 
                    <a href="index.php?controller=utilisateur&action=connexion">S'identifier</a>
                </span>
            </p>
        </div>

        <form action="index.php?controller=utilisateur&action=index" method="post">
            <input type="text" name="prenom" placeholder="Prénom" required><br><br>
            <input type="text" name="nom" placeholder="Nom" required><br><br>
            <input type="email" name="email" placeholder="Adresse courriel" required><br><br>
            <input type="password" name="motdepasse" placeholder="Mot de passe" required><br><br>

            <button id="buttoncompte" type="submit">Créer un Compte</button>
        </form>
        <?php if (!empty($message)): ?>
            <p style="color: <?= ($message === "Compte créé avec succès ! Vous pouvez maintenant vous connecter.") ? 'green' : 'red'; ?>">
                <?= htmlspecialchars($message) ?>
            </p>
        <?php endif; ?>

    </div>
</body>
<?php include 'app/views/partials/footer.php'; ?>