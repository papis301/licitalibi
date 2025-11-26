<?php
// inc/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html class="no-js" lang="fr">
<head>
    <meta charset="utf-8">
    <title>Auto Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS TEMPLATE UREN (vérifie que assets/ contient bien ces fichiers) -->
    <link rel="stylesheet" href="/assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/vendor/font-awesome.css">
    <link rel="stylesheet" href="/assets/css/plugins/slick.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
</head>
<body class="template-color-1">

<?php
// include navbar local au dossier inc/
$navbarFile = __DIR__ . '/navbar.php';
if (file_exists($navbarFile)) {
    include $navbarFile;
} else {
    // fallback si navbar introuvable — affiche simple lien
    echo '<nav style="padding:10px;background:#222;color:#fff;">
            <a href="/index.php" style="color:#fff;margin-right:15px;">Accueil</a>
          </nav>';
}
