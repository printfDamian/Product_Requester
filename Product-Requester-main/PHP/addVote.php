<?php
session_start();

include 'conn.php';

if (isset($_SESSION['client_id'])) {
    $client_id = $_SESSION['client_id'];
    $product_id = $_POST['product_id'];

    // Check if the vote already exists
    $checkVoteQuery = "SELECT * FROM votos WHERE client_id = '$client_id' AND product_id = '$product_id'";
    $checkVoteResult = $conn->query($checkVoteQuery);

    if ($checkVoteResult->num_rows == 0) {
        // Vote does not exist, insert the vote
        $insertVoteQuery = "INSERT INTO votos (client_id, product_id) VALUES ('$client_id', '$product_id')";
        if ($conn->query($insertVoteQuery) === TRUE) {
            // Vote inserted successfully

            // Update the vote count for the product
            $updateVoteCountQuery = "UPDATE products SET votes = votes + 1 WHERE id = '$product_id'";
            if ($conn->query($updateVoteCountQuery) === TRUE) {
                // Vote count updated successfully

                $_SESSION['vote_added'] = 'product added succefully';
                header("Location: ../products.php");
                exit();
            } else {
                // Error updating vote count
                $_SESSION['vote_error'] = 'Erro ao atualizar o número de votos';
                header("Location: ../products.php");
                exit();
            }
        } else {
            // Error inserting vote
            $_SESSION['vote_error'] = 'Error adding the product';
            header("Location: ../products.php");
            exit();
        }
    } else {
        // Vote already exists
        $_SESSION['vote_error'] = 'you can only vote one time in each product';
        header("Location: ../products.php");
        exit();
    }
} else {
    // Client ID not set in session
    $_SESSION['vote_error'] = 'client not found';
    header("Location: ../products.php");
    exit();
}

$conn->close();
?>
