<?php
session_start();
require_once 'db.php';

// Vérifier si connecté et admin (optionnel)
// Ici on laisse ouvert pour créer le premier admin si nécessaire

$message = '';

if (isset($_POST['create_admin'])) {
    $username = trim($_POST['username']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];

    if ($username && $phone && $password) {
        // Vérifier si le téléphone n'existe pas déjà
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE phone=?");
        $stmt->execute([$phone]);
        if ($stmt->fetchColumn() > 0) {
            $message = "Ce numéro de téléphone existe déjà !";
        } else {
            // Hasher le mot de passe
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insérer l'admin
            $stmt = $pdo->prepare("INSERT INTO users (username, phone, password, role, solde, created_at) VALUES (?, ?, ?, 'admin', 0, NOW())");
            $stmt->execute([$username, $phone, $password_hash]);

            $message = "Admin créé avec succès !";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<div class="container">
    <h2>➕ Créer un compte Admin</h2>

    <?php if($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" class="w-50">
        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Téléphone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" name="create_admin" class="btn btn-success">Créer Admin</button>
    </form>

    <a href="index.php" class="btn btn-secondary mt-3">⬅ Retour à l'accueil</a>
</div>

</body>
</html>
