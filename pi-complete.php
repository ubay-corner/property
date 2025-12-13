<?php
header("Content-Type: application/json");

// Baca raw JSON
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

// Jika gagal membaca JSON
if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "Server tidak menerima JSON",
        "raw" => $raw
    ]);
    exit;
}

$paymentId = isset($data['paymentId']) ? $data['paymentId'] : null;
$txid = isset($data['txid']) ? $data['txid'] : null;

if (!$paymentId) {
    echo json_encode([
        "status" => "error",
        "message" => "Missing payment id"
    ]);
    exit;
}

echo json_encode([
    "status" => "success",
    "paymentId" => $paymentId,
    "txid" => $txid
]);
