<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/User.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();
$userService = new UserService($conn);
$data = json_decode(file_get_contents("php://input"));
$ocppTag = strtoupper(uniqid());

try {
    $userService->createUser($ocppTag, $data);

    http_response_code(201);
    echo json_encode(array("status" => 200, "message" => "successfully.", "error" => ""));
} catch (PDOException $exception) {
    http_response_code(400);
    echo json_encode(array("status" => 400, "message" => "User has been used", "error" => $exception->getMessage()));
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(array("status" => 400, "message" => $e->getMessage(), "error" => $e));
}
