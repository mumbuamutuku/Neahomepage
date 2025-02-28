<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../../api/ApiService.php';

$apiService = new ApiService();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Read and decode JSON input
    $jsonData = file_get_contents("php://input");
    
    $data = json_decode($jsonData, true); // Decode JSON to an associative array

    if (!$data) {
        // Handle JSON parsing errors
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["error" => "Invalid JSON input"]);
        exit;
    }

    error_log(print_r($data, true));

    // Call the workWithus method with the parsed JSON data
    $response = $apiService->workWithus($data);

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>
