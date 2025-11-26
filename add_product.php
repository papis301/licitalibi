<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Récupérer catégories
$stmtCat = $pdo->query("SELECT id, name FROM categories ORDER BY name ASC");
$categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title']);
    $price = floatval($_POST['price']);
    $category_id = intval($_POST['category_id']);
    $description = trim($_POST['description']);

    if ($title !== '' && $price > 0 && $category_id > 0) {

        // Insérer produit
        $stmt = $pdo->prepare("INSERT INTO products (user_id, title, price, category_id, description)
                               VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $title, $price, $category_id, $description]);

        $product_id = $pdo->lastInsertId();

        // Upload des photos
        if (!empty($_FILES['photos']['name'][0])) {
            $uploadDir = "uploads/";
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            foreach ($_FILES['photos']['name'] as $key => $filename) {

                if ($_FILES['photos']['error'][$key] === UPLOAD_ERR_OK) {
                    $tmp = $_FILES['photos']['tmp_name'][$key];
                    $newName = uniqid() . "_" . basename($filename);
                    $destination = $uploadDir . $newName;

                    if (move_uploaded_file($tmp, $destination)) {
                        $stmtImg = $pdo->prepare("INSERT INTO product_images (product_id, image_path)
                                                  VALUES (?, ?)");
                        $stmtImg->execute([$product_id, $destination]);
                    }
                }
            }
        }

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Veuillez remplir tous les champs correctement.";
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Ajouter un produit - Auto Market</title>
</head>
<body>
<h1>Ajouter un produit</h1>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="" method="POST" enctype="multipart/form-data">

    <input type="text" name="title" placeholder="Nom du produit" required><br><br>

    <input type="number" name="price" placeholder="Prix" step="0.01" required><br><br>

    <label>Catégorie :</label>
    <select name="category_id" required>
        <option value="">-- Choisir une catégorie --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>">
                <?= htmlspecialchars($cat['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <textarea name="description" placeholder="Description du produit" rows="4"></textarea><br><br>

    <label>Photos du produit :</label><br>
    <input type="file" name="photos[]" multiple accept="image/*"><br><br>

    <button type="submit">Ajouter</button>
</form>

<p><a href="dashboard.php">Retour au dashboard</a></p>

</body>
</html>
