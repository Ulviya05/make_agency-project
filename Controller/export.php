<?php
include_once '../Config/database.php';
include '../Controller/parser.php';

$query = "SELECT * FROM mydb.product_info";
$result = $conn->query($query);

if ($result->num_rows > 0) {

    $filename = 'parsed_products.csv';

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);
    header('Pragma: no-cache');
    header('Expires: 0');

    $output = fopen('php://output', 'w');

    fputcsv($output, ['Main image', 'Title', 'Category', 'Price', 'Old price', 'Link', 'Date']);

    while ($row = $result->fetch_assoc()) {
        $data = [
            $row['main_image'],
            $row['product_name'],
            $row['category'],
            $row['price'],
            $row['old_price'],
            $row['link'],
            $row['date']
        ];

        fputcsv($output, $data);
    }

    fclose($output);
} else {
    echo "No records found.";
}

$conn->close();
?>
