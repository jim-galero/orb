<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Retailer Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .logo {
            text-align: center;
            padding: 20px;
        }

        .logo img {
            height: 60px;
        }

        h2 {
            text-align: center;
            color: #111;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
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

        .top-links {
            text-align: center;
            margin-bottom: 10px;
        }

        .top-links a {
            margin: 0 10px;
            text-decoration: none;
            color: #007bff;
        }

        .top-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="orb/ORB.jpg" alt="Retailer Logo">
    </div>

    <h2>Retailer Dashboard</h2>

    <div class="top-links">
        <a href="import_products.php">📥 Import CSV</a>
        |
        <a href="logout.php">Logout</a>
    </div>

    <div class="product-grid">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="product-card">
            <?php
                $imagePath = "orb/" . htmlspecialchars($row['image']);
                if (!empty($row['image']) && file_exists($imagePath)): ?>
                <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($row['name']) ?>">
            <?php else: ?>
                <img src="orb/ORB.jpg" alt="No Image">
            <?php endif; ?>

            <h3><?= htmlspecialchars($row['name']) ?></h3>
            <p><?= htmlspecialchars($row['description']) ?></p>
            <p><strong>Price:</strong> ₱<?= number_format($row['price'], 2) ?></p>
            <p><strong>Sizes:</strong> <?= htmlspecialchars($row['sizes']) ?></p>
            <p><strong>Colors:</strong> <?= htmlspecialchars($row['colors']) ?></p>
            <p><strong>Stock:</strong> <?= (int)$row['stock'] ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($row['status']) ?></p>
        </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
