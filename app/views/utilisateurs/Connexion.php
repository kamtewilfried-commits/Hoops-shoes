<?php include 'app/views/partials/header.php'; ?>
<head>
    <title>connexion</title>
    <link rel="stylesheet" href="public\css\utilisateur.css">
</head>
<body>    
    <div class="Content">

        <form method="post" action="index.php?controller=utilisateur&action=connexion">
            <input type="email" name="email" placeholder="Adresse courriel" required><br><br>
            <input type="password" name="motdepasse" placeholder="Mot de passe" required><br><br>
            
            <div id="message-container">
                <?php if (isset($erreur)) { echo "<p style='color:red;'>$erreur</p>"; } ?> <!-- message d'erreur -->
            </div>
            
            <button style="background-color: rgb(207, 81, 22); color: black;" id="buttoncompte" type="submit">
                Se connecter
            </button>


        </form>
        
        <div class="separator"></div>
        
        <a href="index.php?controller=utilisateur&action=index" style="text-decoration: none;">
            <button  id="buttoncompte" type="submit">Créer un Compte</button>
        </a>
        

    </div>
</body>
<?php include 'app/views/partials/footer.php'; ?>