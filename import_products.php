<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv'])) {
    $file = $_FILES['csv']['tmp_name'];

    if (($handle = fopen($file, "r")) !== FALSE) {
        fgetcsv($handle); // skip header

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            list($id, $name, $description, $price, $image, $sizes, $colors, $stock, $status) = $data;
            $stmt = $conn->prepare("INSERT INTO products (name, description, price, sizes, colors, stock, status)
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdssis", $name, $description, $price, $sizes, $colors, $stock, $status);
            $stmt->execute();
        }
        fclose($handle);
        header('Location: dashboard.php');
        exit();
    } else {
        $error = "Failed to open file.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Import CSV</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="logo">
    <img src="orb/ORB.jpg" alt="Retailer Logo">
</div>
<h2>Import Products from Supplier CSV</h2>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="csv" accept=".csv" required><br><br>
    <button type="submit">Import</button>
</form>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>
