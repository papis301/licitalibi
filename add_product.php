<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// --- Récupérer toutes les catégories ---
$stmtCat = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $stmtCat->fetchAll();


$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $user_id = $_SESSION['user_id'];

    // Enregistrer le produit
    $stmt = $pdo->prepare("INSERT INTO products (user_id, title, price, category, description) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $title, $price, $category, $description]);

    $product_id = $pdo->lastInsertId();

    // Gestion des photos multiples
    if (!empty($_FILES['images']['name'][0])) {

        $count = count($_FILES['images']['name']);

        for ($i = 0; $i < $count; $i++) {

            $tmp = $_FILES['images']['tmp_name'][$i];
            $name = time() . "_" . rand(1000,9999) . "_" . $_FILES['images']['name'][$i];

            $upload_path = "uploads/" . $name;

            move_uploaded_file($tmp, $upload_path);

            

            $stmt = $pdo->prepare("INSERT INTO products (user_id, title, price, category_id, description) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$user_id, $title, $price, $category_id, $description]);

        }
    }

    $message = "Produit ajouté avec succès !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un produit</title>
</head>
<body>

<h2>Ajouter un produit</h2>

<?php if ($message) echo "<p style='color:green'>$message</p>"; ?>

<form method="POST" enctype="multipart/form-data">
    <label>Titre :</label><br>
    <input type="text" name="title" required><br><br>

    <label>Prix :</label><br>
    <input type="number" name="price" step="0.01" required><br><br>

    <div class="mb-3">
    <label>Catégorie :</label>
        <select name="category_id" class="form-control" required>
            <option value="">-- Choisir une catégorie --</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </div>


    <label>Description :</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Photos (plusieurs) :</label><br>
    <input type="file" name="images[]" multiple required><br><br>

    <button type="submit">Ajouter</button>
</form>

</body>
</html>
