<?php
header("Content-Type: application/json");

// Step 1: Baca raw JSON dari Pi Network
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

// Jika JSON tidak terbaca
if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "Server tidak menerima JSON",
        "raw" => $raw
    ]);
    exit;
}

// Ambil paymentId
$paymentId = isset($data['paymentId']) ? $data['paymentId'] : null;

if (!$paymentId) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing payment id",
        "received" => $data
    ]);
    exit;
}

// Jika semua OK, return success
echo json_encode([
    "status" => "success",
    "received" => [
        "paymentId" => $paymentId
    ]
]);
