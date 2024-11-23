<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image']['tmp_name'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.imagga.com/v2/tags');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Basic ' . base64_encode('acc_2d5dc00fba2f643:4b9bfc83b8b54abf1a38c46ff99f1cff')
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'image' => curl_file_create($image)
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    if (!empty($response)) {
        header('Content-Type: application/json');
        echo $response;
    } else {
        echo json_encode(['error' => 'Error during image recognition']);
    }
} else {
    echo json_encode(['error' => 'No image provided or invalid request method']);
}