<?php
session_start();
require_once 'db.php';

// --- Récupérer toutes les catégories pour le filtre ---
$stmtCat = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $stmtCat->fetchAll();

// --- Gérer les filtres ---
$where = [];
$params = [];

if (!empty($_GET['category_id'])) {
    $where[] = "p.category_id = ?";
    $params[] = $_GET['category_id'];
}

if (!empty($_GET['search'])) {
    $where[] = "(p.title LIKE ? OR p.description LIKE ?)";
    $searchTerm = "%".$_GET['search']."%";
    $params[] = $searchTerm;
    $params[] = $searchTerm;
}

$whereSQL = "";
if ($where) {
    $whereSQL = "WHERE " . implode(" AND ", $where);
}

// --- Récupérer les produits ---
$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name,
           (SELECT image_path FROM product_images WHERE product_id = p.id LIMIT 1) AS main_image
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    $whereSQL
    ORDER BY p.created_at DESC
");
$stmt->execute($params);
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces Auto Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card img { height: 150px; object-fit: cover; }
    </style>
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4">📢 Annonces</h2>

    <!-- Formulaire de recherche -->
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" class="form-control" placeholder="Rechercher une annonce...">
        </div>
        <div class="col-md-3">
            <select name="category_id" class="form-select">
                <option value="">-- Toutes les catégories --</option>
                <?php foreach($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>" <?= (isset($_GET['category_id']) && $_GET['category_id']==$cat['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Filtrer</button>
        </div>
        <div class="col-md-3 text-end">
            <a href="index.php" class="btn btn-secondary">⬅ Retour à l'accueil</a>
        </div>
    </form>

    <?php if(empty($products)): ?>
        <div class="alert alert-info">Aucune annonce trouvée.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach($products as $p): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm product-card">
                        <?php if($p['main_image']): ?>
                            <img src="<?= $p['main_image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($p['title']) ?>">
                        <?php else: ?>
                            <img src="no_image.png" class="card-img-top" alt="Aucune image">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($p['title']) ?></h5>
                            <p class="card-text">
                                <strong>Catégorie :</strong> <?= htmlspecialchars($p['category_name'] ?? 'Aucune') ?><br>
                                <strong>Prix :</strong> <?= number_format($p['price'],0,',',' ') ?> FCFA
                            </p>
                            <a href="product_detail.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-primary">Voir détails</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
