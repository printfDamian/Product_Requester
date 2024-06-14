<?php
$conn = new mysqli('localhost', 'root', '', 'requester');

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>