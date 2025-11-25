<?php
session_start();
require_once 'db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Récupérer l'utilisateur
$stmt = $pdo->prepare("SELECT username, phone, solde FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    echo "Utilisateur introuvable.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <style>
        body {
            font-family: Arial;
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 0px 10px #ccc;
        }
        .btn {
            display: inline-block;
            padding: 10px 18px;
            background: #007bff;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            margin-top: 15px;
        }
        .btn:hover {
            background: #0056b3;
        }
        .logout {
            background: #dc3545;
        }
        .logout:hover {
            background: #b52a37;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Mon Profil</h2>

    <p><strong>Nom :</strong> <?= htmlspecialchars($user['username']) ?></p>
    <p><strong>Téléphone :</strong> <?= htmlspecialchars($user['phone']) ?></p>
    <p><strong>Solde :</strong> <?= number_format($user['solde'], 2, ',', ' ') ?> FCFA</p>

    <a href="dashboard.php" class="btn">Dashboard (Produits)</a>
    <br>
    <a href="logout.php" class="btn logout">Déconnexion</a>
</div>

</body>
</html>
