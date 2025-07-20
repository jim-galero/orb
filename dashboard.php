<?php 
session_start(); 
include 'db.php'; 
 
if (!isset($_SESSION['user_id'])) { 
    header('Location: index.php'); 
    exit(); 
} 
 
$search = '';
if (!empty($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM products WHERE name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM products";
}
$result = $conn->query($sql);
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <title>Dashboard - Orb.</title> 
    <link rel="stylesheet" href="css/style.css"> 
    <style> 
        body {
            background: #fff;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            color: #111;
        }

        .logo {
            text-align: center;
            padding: 20px;
        }

        .logo img {
            height: 80px;
        }

        h2 {
            text-align: center;
            color: #111;
        }

        form {
            text-align: center;
            margin: 20px 0;
        }

        input[type="text"] {
            padding: 8px;
            width: 250px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 9px 18px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            margin-left: 8px;
            cursor: pointer;
        }

        a {
            color: #007bff;
            text-decoration: none;
            margin-left: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .product-card {
            background: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            text-align: left;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .product-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .product-card h3 {
            margin: 10px 0 5px;
            color: #111;
        }

        .product-card p {
            margin: 0 0 10px;
            color: #444;
            font-size: 14px;
        }

        .product-card .actions {
            text-align: right;
        }

        .product-card .actions a {
            font-size: 0.9rem;
            color: #007bff;
            text-decoration: none;
            margin-left: 10px;
        }

        .product-card .actions a:hover {
            text-decoration: underline;
        }

        .export-form {
            text-align: center;
            margin-top: 10px;
        }

        .export-form input[type="text"] {
            width: 250px;
            padding: 8px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .export-form button {
            margin-left: 8px;
        }
    </style> 
</head> 
<body> 
    <div class="logo" style="text-align: center;"> 
        <img src="orb/ORB.jpg" alt="Orb Logo" style="display: inline-block;"> 
    </div> 

    <h2>Create the life you crave.</h2> 

    <!-- Search Form -->
    <form method="GET"> 
        <input type="text" name="search" placeholder="Search product..." value="<?= htmlspecialchars($search) ?>"> 
        <button type="submit">Search</button> 
        <a href="add_product.php">Add Product</a> | <a href="logout.php">Logout</a> 
    </form> 

    <!-- Export CSV Form -->
    <div class="export-form">
        <form method="GET" action="export_products.php">
            <input type="text" name="filter" placeholder="Filter by name or status">
            <button type="submit">Export CSV</button>
        </form>
    </div>

    <!-- Product Grid -->
    <div class="product-grid"> 
        <?php while ($row = $result->fetch_assoc()): ?> 
        <div class="product-card"> 
            <img src="orb/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>"> 
            <h3><?= htmlspecialchars($row['name']) ?></h3> 
            <p><?= htmlspecialchars($row['description']) ?></p> 
            <p><strong>Price:</strong> ₱<?= number_format($row['price'], 2) ?></p> 
            <p><strong>Sizes:</strong> <?= htmlspecialchars($row['sizes']) ?></p> 
            <p><strong>Colors:</strong> <?= htmlspecialchars($row['colors']) ?></p> 
            <p><strong>Stock:</strong> <?= (int)$row['stock'] ?></p> 
            <p><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></p> 
            <div class="actions"> 
                <a href="edit_product.php?id=<?= $row['id'] ?>">✏️ Edit</a> | 
                <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this product?')">🗑️ Delete</a> 
            </div> 
        </div> 
        <?php endwhile; ?> 
    </div> 
</body> 
</html>
