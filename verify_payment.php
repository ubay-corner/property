<?php
require_once "config.php";
require_once "db.php";

$payment_id = $_POST["payment_id"] ?? '';

$ch = curl_init($PI_API_URL . "payments/" . $payment_id);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Key " . $PI_API_KEY
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

header("Content-Type: application/json");
echo $response;