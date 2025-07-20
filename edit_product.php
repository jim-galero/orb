<?php
include 'db.php';
$id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $sizes = $_POST['sizes'];
    $colors = $_POST['colors'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "orb/" . $image);
        $conn->query("UPDATE products SET name='$name', description='$desc', price='$price', sizes='$sizes', colors='$colors', stock='$stock', status='$status', image='$image' WHERE id=$id");
    } else {
        $conn->query("UPDATE products SET name='$name', description='$desc', price='$price', sizes='$sizes', colors='$colors', stock='$stock', status='$status' WHERE id=$id");
    }

    header('Location: dashboard.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Edit Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" value="<?= $product['name'] ?>" required><br>
        <textarea name="description" required><?= $product['description'] ?></textarea><br>
        <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required><br>
        <input type="text" name="sizes" value="<?= $product['sizes'] ?>" placeholder="e.g. S, M, L, XL" required><br>
        <input type="text" name="colors" value="<?= $product['colors'] ?>" placeholder="e.g. Black, White" required><br>
        <input type="number" name="stock" value="<?= $product['stock'] ?>" placeholder="Stock Quantity" required><br>
        <select name="status" required>
            <option value="Available" <?= $product['status'] == 'Available' ? 'selected' : '' ?>>Available</option>
            <option value="Out of Stock" <?= $product['status'] == 'Out of Stock' ? 'selected' : '' ?>>Out of Stock</option>
            <option value="Discontinued" <?= $product['status'] == 'Discontinued' ? 'selected' : '' ?>>Discontinued</option>
        </select><br>
        <input type="file" name="image"><br>
        <img src="orb/<?= $product['image'] ?>" width="100"><br>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>
