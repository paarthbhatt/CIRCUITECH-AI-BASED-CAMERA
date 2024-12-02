<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight CORS requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    // Use Vercel's temporary upload directory
    $uploadDir = '/tmp/uploads/';
    
    // Ensure upload directory exists
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Generate unique filename
    $uploadFile = $uploadDir . uniqid() . '_' . basename($_FILES['image']['name']);

    // Move uploaded file
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.imagga.com/v2/tags');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Basic ' . base64_encode(getenv('IMAGGA_API_KEY') . ':' . getenv('IMAGGA_API_SECRET'))
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            'image' => curl_file_create($uploadFile)
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        // Clean up temporary file
        unlink($uploadFile);

        if (!empty($response)) {
            header('Content-Type: application/json');
            echo $response;
        } else {
            http_response_code(500);
            echo json_encode([
                'error' => 'Image recognition failed',
                'details' => $curlError,
                'httpCode' => $httpCode
            ]);
        }
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'File upload failed']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'No image provided or invalid request method']);
}
?>