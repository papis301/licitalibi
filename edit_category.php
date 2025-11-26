<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) exit("ID manquant.");

// Récupérer catégorie
$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->execute([$id]);
$category = $stmt->fetch();
if (!$category) exit("Catégorie introuvable.");

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if ($name === "") {
        $message = "Le nom est obligatoire.";
    } else {
        $stmt = $pdo->prepare("UPDATE categories SET name=?, description=? WHERE id=?");
        $stmt->execute([$name, $description, $id]);
        $message = "Catégorie mise à jour !";
        header("Location: list_categories.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier catégorie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

<h2>✏ Modifier catégorie</h2>

<?php if($message): ?>
    <div class="alert alert-info"><?= $message ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label>Nom :</label>
        <input type="text" name="name" value="<?= htmlspecialchars($category['name']) ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Description :</label>
        <textarea name="description" class="form-control"><?= htmlspecialchars($category['description']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>

<a href="list_categories.php" class="btn btn-secondary mt-3">⬅ Retour à la liste</a>

</body>
</html>
