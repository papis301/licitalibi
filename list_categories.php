<?php
session_start();
require_once 'db.php';

// Vérifier si connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Récupérer toutes les catégories
$stmt = $pdo->query("SELECT * FROM categories ORDER BY created_at DESC");
$categories = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des catégories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2>📂 Catégories</h2>

<a href="add_category.php" class="btn btn-success mb-3">➕ Ajouter une catégorie</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Créée le</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categories as $cat): ?>
        <tr>
            <td><?= $cat['id'] ?></td>
            <td><?= htmlspecialchars($cat['name']) ?></td>
            <td><?= htmlspecialchars($cat['description']) ?></td>
            <td><?= $cat['created_at'] ?></td>
            <td>
                <a href="edit_category.php?id=<?= $cat['id'] ?>" class="btn btn-sm btn-primary">Modifier</a>
                <a href="delete_category.php?id=<?= $cat['id'] ?>" class="btn btn-sm btn-danger"
                   onclick="return confirm('Supprimer cette catégorie ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="admin_dashboard.php" class="btn btn-secondary mt-3">⬅ Retour au dashboard</a>

</body>
</html>
