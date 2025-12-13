<?php
require_once "config.php";
require_once "db.php";

$data = json_decode(file_get_contents("php://input"), true);

$amount = $data["amount"] ?? 0;
$memo = $data["memo"] ?? '';
$user_uid = $data["uid"] ?? '';

$payload = [
    "amount" => $amount,
    "memo" => $memo,
    "metadata" => ["uid" => $user_uid],
    "uid" => $user_uid
];

$ch = curl_init($PI_API_URL . "payments");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Key " . $PI_API_KEY
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$res = json_decode($response, true);

// Simpan ke database (cek identifier/respons ada)
$payment_identifier = $res["identifier"] ?? ($res["payment_id"] ?? null);
if($payment_identifier){
    $stmt = $conn->prepare("INSERT INTO pi_payments(payment_id, user_uid, amount, memo, status) VALUES (?, ?, ?, ?, 'pending')");
    $stmt->bind_param("ssds", $payment_identifier, $user_uid, $amount, $memo);
    $stmt->execute();
}

header("Content-Type: application/json");
echo $response;