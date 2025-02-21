<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

require_once __DIR__ . '/../controllers/authController.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $json_data = json_decode(file_get_contents("php://input"), true);

    if (!isset($json_data["name"], $json_data["email"], $json_data["password"])) {
        echo json_encode(["message" => "Missing required fields"]);
        exit;
    }

    $name = $json_data["name"];
    $email = $json_data["email"];
    $password = $json_data["password"];

    $response = registerUser($name, $email, $password);
    echo json_encode($response);

} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    echo json_encode(["message" => "GET request received"]);
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>


