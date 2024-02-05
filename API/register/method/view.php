<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/User.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/api/v1/protected.php';

$userService = new UserService($conn);

$userData = $userService->viewUser($world_id);

if (!empty($userData)) {
    http_response_code(200);
    echo json_encode(array("data" => $userData));
} else {
    http_response_code(404);
    echo json_encode(array("error" => "Data not found."));
}