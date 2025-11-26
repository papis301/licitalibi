<?php
session_start();
require_once 'db.php';

// Vérifier si connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// --- Ajouter une catégorie ---
if (isset($_POST['add_category'])) {
    $name = trim($_POST['name']);
    if ($name !== '') {
        $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->execute([$name]);
        header("Location: categories.php");
        exit;
    }
}

// --- Modifier une catégorie ---
if (isset($_POST['edit_category'])) {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    if ($name !== '') {
        $stmt = $pdo->prepare("UPDATE categories SET name=? WHERE id=?");
        $stmt->execute([$name, $id]);
        header("Location: categories.php");
        exit;
    }
}

// --- Supprimer une catégorie ---
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $pdo->prepare("DELETE FROM categories WHERE id=?")->execute([$id]);
    header("Location: categories.php");
    exit;
}

// --- Récupérer toutes les catégories ---
$stmt = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CRUD Catégories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>📂 Gestion des catégories</h2>
    
    <!-- Ajouter catégorie -->
    <form method="POST" class="mb-4 d-flex gap-2">
        <input type="text" name="name" class="form-control" placeholder="Nouvelle catégorie" required>
        <button type="submit" name="add_category" class="btn btn-success">➕ Ajouter</button>
    </form>

    <!-- Liste des catégories -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categories as $cat): ?>
            <tr>
                <td><?= $cat['id'] ?></td>
                <td><?= htmlspecialchars($cat['name']) ?></td>
                <td>
                    <!-- Formulaire édition inline -->
                    <form method="POST" class="d-flex gap-1">
                        <input type="hidden" name="id" value="<?= $cat['id'] ?>">
                        <input type="text" name="name" value="<?= htmlspecialchars($cat['name']) ?>" class="form-control form-control-sm" required>
                        <button type="submit" name="edit_category" class="btn btn-sm btn-primary">✏️</button>
                        <a href="categories.php?delete=<?= $cat['id'] ?>" onclick="return confirm('Supprimer cette catégorie ?')" class="btn btn-sm btn-danger">🗑️</a>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary mt-3">⬅ Retour au dashboard</a>
</div>
</body>
</html>
