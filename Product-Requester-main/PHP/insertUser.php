<?php
include 'conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["Name"];
    $number = $_POST["phoneNumber"];
    $phone = $_POST['countryNumber'];
    $email = $_POST["email"];
    $country = $_POST['countryName'];

    // Server-side email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["invalid_email"] = true;
        header("Location: ../index.php");
        exit();
    }

    $phoneNumber = $phone . " " . $number;

    $checkQuery = "SELECT id FROM clients WHERE email = '$email'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Email is already registered
        $_SESSION["email_registered"] = true;
        header("Location: ../index.php");
        exit();
    } else {
        // Email is not registered, proceed with insertion
        $sql = "INSERT INTO clients (name, phone, email, local) VALUES ('$name', '$phoneNumber', '$email', '$country')";

        if ($conn->query($sql) === true) {
            $client_id = $conn->insert_id;

            $_SESSION["client_id"] = $client_id;

            // Redirect or do further processing
            header("Location: ../products.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
