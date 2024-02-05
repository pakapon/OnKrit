<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/User.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/api/v1/protected.php';

$userService = new UserService($conn);

$data = json_decode(file_get_contents("php://input"));

try {
    $result = $userService->updateUser($data, $world_id);
    if($result === true) {
        http_response_code(200);
        echo json_encode(array("status" => 200, "message" => "successfully.", "error" => ""));
    } else {
        http_response_code(400);
        echo json_encode(array("status" => 400, "message" => "Update failed.", "error" => $result));
    }
} catch (PDOException $exception) {
    http_response_code(400);
    echo json_encode(array("status" => 400, "message" => "Update failed due to database error.", "error" => $exception->getMessage()));
}