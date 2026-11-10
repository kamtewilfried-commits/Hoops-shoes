<!DOCTYPE html>
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-compatible" content="IE-edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="public/photo/logo.png" />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="public/css/header.css" />

  <title>Hoops & Shoes</title>
</head>

<body>
  <div class="header">
    <a href="index.php?controller=home" class="brand">
      <img src="/hoops-shoes/public/photo/logo.png" alt="le logo" />
      <h1>Hoops & Shoes</h1>
    </a>
    <div class="section2">
      <li class="user-menu">
        <i class="fas fa-user"></i>
          <div id="fa-user">
            <ul class="user-dropdown" style="list-style-type: none;">
              <?php if (isset($_SESSION['utilisateur'])): ?>
                <li style="color: black;">
                  Bienvenue <br><br>
                  <?= htmlspecialchars($_SESSION['utilisateur']['prenom'] . ' ' . $_SESSION['utilisateur']['nom']) ?>
                  <br><br>Solde : <?= number_format($_SESSION['utilisateur']['solde']) ?> $
                  <br><br>
                  <!-- Ajout d'un id logout-link sur le lien -->
                  <button id="buttoncompte" type="submit">
                    <a id="logout-link" href="index.php?controller=utilisateur&action=deconnexion" class="dropdown-button">Déconnecter</a>
                  </button>
                </li>
              <?php else: ?>
              <?php endif; ?>
            </ul>
          </div>
      </li>
      <a href="index.php?controller=panier"><i class="fas fa-cart-shopping"></i></a>
    </div>
  </div>

  <!-- Le message de déconnexion-->
  <div id="logout-message" style="
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #222;
    color: white;
    padding: 30px 40px;
    border-radius: 10px;
    font-size: 1.5rem;
    text-align: center;
    opacity: 0;
    transition: opacity 0.7s ease;
    z-index: 1000;
  ">
    Merci d'avoir visité notre site web !
  </div>

  <script>
  document.getElementById("logout-link").addEventListener("click", function(event) {
    event.preventDefault();  // Empêche la redirection immédiate

    const messageBox = document.getElementById("logout-message");
    messageBox.style.display = "block";

    // Laisser un petit délai puis faire apparaître le message (opacité 1)
    setTimeout(() => {
      messageBox.style.opacity = "1";
    }, 10);

    // Après 3 secondes, on fait disparaître le message
    setTimeout(() => {
      messageBox.style.opacity = "0";

      // on redirige vers la page de déconnexion
      setTimeout(() => {
        window.location.href = event.target.href;
      }, 700);
    }, 3000); // 3 secondes
  });
  </script>
</body>

</html>
