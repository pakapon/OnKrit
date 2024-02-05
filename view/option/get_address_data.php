<?php

header("Content-Type: application/json; charset=UTF-8"); // การตั้งค่า Content-Type สำหรับการตอบกลับให้เป็น JSON
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Customer.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$cusService = new CuntomerService($conn);

if(isset($_GET['postcode'])) {
    $data = new stdClass();
    $data->postcode = $_GET['postcode'];
    $result = $cusService->addressList($data);
    
    $addresses = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $addresses[] = array(
            "postcode"          => $row['postcode'],
            "tumbon"            => $row['tumbon'],
            "aumper"            => $row['aumper'],
            "province"          => $row['province']
        );
    }
    
    echo json_encode($addresses);
    exit;
}
