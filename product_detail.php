<?php
session_start();
require_once 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) exit("Produit introuvable.");

// Récupérer le produit avec catégorie et utilisateur
$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name, u.username, u.phone
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN users u ON p.user_id = u.id
    WHERE p.id = ?
");
$stmt->execute([$id]);
$product = $stmt->fetch();
if (!$product) exit("Produit introuvable.");

// Récupérer toutes les images
$stmtImages = $pdo->prepare("SELECT * FROM product_images WHERE product_id = ?");
$stmtImages->execute([$id]);
$images = $stmtImages->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['title']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-img { max-height: 400px; object-fit: cover; }
        .thumb-img { height: 80px; object-fit: cover; cursor: pointer; margin-right: 5px; }
    </style>
    <script>
        function showImage(src){
            document.getElementById('mainImage').src = src;
        }
    </script>
</head>
<body class="bg-light p-4">

<div class="container">
    <a href="public_ads.php" class="btn btn-secondary mb-3">⬅ Retour aux annonces</a>

    <div class="row">
        <div class="col-md-6">
            <?php if(!empty($images)): ?>
                <img id="mainImage" src="<?= $images[0]['image_path'] ?>" class="img-fluid product-img mb-2" alt="Produit">
                <div class="d-flex">
                    <?php foreach($images as $img): ?>
                        <img src="<?= $img['image_path'] ?>" class="thumb-img rounded border" onclick="showImage('<?= $img['image_path'] ?>')">
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <img src="no_image.png" class="img-fluid product-img" alt="Aucune image">
            <?php endif; ?>
        </div>

        <div class="col-md-6">
            <h2><?= htmlspecialchars($product['title']) ?></h2>
            <p><strong>Catégorie :</strong> <?= htmlspecialchars($product['category_name'] ?? 'Aucune') ?></p>
            <p><strong>Prix :</strong> <?= number_format($product['price'],0,',',' ') ?> FCFA</p>
            <p><strong>Description :</strong><br><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            <hr>
            <p><strong>Vendeur :</strong> <?= htmlspecialchars($product['username']) ?> 
            <?php if(isset($_SESSION['user_id'])): ?>
                <br><strong>Téléphone :</strong> <?= htmlspecialchars($product['phone']) ?>
            <?php else: ?>
                <br><em>Connectez-vous pour voir les coordonnées du vendeur</em>
            <?php endif; ?></p>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="contact_seller.php?user_id=<?= $product['user_id'] ?>&product_id=<?= $product['id'] ?>" class="btn btn-primary mt-3">📞 Contacter le vendeur</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary mt-3">🔑 Connectez-vous pour contacter</a>
            <?php endif; ?>
        </div>
    </div>
</div>

</body>
</html>
