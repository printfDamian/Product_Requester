<!DOCTYPE html>
<html lang="pt">
<?php session_start();
if (!isset($_SESSION['client_id'])) {
    header("Location: index.php");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/products.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/myButton.css">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<style>
    .navbar-nav .nav-item {
        position: relative;
    }

    .navbar-nav .nav-item::before {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 3px;
        background-color: white;
        transform: scaleX(0);
        transition: transform 0.3s;
    }

    .navbar-nav .nav-item:hover::before {
        transform: scaleX(1);
    }

    #product-description {
        height: 150px;
        /* Adjust the height as per your requirement */
        resize: vertical;
        /* Allow vertical resizing */
    }

    .card-img-top.product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
</style>

<body>
    <?php
    // Check if the session variable 'vote_error' is set
    if (isset($_SESSION['vote_error'])) {
        $voteError = $_SESSION['vote_error'];
        // Remove the session variable
        unset($_SESSION['vote_error']);
        // Display the error notification using Toastr
        echo "<script>toastr.error('$voteError', 'Vote');</script>";
    }

    // Your PHP code here to fetch and iterate over products

    include 'PHP/conn.php';

    if (isset($_GET['query'])) {
        $searchQuery = $_GET['query'];

        // Perform a database query to fetch products matching the search query
        $sql = "SELECT * FROM products WHERE name LIKE '%$searchQuery%'";
        $result = $conn->query($sql);
    } else {
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        echo '<div class="col-md-12">No products found.</div>';
    }

    ?>

    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: black;">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="images/Axiis/AXIIS_white.png" width="110px" alt="Axiis Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <form class="form-inline my-2 my-lg-0" action="products.php" method="GET">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" name="query" aria-label="Search">
                                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                                    </svg>
                                </button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <a style="color: whitesmoke; font-size: large;" class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">Add Product</a>
                        </li>

                        <li class="nav-item">
                            <a style="color: whitesmoke; font-size: large;" class="nav-link" href="#" data-toggle="modal" data-target="#myVotesModal">My Votes</a>
                        </li>
                        <li class="nav-item">
                            <a style="color: whitesmoke; font-size: large;" class="nav-link" href="#" data-toggle="modal" data-target="#ProductStats">Products stats</a>
                        </li>

                        <li class="nav-item">
                            <a style="color: whitesmoke; font-size: large;" class="nav-link" href="index.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container" style="padding-top: 150px;">
            <div class="row">
                <?php
                if (isset($_GET['query'])) {
                    $searchQuery = $_GET['query'];

                    // Perform a database query to fetch products matching the search query
                    $sql = "SELECT * FROM products WHERE name LIKE '%$searchQuery%'";
                } else {
                    $result = $conn->query($sql);
                }


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
                ?>
            </div>
        </div>
    </div>

    <!-- Test Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="login100-form" method="post" action="PHP/insertProduct.php" enctype="multipart/form-data">

                        <p>* means that the filed is required</p>

                        <div class="wrap-input100">
                            <input class="input100" type="text" name="productName" placeholder="provide motorcycle brand, model,year , and desired tool*" required>
                        </div>

                        <div class="wrap-input100">
                            <textarea class="input100 input-description" name="product_description" id="product-description" placeholder="Product Description *" required></textarea>
                        </div>


                        <div class="wrap-input100">
                            <input class="input100" type="file" name="product_image" accept="image/*">
                        </div>

                        <button class="button-57" role="button" type="submit">
                            <span class="text">Submit</span>
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                    <path d="M11.729 5.055a.5.5 0 0 0-.52.038L8.5 7.028V5.5a.5.5 0 0 0-.79-.407L5 7.028V5.5a.5.5 0 0 0-1 0v5a.5.5 0 0 0 1 0V8.972l2.71 1.935a.5.5 0 0 0 .79-.407V8.972l2.71 1.935A.5.5 0 0 0 12 10.5v-5a.5.5 0 0 0-.271-.445z"></path>
                                </svg>
                            </span>
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Product stats model -->
    <!-- Modal for product statistics -->
    <div class="modal fade" id="ProductStats" tabindex="-1" role="dialog" aria-labelledby="ProductStats" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ProductStats">Top 5 most requested products</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- The chart will be rendered here -->
                    <canvas id="productChart" style="max-height: 500px;"></canvas>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include your existing PHP code to retrieve the product data -->
    <?php

    // Query to fetch product statistics
    $productStatsQuery = "SELECT id, name, votes FROM products";
    $productStatsResult = $conn->query($productStatsQuery);

    // Fetch product statistics from the database
    $productStats = array();
    if ($productStatsResult->num_rows > 0) {
        while ($row = $productStatsResult->fetch_assoc()) {
            $productStats[] = array('name' => $row['name'], 'votes' => $row['votes']);
        }
    }
    ?>

    <!-- Add the JavaScript code for creating the chart and displaying progress bars -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Get the productStats data from PHP and convert it to a JavaScript variable
            var productStats = <?php echo json_encode($productStats); ?>;

            // Sort the productStats data based on votes in descending order
            productStats.sort((a, b) => b.votes - a.votes);

            // Take only the top 5 products
            var top5Products = productStats.slice(0, 5);

            // Prepare data for the pie chart
            var chartLabels = top5Products.map(item => item.name);
            var chartData = top5Products.map(item => calculateProgress(item.votes));

            // Function to calculate progress percentage
            function calculateProgress(votes) {
                return ((votes / 50) * 100).toFixed(2);
            }

            // Get the canvas element for the chart
            var productChartCanvas = document.getElementById("productChart").getContext("2d");

            // Create the pie chart
            var productChart = new Chart(productChartCanvas, {
                type: "pie",
                data: {
                    labels: chartLabels,
                    datasets: [{
                        data: chartData,
                        backgroundColor: ["#007bff", "#28a745", "#dc3545", "#ffc107", "#17a2b8"],
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: "Top 5 Most Requested Products"
                        },
                        legend: {
                            display: true,
                            position: "bottom",
                            labels: {
                                fontColor: "black"
                            }
                        }
                    },
                    // Enable tooltip for the chart
                    tooltips: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var currentValue = dataset.data[tooltipItem.index];
                                return chartLabels[tooltipItem.index] + ": " + currentValue + "%";
                            }
                        }
                    }
                }
            });

            // Enable Bootstrap tooltip for the chart
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <script src="vendor/countdowntime/countdowntime.js"></script>

    <script>
        // Function to send a vote asynchronously using AJAX
        function sendVote(productId) {
            $.ajax({
                url: 'PHP/addVote.php',
                type: 'POST',
                data: {
                    product_id: productId
                },
                success: function(response) {
                    // Display success message using Toastr
                    toastr.success('Voto adicionado com sucesso', 'Vote');
                },
                error: function() {
                    // Display error message using Toastr
                    toastr.error('Não votou neste produto', 'Vote');
                }
            });
        }

        // Function to handle the vote button click event
        function handleVoteButton(productId) {
            disableButton(productId); // Disable the vote button
            sendVote(productId); // Send the vote asynchronously
        }

        // Function to disable the vote button after clicking
        function disableButton(productId) {
            var button = $('#buttonVote_' + productId);
            button.attr('disabled', 'disabled');
            button.find('.text').text('Voted');
        }

        // Function to enable the vote button after removing the vote
        function enableButton(productId) {
            var button = $('#buttonVote_' + productId);
            button.removeAttr('disabled');
            button.find('.text').text('Vote');
        }

        // Function to handle the add product button click event
        function handleAddProductButton() {
            // Reset the form values
            $('#addProductModal input[name="product_name"]').val('');
            $('#addProductModal textarea[name="product_description"]').val('');
            $('#addProductModal input[name="product_image"]').val('');
        }

        // Document ready event
        $(document).ready(function() {
            // Configure Toastr
            toastr.options = {
                positionClass: 'toast-bottom-right',
                timeOut: 3000,
                extendedTimeOut: 1000
            };

            <?php
            if (isset($_SESSION['vote_error'])) {
                $voteError = $_SESSION['vote_error'];
                // Remove the session variable
                unset($_SESSION['vote_error']);
                // Display an error notification
                echo "toastr.error('$voteError', 'Vote');";
            }

            if (isset($_SESSION['vote_added'])) {
                $voteAdded = $_SESSION['vote_added'];
                // Remove the session variable
                unset($_SESSION['vote_added']);
                // Display a success notification
                echo "toastr.success('voted successfully', 'Vote');";
            }
            if (isset($_SESSION['vote_removed'])) {
                $voteRemoved = $_SESSION['vote_removed'];
                // Remove the session variable
                unset($_SESSION['vote_removed']);
                // Display a success notification
                echo "toastr.info('vote removed successfully', 'Vote');";
            }
            ?>
        });
    </script>
    <?php include 'my_votes.php'; ?>
</body>

</html>