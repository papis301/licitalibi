<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Récupérer l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE phone = ?");
    $stmt->execute([$phone]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {

        // Stocker infos dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['phone'] = $user['phone'];
        $_SESSION['role'] = $user['role']; // admin ou user

        // 🔁 Redirection selon le rôle
        if ($user['role'] === 'admin') {
            header("Location: admin_dashboard.php");
            exit;
        } else {
            header("Location: dashboard.php");
            exit;
        }

    } else {
        echo "Numéro ou mot de passe incorrect.";
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Connexion - Auto Market</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body{font-family:Arial,Helvetica,sans-serif;max-width:780px;margin:24px auto;padding:12px;}
    form{display:grid;gap:8px;}
    input {padding:8px;font-size:16px;}
    .error{color:#b00020;}
  </style>
</head>
<body>
  <h1>Connexion</h1>

  <?php if (!empty($errors)): ?>
    <div class="error"><ul>
      <?php foreach ($errors as $e): ?><li><?=htmlspecialchars($e)?></li><?php endforeach; ?>
    </ul></div>
  <?php endif; ?>

  <form method="post" action="login.php" autocomplete="off">
    <label>
      Numéro de téléphone
      <input type="tel" name="phone" required placeholder="770000000" value="<?=htmlspecialchars($_POST['phone'] ?? '')?>">
    </label>

    <label>
      Mot de passe
      <input type="password" name="password" required>
    </label>

    <button type="submit">Se connecter</button>
  </form>

  <p>Pas encore inscrit ? <a href="register.php">S'inscrire</a></p>
</body>
</html>
