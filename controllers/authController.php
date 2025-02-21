<?php
require_once __DIR__ . '/../config/db.php';

function registerUser($name, $email, $password) {
    global $pdo;

    try {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            return ["message" => "Email already in use"];
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $hashed_password])) {
            return ["message" => "User registered successfully"];
        } else {
            return ["message" => "Registration failed"];
        }
    } catch (Exception $e) {
        return ["message" => "Error: " . $e->getMessage()];
    }
}
?>

