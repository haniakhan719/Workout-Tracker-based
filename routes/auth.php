<?php
// Set CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Include the auth controller
require_once __DIR__ . '/../controllers/authController.php';

// Handle different HTTP request methods
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Get JSON data from the request body
        $json_data = json_decode(file_get_contents("php://input"), true);

        // Check for required fields
        if (!isset($json_data["name"], $json_data["email"], $json_data["password"])) {
            throw new Exception("Missing required fields");
        }

        // Extract data
        $name = $json_data["name"];
        $email = $json_data["email"];
        $password = $json_data["password"];

        // Call the register user function
        $response = registerUser($name, $email, $password);

        // Return the response as JSON
        echo json_encode($response);
    } catch (Exception $e) {
        // Handle exceptions and return error messages
        echo json_encode(["error" => $e->getMessage()]);
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Handle GET requests
    echo json_encode(["message" => "GET request received"]);
} elseif ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    // Handle OPTIONS requests (for CORS preflight)
    echo json_encode(["message" => "OPTIONS request received"]);
} else {
    // Handle invalid request methods
    echo json_encode(["error" => "Invalid request method"]);
}
?>


