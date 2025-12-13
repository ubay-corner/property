<?php
require_once "config.php";
require_once "db.php";

$input = json_decode(file_get_contents("php://input"), true);

// adjust path to where payment id located according to Pi callback payload
$payment_id = $input["payment"]["identifier"] ?? ($input["identifier"] ?? null);
$status = $input["status"] ?? ($input["payment"]["status"] ?? null);

if($payment_id){
    $stmt = $conn->prepare("UPDATE pi_payments SET status = ? WHERE payment_id = ?");
    $stmt->bind_param("ss", $status, $payment_id);
    $stmt->execute();
}

header("Content-Type: application/json");
echo json_encode(["ok" => true]);