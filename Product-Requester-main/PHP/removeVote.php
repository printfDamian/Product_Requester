<?php
session_start();

include 'conn.php';

// Obtém o nome do produto a partir da requisição
$productName = $_POST['product'];

// Verifica se o produto existe na tabela de produtos
$sql = "SELECT id, votes FROM products WHERE name = '$productName'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // O produto foi encontrado, obtém o ID e o número atual de votos
    $row = $result->fetch_assoc();
    $productId = $row['id'];
    $currentVotes = $row['votes'];

    if (isset($_SESSION['client_id'])) {
        $client_id = $_SESSION['client_id'];

        // Verifica se o cliente já votou para esse produto
        $checkVoteSql = "SELECT * FROM votos WHERE client_id = '$client_id' AND product_id = '$productId'";
        $checkVoteResult = $conn->query($checkVoteSql);

        if ($checkVoteResult->num_rows > 0) {
            // Remove o voto da tabela de votos
            $deleteSql = "DELETE FROM votos WHERE client_id = '$client_id' AND product_id = '$productId'";
            $conn->query($deleteSql);

            // Decrementa o número de votos
            $newVotes = $currentVotes - 1;

            // Atualiza o número de votos na tabela de produtos
            $updateSql = "UPDATE products SET votes = $newVotes, status_id = 1 WHERE id = $productId";

            // Após a atualização do número de votos na tabela de produtos
            if ($conn->query($updateSql) === TRUE) {
                // O voto foi removido com sucesso
                http_response_code(200);
                echo json_encode(['message' => 'Voto removido com sucesso!']);
                $_SESSION['vote_removed'] = "vote removed successfully";
                header("Location: ../products.php");
                exit();
            } else {
                // Ocorreu um erro ao remover o voto
                http_response_code(500);
                echo json_encode(['message' => 'Erro ao remover o voto']);
            }
        } else {
            // O cliente não votou para esse produto, exibe uma mensagem de erro
            http_response_code(400);
            echo json_encode(['message' => 'O cliente não votou para esse produto.']);
        }
    }
} else {
    // O produto não foi encontrado
    http_response_code(404);
}

$conn->close();
?>