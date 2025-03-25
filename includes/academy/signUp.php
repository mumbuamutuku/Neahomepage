<?php
// require_once __DIR__ . '/../../api/ApiService.php';
$baseDir = dirname(__DIR__) . '/../api/apiService.php';

require_once $baseDir;

header("Content-Type: application/json");

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Read the incoming JSON payload
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate the email field
    if (!isset($data["email"]) || !filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "error" => "Invalid email address"]);
        exit;
    }

    // Initialize the API service
    $apiService = new ApiService();
    $response = $apiService->signUpforNewsletter($data["email"]);

    // Handle response status
    if ($response['status_code'] === 409) {
        // Email already registered
        echo json_encode([
            "success" => false,
            "message" => "Email already registered",
            "status_code" => 409
        ]);
    } else if ($response['status_code'] === 200 || $response['status_code'] === 201) {
        // Successfully signed up
        echo json_encode([
            "success" => true,
            "message" => "Signed up successfully!"
        ]);
    } else {
        // Generic failure
        echo json_encode([
            "success" => false,
            "error" => "Failed to sign up. Please try again."
        ]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
