<?php
session_start();
$logged = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? '';
$phone = $_SESSION['phone'] ?? '';
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Auto Market - Accueil</title>
</head>
<body>
  <h1>Auto Market</h1>

  <?php if ($logged): ?>
    <p>
      Bienvenue, <?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>
      (<?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') ?>)
    </p>
    <p><a href="post_ad.php">Poster une annonce</a> | <a href="logout.php">Se déconnecter</a></p>
  <?php else: ?>
    <p><a href="login.php">Se connecter</a> ou <a href="register.php">S'inscrire</a></p>
  <?php endif; ?>
</body>
</html>
