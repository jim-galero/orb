<?php
include 'db.php';

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Set headers to download file
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=products_export.csv');

// Open output stream
$output = fopen('php://output', 'w');

// Output column headings
fputcsv($output, ['ID', 'Name', 'Description', 'Price', 'Image', 'Sizes', 'Colors', 'Stock', 'Status']);

// Fetch data
if (!empty($filter)) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE CONCAT('%', ?, '%') OR status = ?");
    $stmt->bind_param("ss", $filter, $filter);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM products");
}

// Write data to CSV
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>
