<?php

header("Content-Type: application/json; charset=UTF-8"); // การตั้งค่า Content-Type สำหรับการตอบกลับให้เป็น JSON
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Product.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$product = new ProductService($conn);
$result = $product->viewProduct();

$productList = [];

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $productList[] = array(
        "proName" => $row['proName'],
    );
}

echo json_encode($productList);
exit;