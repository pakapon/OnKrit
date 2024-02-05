<?php

header("Content-Type: application/json; charset=UTF-8"); // การตั้งค่า Content-Type สำหรับการตอบกลับให้เป็น JSON

if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    include_once "method/view.php";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once "method/create.php";
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    include_once "method/edit.php";
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    include_once "method/delete.php";
} else {
    http_response_code(404);
    $jsonlist = array(
        "payload" => array(
            "message" => "Method not right.",
            "error"   => "Method denied.",
        ),
    );
    echo json_encode($jsonlist);
}
