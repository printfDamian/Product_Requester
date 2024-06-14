<?php
include 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Query to check if the email exists in the 'clients' table
    $sql = "SELECT id FROM clients WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $client_id = $row['id'];

        // Store the client_id in the session
        $_SESSION['client_id'] = $client_id;
        echo "success";
    } else {
        unset($_SESSION['client_found']);
        echo "failure";
    }
}

$conn->close();
?>
