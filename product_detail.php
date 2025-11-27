<?php
session_start();
require_once 'db.php';
$logged = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? '';
$role = $_SESSION['role'] ?? ''; // 'admin' ou 'user' (ou autre)
$id = $_GET['id'] ?? null;
if (!$id) exit("Produit introuvable.");

// Récupérer le produit + vendeur + catégorie
$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name, u.username, u.phone, u.id AS seller_id
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN users u ON p.user_id = u.id
    WHERE p.id = ?
");
$stmt->execute([$id]);
$product = $stmt->fetch();

if(!$product) exit("Produit introuvable.");

// Récupérer les images
$stmtImg = $pdo->prepare("SELECT image_path FROM product_images WHERE product_id = ?");
$stmtImg->execute([$id]);
$images = $stmtImg->fetchAll(PDO::FETCH_COLUMN);
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Uren - Car Accessories Shop HTML Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/menu/logo/logo-transparent-svg.svg">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.css">
    <!-- Fontawesome Star -->
    <link rel="stylesheet" href="assets/css/vendor/fontawesome-stars.css">
    <!-- Ion Icon -->
    <link rel="stylesheet" href="assets/css/vendor/ion-fonts.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="assets/css/plugins/slick.css">
    <!-- Animation -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css">
    <!-- jQuery Ui -->
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css">
    <!-- Lightgallery -->
    <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
    <!-- Nice Select -->
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">

    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from the above) -->
    <!--
    <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>
    -->

    <!-- Main Style CSS (Please use minify version for better website load performance) -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!--<link rel="stylesheet" href="assets/css/style.min.css">-->

</head>
<body>

<?php include 'inc/header.php'; ?>

<div class="uren-content_wrapper pt-5 pb-5">
    <div class="container">

        <a href="index.php" class="btn btn-dark mb-3">⬅ Retour aux annonces</a>

        <div class="row">
            <!-- IMAGES -->
            <div class="col-lg-6 col-md-6">
                <?php if (!empty($images)): ?>
                    <div>
                        <img id="mainImage" src="<?= $images[0] ?>" class="img-fluid rounded mb-3" style="max-height:430px;object-fit:cover;">
                    </div>

                    <div class="d-flex">
                        <?php foreach($images as $img): ?>
                            <img src="<?= $img ?>" width="110" height="90" class="thumb-img me-2 border"
                                 onclick="document.getElementById('mainImage').src='<?= $img ?>'">
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <img src="assets/img/no_image.png" class="img-fluid" alt="Aucune image">
                <?php endif; ?>
            </div>

            <!-- INFORMATIONS PRODUIT -->
            <div class="col-lg-6 col-md-6">
                <h2><?= htmlspecialchars($product['title']) ?></h2>

                <p><strong>Catégorie :</strong> <?= htmlspecialchars($product['category_name'] ?? 'Aucune') ?></p>

                <h3 class="text-success">
                    <?= number_format($product['price'],0,',',' ') ?> FCFA
                </h3>

                <p class="mt-3">
                    <?= nl2br(htmlspecialchars($product['description'])) ?>
                </p>

                <hr>

                <p>
                    <strong>Vendeur :</strong> <?= htmlspecialchars($product['username']) ?><br>

                    <?php if(isset($_SESSION['user_id'])): ?>
                        <strong class="btn btn-primary mt-3">Téléphone : <?= htmlspecialchars($product['phone']) ?></strong>
                        <br>
                        
                    <?php else: ?>
                        <em>Connectez-vous pour voir le numéro</em><br>
                        <a href="login.php" class="btn btn-warning mt-3">🔑 Se connecter</a>
                    <?php endif; ?>
                </p>
            </div>

        </div>

    </div>
</div>

<?php include 'inc/footer.php'; ?>
<footer class="bg-dark text-white text-center py-3">
    AUTO MARKET © <?= date('Y') ?> - Tous droits réservés
</footer>

<!-- JS -->

    <!-- JS
============================================ -->

    <!-- jQuery JS -->
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- Popper JS -->
    <script src="assets/js/vendor/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/vendor/bootstrap.min.js"></script>

    <!-- Slick Slider JS -->
    <script src="assets/js/plugins/slick.min.js"></script>
    <!-- Barrating JS -->
    <script src="assets/js/plugins/jquery.barrating.min.js"></script>
    <!-- Counterup JS -->
    <script src="assets/js/plugins/jquery.counterup.js"></script>
    <!-- Nice Select JS -->
    <script src="assets/js/plugins/jquery.nice-select.js"></script>
    <!-- Sticky Sidebar JS -->
    <script src="assets/js/plugins/jquery.sticky-sidebar.js"></script>
    <!-- Jquery-ui JS -->
    <script src="assets/js/plugins/jquery-ui.min.js"></script>
    <script src="assets/js/plugins/jquery.ui.touch-punch.min.js"></script>
    <!-- Lightgallery JS -->
    <script src="assets/js/plugins/lightgallery.min.js"></script>
    <!-- Scroll Top JS -->
    <script src="assets/js/plugins/scroll-top.js"></script>
    <!-- Theia Sticky Sidebar JS -->
    <script src="assets/js/plugins/theia-sticky-sidebar.min.js"></script>
    <!-- Waypoints JS -->
    <script src="assets/js/plugins/waypoints.min.js"></script>
    <!-- jQuery Zoom JS -->
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>

    <!-- Vendor & Plugins JS (Please remove the comment from below vendor.min.js & plugins.min.js for better website load performance and remove js files from avobe) -->
    <!--
<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>
-->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
</body>
</html>
