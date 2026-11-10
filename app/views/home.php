<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-compatible" content="IE-edge" />
  <meta name="viewport" content="width=device-width, initial-scale-1.0" />
  <link rel="icon" href="public/photo/logo.png" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="public/css/home.css" />
  <title>Hoops & Shoes</title>
</head>

<body>
  <?php
  if (isset($_SESSION['utilisateur'])) {
    $prenom = htmlspecialchars($_SESSION['utilisateur']['prenom']);
    $nom = htmlspecialchars($_SESSION['utilisateur']['nom']);
    echo "<div id='bienvenue-message'>Bienvenue $prenom !</div>";
  }
  ?>

  <div class="container">
    <?php foreach ($souliers as $soulier): ?>
      <div class="shoes">
        <a href="index.php?controller=article&action=chaussure&shoe=<?= urlencode($soulier["nom"]) ?> ">
          <img src="<?= $soulier["image_soulier"] ?>" alt="<?= $soulier["nom"] ?>">
          <h3><?= $soulier["nom"] ?></h3>
          <p><?= $soulier["prix"] ?>$</p>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
  <script src="/hoops-shoes/public/js/home.js"></script>
</body>

</html>