<?php
$data = json_decode(file_get_contents("php://input"), true);

file_put_contents("complete_log.txt", json_encode($data));

echo json_encode(["status" => "COMPLETED"]);
?>
