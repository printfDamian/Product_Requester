<?php
session_start(); // Start the session

include 'conn.php';

$targetDirectory = "images/Products/";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["productName"];
    $description = $_POST["product_description"];
    $votes = 1;
    $file = $targetDirectory . basename($_FILES["product_image"]["name"]);
    $status_id = 1;

    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $file)) {
        echo "File uploaded successfully.";
    } else {
        echo "Error uploading the file.";
    }

    if (isset($_SESSION["client_id"])) {
        $client_id = $_SESSION["client_id"];

        // Insert the product into the products table
        $sql = "INSERT INTO products (name, description, votes, file, status_id, client_id) 
                VALUES ('$name', '$description', '$votes', '$file', '$status_id', '$client_id')";

        if ($conn->query($sql) === TRUE) {
            // Get the product_id of the inserted product
            $product_id = $conn->insert_id;

            // Insert the vote into the votes table
            $voteSql = "INSERT INTO votos (client_id, product_id) VALUES ('$client_id', '$product_id')";

            if ($conn->query($voteSql) === TRUE) {
                echo "Product added and vote added successfully.";
                header('Location: ../products.php'); // Redirect to products.php
                exit; // End the script to prevent the execution of the remaining code
            } else {
                echo "Error adding vote: " . $conn->error;
            }
        } else {
            echo "Error adding product: " . $conn->error;
        }
    } else {
        echo "Error obtaining client ID.";
    }
}

$conn->close();
?>
