<?php
if (!isset($_SESSION['client_id'])) {
    header("Location: index.php");
    exit();
}

include 'PHP/conn.php';

$client_id = $_SESSION['client_id'];

// Fetch the products voted by the client
$sql = "SELECT products.id, products.name, products.file, products.status_id, products.description
        FROM products
        JOIN votos ON products.id = votos.product_id
        WHERE votos.client_id = '$client_id'";
$result = $conn->query($sql);

// Check if the client has voted for any products
if ($result->num_rows > 0) {
    // Display the modal with the voted products
    echo '<div class="modal fade" id="myVotesModal" tabindex="-1" role="dialog" aria-labelledby="myVotesModalLabel" aria-hidden="true">';
    echo '    <div class="modal-dialog" role="document">';
    echo '        <div class="modal-content">';
    echo '            <div class="modal-header">';
    echo '                <h5 class="modal-title" id="myVotesModalLabel">My Voted Products</h5>';
    echo '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    echo '                    <span aria-hidden="true">&times;</span>';
    echo '                </button>';
    echo '            </div>';
    echo '            <div class="modal-body">';
    echo '                <div class="row">';

    // Display each voted product
    while ($row = $result->fetch_assoc()) {
        $status = isset($row['status_id']) ? ($row['status_id'] == 1 ? "por desenvolver" : "desenvolvido") : "";
        $description = isset($row['description']) ? $row['description'] : "";

        $count_votes_query = "SELECT COUNT(id) AS vote_count FROM votos WHERE product_id = " . $row['id'];
        $count_votes_result = $conn->query($count_votes_query);
        $vote_count = $count_votes_result->fetch_assoc()['vote_count'];

        $remainingVotes = 50 - $vote_count;
        $percentage = ($remainingVotes / 50) * 100;
        $zeroToHundred = 100 - $percentage;

        $client_id = isset($_SESSION['client_id']) ? $_SESSION['client_id'] : null;
        $check_vote_query = "SELECT COUNT(*) AS vote_count FROM votos WHERE product_id = " . $row['id'] . " AND client_id = " . $client_id;
        $check_vote_result = $conn->query($check_vote_query);
        $has_voted = $check_vote_result->fetch_assoc()['vote_count'] > 0;

?>
        <div class="col-md-4">
            <div class="card">
                <img src="<?php echo $row['file']; ?>" class="card-img-top product-image" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p class="card-text"><strong>Status:</strong> <?php echo $status; ?></p>
                    <p><?php echo $description; ?></p>
                    <p><strong>(Progress: <?php echo $zeroToHundred; ?>%)</strong></p>
                    <?php if (!$has_voted) : ?>
                        <form action="PHP/addVote.php" onsubmit="disableButton(<?php echo $row['id']; ?>)" method="post">
                            <input type="hidden" name="product" value="<?php echo $row['name']; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <button class="mybutton-57" role="button" type="submit" id="buttonVote_<?php echo $row['id']; ?>"><span class="text">Vote</span>
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                                        <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z" />
                                    </svg>
                                </span>
                            </button>
                        </form>
                    <?php endif; ?>
                    <form action="PHP/removeVote.php" onsubmit="enableButton(<?php echo $row['id']; ?>)" method="post">
                        <input type="hidden" name="product" value="<?php echo $row['name']; ?>">
                        <button id="removeButton_<?php echo $row['id']; ?>" type="submit" class="btn btn-outline-danger" <?php echo ((!$has_voted || $vote_count == 0) ? 'disabled' : ''); ?>>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"></path>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
<?php
    }

    echo '                </div>';
    echo '            </div>';
    echo '            <div class="modal-footer">';
    echo '                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
    echo '            </div>';
    echo '        </div>';
    echo '    </div>';
    echo '</div>';
} else {
    // Display a message if the client has not voted for any products
    echo '<div class="modal fade" id="myVotesModal" tabindex="-1" role="dialog" aria-labelledby="myVotesModalLabel" aria-hidden="true">';
    echo '    <div class="modal-dialog" role="document">';
    echo '        <div class="modal-content">';
    echo '            <div class="modal-header">';
    echo '                <h5 class="modal-title" id="myVotesModalLabel">My Voted Products</h5>';
    echo '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
    echo '                    <span aria-hidden="true">&times;</span>';
    echo '                </button>';
    echo '            </div>';
    echo '            <div class="modal-body">';
    echo '                <p>You haven\'t voted for any products yet.</p>';
    echo '            </div>';
    echo '            <div class="modal-footer">';
    echo '                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
    echo '            </div>';
    echo '        </div>';
    echo '    </div>';
    echo '</div>';
}

$conn->close();
?>