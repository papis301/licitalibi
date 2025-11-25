<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Accès refusé.");
}

// Modifier solde
if (isset($_POST['update_solde'])) {
    $id = $_POST['user_id'];
    $solde = $_POST['solde'];
    $stmt = $pdo->prepare("UPDATE users SET solde=? WHERE id=?");
    $stmt->execute([$solde, $id]);
    header("Location: admin_users.php");
    exit;
}

// Récupérer tous les utilisateurs
$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<h2>🧑‍💼 Gérer les utilisateurs</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Téléphone</th>
            <th>Solde</th>
            <th>Rôle</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['phone']) ?></td>
            <td>
                <form method="POST" class="d-flex">
                    <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                    <input type="number" name="solde" value="<?= $u['solde'] ?>" class="form-control form-control-sm me-2">
                    <button type="submit" name="update_solde" class="btn btn-sm btn-success">Modifier</button>
                </form>
            </td>
            <td><?= $u['role'] ?></td>
            <td>
                <!-- On peut ajouter supprimer utilisateur si nécessaire -->
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="admin_dashboard.php" class="btn btn-secondary mt-3">⬅ Retour Admin</a>

</body>
</html>
