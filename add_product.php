<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $sizes = $_POST['sizes'];
    $colors = $_POST['colors'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];

    $image = $_FILES['image']['name'];
    $target = "orb/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Secure prepared statement
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, image, sizes, colors, stock, status) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsssis", $name, $desc, $price, $image, $sizes, $colors, $stock, $status);
    $stmt->execute();

    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product - Orb.</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Add Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Product Name" required><br>
        <textarea name="description" placeholder="Description" required></textarea><br>
        <input type="number" step="0.01" name="price" placeholder="Price" required><br>

        <input type="text" name="sizes" placeholder="Available Sizes (e.g. S, M, L)" required><br>
        <input type="text" name="colors" placeholder="Color Variants (e.g. Black, White)" required><br>
        <input type="number" name="stock" placeholder="Stock Quantity" required><br>

        <label>Status:</label>
        <select name="status" required>
            <option value="Available">Available</option>
            <option value="Out of Stock">Out of Stock</option>
            <option value="Discontinued">Discontinued</option>
        </select><br><br>

        <label>Upload Product Image:</label><br>
        <input type="file" name="image" required><br><br>

        <button type="submit">Add Product</button>
    </form>
</body>
</html>
