<?php
require_once "config.php";

$token = $_POST['accessToken'] ?? '';

$ch = curl_init($PI_API_URL . "me");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $token
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

header("Content-Type: application/json");
echo $response;