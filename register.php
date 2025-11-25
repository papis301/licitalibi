<?php
session_start();
require_once 'db.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et nettoyage
    $username = trim($_POST['username'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Validation basique
    if ($username === '' || strlen($username) < 2) {
        $errors[] = "Le nom d'utilisateur est requis (au moins 2 caractères).";
    }

    // Normaliser le numéro (retirer espaces, tirets, parenthèses)
    $phone_normalized = preg_replace('/[^\d+]/', '', $phone); // garde chiffres et +
    if ($phone_normalized === '' || strlen($phone_normalized) < 6) {
        $errors[] = "Numéro de téléphone invalide.";
    }

    if ($password === '' || strlen($password) < 6) {
        $errors[] = "Le mot de passe doit contenir au moins 6 caractères.";
    } elseif ($password !== $password_confirm) {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }

    if (empty($errors)) {
        // Vérifier l'unicité du numéro
        $stmt = $pdo->prepare('SELECT id FROM users WHERE phone = ? LIMIT 1');
        $stmt->execute([$phone_normalized]);
        if ($stmt->fetch()) {
            $errors[] = "Ce numéro de téléphone est déjà utilisé.";
        } else {
            // Hacher le mot de passe
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insérer l'utilisateur
            $stmt = $pdo->prepare('INSERT INTO users (phone, username, password) VALUES (?, ?, ?)');
            $ok = $stmt->execute([$phone_normalized, $username, $password_hash]);

            if ($ok) {
                $success = "Inscription réussie. Vous pouvez maintenant vous connecter.";
                // Optionnel : connecter automatiquement l'utilisateur
                // $userId = $pdo->lastInsertId();
                // session_regenerate_id(true);
                // $_SESSION['user_id'] = $userId;
                // header('Location: index.php'); exit;
            } else {
                $errors[] = "Erreur lors de l'inscription. Réessaie plus tard.";
            }
        }
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Inscription - Auto Market</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body{font-family:Arial,Helvetica,sans-serif;max-width:780px;margin:24px auto;padding:12px;}
    form{display:grid;gap:8px;}
    input {padding:8px;font-size:16px;}
    .error{color:#b00020;}
    .success{color:green;}
  </style>
</head>
<body>
  <h1>Inscription</h1>

  <?php if (!empty($errors)): ?>
    <div class="error"><ul>
      <?php foreach ($errors as $e): ?><li><?=htmlspecialchars($e)?></li><?php endforeach; ?>
    </ul></div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="success"><?=htmlspecialchars($success)?></div>
  <?php endif; ?>

  <form method="post" action="register.php" autocomplete="off">
    <label>
      Nom d'utilisateur
      <input type="text" name="username" required value="<?=htmlspecialchars($_POST['username'] ?? '')?>">
    </label>

    <label>
      Numéro de téléphone
      <input type="tel" name="phone" required placeholder="770000000" value="<?=htmlspecialchars($_POST['phone'] ?? '')?>">
    </label>

    <label>
      Mot de passe
      <input type="password" name="password" required>
    </label>

    <label>
      Confirmer le mot de passe
      <input type="password" name="password_confirm" required>
    </label>

    <button type="submit">S'inscrire</button>
  </form>

  <p>Déjà inscrit ? <a href="login.php">Se connecter</a></p>
</body>
</html>
