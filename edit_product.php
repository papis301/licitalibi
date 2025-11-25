<?php
session_start();
require_once 'db.php';

// Vérifier connexion
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Vérifier que l'ID existe
if (!isset($_GET['id'])) {
    die("Produit introuvable.");
}

// Récupérer toutes les catégories
$stmtCat = $pdo->query("SELECT * FROM categories ORDER BY name ASC");
$categories = $stmtCat->fetchAll();

$product_id = $_GET['id'];

// Récupérer le produit (seulement celui de l'utilisateur connecté)
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ? AND user_id = ?");
$stmt->execute([$product_id, $_SESSION['user_id']]);
$product = $stmt->fetch();

if (!$product) {
    die("Produit introuvable ou accès refusé.");
}

// Récupérer les images du produit
$stmtImg = $pdo->prepare("SELECT * FROM product_images WHERE product_id = ?");
$stmtImg->execute([$product_id]);
$images = $stmtImg->fetchAll();

$message = "";

// --- Mise à jour du produit ---
if (isset($_POST['update_product'])) {

    $title = $_POST['title'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];

   $stmt = $pdo->prepare("UPDATE products SET title=?, price=?, category_id=?, description=? WHERE id=? AND user_id=?");
    $stmt->execute([$title, $price, $category_id, $description, $product_id, $_SESSION['user_id']]);
    $message = "Produit mis à jour avec succès !";
}

// --- Ajout de nouvelles images ---
if (isset($_POST['add_images']) && isset($_FILES['images'])) {

    if (!empty($_FILES['images']['name'][0])) {

        $count = count($_FILES['images']['name']);

        for ($i = 0; $i < $count; $i++) {

            $tmp = $_FILES['images']['tmp_name'][$i];
            $name = time()."_".rand(1000,9999)."_".$_FILES['images']['name'][$i];

            $path = "uploads/" . $name;

            move_uploaded_file($tmp, $path);

            $stmt = $pdo->prepare("INSERT INTO product_images (product_id, image_path) VALUES (?, ?)");
            $stmt->execute([$product_id, $path]);
        }

        $message = "Nouvelle(s) photo(s) ajoutée(s) !";
        header("Location: edit_product.php?id=".$product_id);
        exit;
    }
}

// --- Suppression d'une image ---
if (isset($_GET['delete_image'])) {

    $img_id = $_GET['delete_image'];

    // récupérer l'image
    $stmt = $pdo->prepare("SELECT image_path FROM product_images WHERE id = ? AND product_id = ?");
    $stmt->execute([$img_id, $product_id]);
    $img = $stmt->fetch();

    if ($img) {
        // supprimer fichier
        if (file_exists($img['image_path'])) {
            unlink($img['image_path']);
        }

        // supprimer DB
        $deleteStmt = $pdo->prepare("DELETE FROM product_images WHERE id = ?");
        $deleteStmt->execute([$img_id]);

        $message = "Image supprimée.";
        header("Location: edit_product.php?id=".$product_id);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le produit</title>
    <style>
        body { font-family: Arial; max-width: 700px; margin: 40px auto; }
        .message { background: #d4ffe0; padding: 10px; border-left: 4px solid green; margin-bottom: 20px; }
        .images img { width: 120px; height: auto; margin: 8px; border-radius: 5px; }
        .delete-btn { color: red; font-size: 14px; text-decoration: none; }
    </style>
</head>
<body>

<h2>Modifier le produit</h2>

<?php if ($message): ?>
    <div class="message"><?= $message ?></div>
<?php endif; ?>

<form method="POST">
    <label>Titre :</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($product['title']) ?>" required><br><br>

    <label>Prix :</label><br>
    <input type="number" name="price" step="0.01" value="<?= $product['price'] ?>" required><br><br>

    <div class="mb-3">
        <label>Catégorie :</label>
        <select name="category_id" class="form-control" required>
            <option value="">-- Choisir une catégorie --</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" 
                    <?= ($cat['id'] == $product['category_id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <label>Description :</label><br>
    <textarea name="description" rows="4"><?= htmlspecialchars($product['description']) ?></textarea><br><br>

    <button type="submit" name="update_product">Mettre à jour</button>
</form>

<hr>

<h3>Photos actuelles :</h3>

<div class="images">
    <?php foreach ($images as $img): ?>
        <div style="display:inline-block; text-align:center;">
            <img src="<?= $img['image_path'] ?>">
            <br>
            <a class="delete-btn" href="edit_product.php?id=<?= $product_id ?>&delete_image=<?= $img['id'] ?>" 
               onclick="return confirm('Supprimer cette image ?')">
               Supprimer
            </a>
        </div>
    <?php endforeach; ?>
</div>

<hr>

<h3>Ajouter des nouvelles photos</h3>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="images[]" multiple required><br><br>
    <button type="submit" name="add_images">Ajouter</button>
</form>

<br><br>

<a href="list_products.php">⬅ Retour à la liste</a>

</body>
</html>
