<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT p.id, p.title, p.price, p.description, c.name AS category_name
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.user_id = ?
    ORDER BY p.id DESC
");
$stmt->execute([$_SESSION['user_id']]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Produits</title>
</head>
<body>

<h2>Mes Produits</h2>
<a href="add_product.php">➕ Ajouter un produit</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Image</th>
        <th>Titre</th>
        <th>Prix</th>
        <th>Catégorie</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($products as $p): ?>
    <tr>
        <td>
            <?php if ($p['main_image']): ?>
                <img src="<?= $p['main_image'] ?>" width="80">
            <?php else: ?>
                <span>Aucune image</span>
            <?php endif; ?>
        </td>

        <td><?= htmlspecialchars($p['title']) ?></td>
        <td><?= htmlspecialchars($p['price']) ?> FCFA</td>
        <?= htmlspecialchars($product['category_name']) ?>

        <td>
            <a href="edit_product.php?id=<?= $p['id'] ?>">Modifier</a>
            |
            <a href="delete_product.php?id=<?= $p['id'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
