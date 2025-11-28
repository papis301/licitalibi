<?php
session_start();
require_once 'db.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Vérifier si ID produit existe
if (!isset($_GET['id'])) {
    die("Produit introuvable.");
}

$product_id = $_GET['id'];

// Vérifier que le produit appartient bien à l'utilisateur
$stmt = $pdo->prepare("SELECT id FROM products WHERE id = ? AND user_id = ?");
$stmt->execute([$product_id, $_SESSION['user_id']]);
$product = $stmt->fetch();

if (!$product) {
    die("Accès refusé ou produit introuvable.");
}

// Récupérer toutes les images liées
$stmtImg = $pdo->prepare("SELECT image_path FROM product_images WHERE product_id = ?");
$stmtImg->execute([$product_id]);
$images = $stmtImg->fetchAll();

// Supprimer les fichiers images physiquement
foreach ($images as $img) {
    if (file_exists($img['image_path'])) {
        unlink($img['image_path']);
    }
}

// Supprimer les images dans la base
$deleteImgs = $pdo->prepare("DELETE FROM product_images WHERE product_id = ?");
$deleteImgs->execute([$product_id]);

// Supprimer le produit
$deleteProduct = $pdo->prepare("DELETE FROM products WHERE id = ? AND user_id = ?");
$deleteProduct->execute([$product_id, $_SESSION['user_id']]);

// Redirection
header("Location: dashboard.php?deleted=1");
exit;
