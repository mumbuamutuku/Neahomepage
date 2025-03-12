<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process text fields
    $data = [
        "fullname" => $_POST["fullname"] ?? "",
        "email" => $_POST["email"] ?? "",
        "phone_number" => $_POST["phone_number"] ?? "",
        "country" => $_POST["country"] ?? "",
        "application_type" => $_POST["application_type"] ?? "",
        "message" => $_POST["message"] ?? "",
    ];

    // Process file uploads
    $uploadDir = __DIR__ . "/uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create upload directory if it doesn't exist
    }

    $cvPath = $uploadDir . basename($_FILES["cv"]["name"]);
    $coverLetterPath = $uploadDir . basename($_FILES["cover_letter"]["name"]);

    if (move_uploaded_file($_FILES["cv"]["tmp_name"], $cvPath) &&
        move_uploaded_file($_FILES["cover_letter"]["tmp_name"], $coverLetterPath)) {
        
        // Prepare cURL request
        $curl = curl_init("http://localhost:8000/user/web/work-with-us");
        $postData = [
            "fullname" => $data["fullname"],
            "email" => $data["email"],
            "phone_number" => $data["phone_number"],
            "country" => $data["country"],
            "application_type" => $data["application_type"],
            "message" => $data["message"],
            "cv" => new CURLFile($cvPath),
            "cover_letter" => new CURLFile($coverLetterPath),
        ];

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        // Handle API response
        if ($httpCode === 200) {
            echo json_encode(["status" => "success", "message" => "Form submitted successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "API request failed: " . $response]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "File upload failed"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>