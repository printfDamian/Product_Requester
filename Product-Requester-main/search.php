<?php
// search.php

$conn = new mysqli('localhost', 'root', '', 'requester');

if ($conn->connect_error) {
    die("Failed to connect to the database: " . $conn->connect_error);
}

if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];
    
    // Perform a database query to fetch products matching the search query
    
    // Example query
    $sql = "SELECT * FROM products WHERE name LIKE '%$searchQuery%'";
    $result = $conn->query($sql);
    
    // Iterate over the result and display the products
    while ($row = $result->fetch_assoc()) {
        $status = ($row['status_id'] == 1) ? "por desenvolver" : "desenvolvido";
    
        $count_votes_query = "SELECT COUNT(id) AS vote_count FROM votos WHERE product_id = '" . $row['id'] . "'";
        $count_votes_result = $conn->query($count_votes_query);
        $vote_count = $count_votes_result->fetch_assoc()['vote_count'];
    
        $remainingVotes = 50 - $vote_count;
        $percentage = ($remainingVotes / 50) * 100;
        $zeroToHundred = 100 - $percentage;
    
        $client_id = isset($_SESSION['client_id']) ? $_SESSION['client_id'] : null;
        $check_vote_query = "SELECT COUNT(*) AS vote_count FROM votos WHERE product_id = '" . $row['id'] . "' AND client_id = '$client_id'";
        $check_vote_result = $conn->query($check_vote_query);
        $has_voted = $check_vote_result->fetch_assoc()['vote_count'] > 0;
    ?>
        <div class="col-md-4">
            <div class="card">
                <img src="<?php echo $row['file']; ?>" class="card-img-top product-image" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p class="card-text"><strong>Status:</strong> <?php echo $status; ?></p>
                    <?php echo '<p>' . $row['description'] . '		<br><strong>(Progress: ' . $zeroToHundred . '%)</p></strong>'; ?>
                    <br>
                    <?php if (!$has_voted) : ?>
                        <form action="PHP/addVote.php" onsubmit="disableButton(<?php echo $row['id']; ?>)" method="post">
                            <input type="hidden" name="product" value="<?php echo $row['name']; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <?php echo "<button class='mybutton-57' role='button' type='submit' id='buttonVote_" . $row['id'] . "'><span class='text'>Vote</span>" ?>
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
                        <?php echo "<button id='removeButton_" . $row['id'] . "' type='submit' class='btn btn-outline-danger' " . ((!$has_voted || $vote_count == 0) ? 'disabled' : '') . ">" ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-skip-backward-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                            <path d="M11.729 5.055a.5.5 0 0 0-.52.038L8.5 7.028V5.5a.5.5 0 0 0-.79-.407L5 7.028V5.5a.5.5 0 0 0-1 0v5a.5.5 0 0 0 1 0V8.972l2.71 1.935a.5.5 0 0 0 .79-.407V8.972l2.71 1.935A.5.5 0 0 0 12 10.5v-5a.5.5 0 0 0-.271-.445z"></path>
                        </svg>
                        Remove vote
                        </button>
                    </form>
                </div>
            </div>
        </div>
  <?php  
    }
}
?>