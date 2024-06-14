<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Axiis - Product Requester</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/myButton.css">
	<!--===============================================================================================-->


</head>
<script>
	function submitForm1() {
		document.getElementById("form1").submit();
	}

	function showLoginForm() {
		document.getElementById("formLogin").style.display = "block";
		document.getElementById("form1").style.display = "none";
		document.getElementById("add").style.display = "none";
		document.getElementById("add-product-card").style.display = "none";
		document.getElementById("product-card").style.display = "none";
	}

	function showForm1() {
		document.getElementById("formLogin").style.display = "none";
		document.getElementById("form1").style.display = "block";
		document.getElementById("add").style.display = "none";
		document.getElementById("add-product-card").style.display = "none";
		document.getElementById("product-card").style.display = "none";
	}

	function showProductCard() {
		document.getElementById("formLogin").style.display = "none";
		document.getElementById("form1").style.display = "none";
		document.getElementById("add").style.display = "none";
		document.getElementById("add-product-card").style.display = "none";
		document.getElementById("product-card").style.display = "block";
	}

	function submitForm(event) {
		var form = event.target.closest("form");
		var formData = new FormData(form);

		var xhr = new XMLHttpRequest();
		xhr.open(form.method, form.action, true);
		xhr.onload = function() {
			if (xhr.status === 200) {
				// Handle the response from the PHP script
				console.log(xhr.responseText);
				// You can update the UI or perform additional actions based on the response
				if (xhr.responseText === "success") {
					window.location.href = "products.php";
				} else if (xhr.responseText === "failure") {
					var noEmailParagraph = document.getElementById("noEmail");
					if (noEmailParagraph) {
						noEmailParagraph.style.display = "block";
					}
					console.log("The email is wrong.");
				}
			}
		};
		xhr.send(formData);
	}
</script>


<body>

	<div class="limiter">
		<nav id="navBar" class="navbar navbar-transparent">
			<a class="navbar-brand" href="index.php">
				<img src="images/Axiis/AXIIS_white.png" width="110px" alt="Axiis Logo">
			</a>
		</nav>
		<div class="container-login100">

			<div class="wrap-login100">

				<h1 class="login100-form-title">
					Product Requester
				</h1>
				<form id="form1" class="login100-form validate-form" action="PHP/insertUser.php" method="post" style="margin-top: 75px;">
					<div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
						<input class="input100" type="email" name="email" required>
						<span class="focus-input100" data-placeholder="Email *"></span>
					</div>
					<div class="wrap-input100">
						<input class="input100" type="text" name="Name" required>
						<span class="focus-input100" data-placeholder="Name *"></span>
					</div>
					<div class="wrap-input100">
						<div class="phone-input">
							<div class="country-code">
								<?php
								$context = stream_context_create([
									"ssl" => [
										"verify_peer" => false,
										"verify_peer_name" => false
									]
								]);

								$data = file_get_contents('https://restcountries.com/v3.1/all', false, $context);
								$countries = json_decode($data, true);
								?>
								<select name="countryNumber" class="country-select" style="font-size: 13px;">
									<option value="" selected disabled>Select country code</option> <!-- Add the option -->
									<?php
									foreach ($countries as $country) {
										$countryCode = $country['idd']['root'] . $country['idd']['suffixes'][0];
										$countryName = $country['name']['common'];
										echo '<option value="' . $countryCode . '">' . $countryName . ' (' . $countryCode . ')</option>';
									}
									?>
								</select>
							</div>
							<input class="input100 phone-number" type="number" name="phoneNumber" placeholder="Phone Number">
						</div>
					</div>
					<div class="wrap-input100">
						<div class="phone-input">
							<div class="country-code">
								<?php
								$data = file_get_contents('https://restcountries.com/v3.1/all', false, $context);
								$countries = json_decode($data, true);
								?>
								<select name="countryName" style="font-size:15px;" class="country-select">
									<option value="" selected disabled>Select country</option> <!-- Add the option -->
									<?php
									foreach ($countries as $country) {
										$countryName = $country['name']['common'];
										echo '<option value="' . $countryName . '">' . $countryName . '</option>';
									}
									?>
								</select>
							</div>
						</div>
					</div>

					<br>
					<?php
					if (isset($_SESSION["email_registered"])) { ?>
						<div style="text-align:center;">
							<a href="#" onclick="showLoginForm()">Your email is already registered. Login here</a>
						</div>
					<?php
						unset($_SESSION["email_registered"]);
					} else {
					?>
						<div style="text-align:center;">
							<a href="#" onclick="showLoginForm()">If you already have an account, please click here to login.</a>
						</div>
					<?php
					}
					?>
					<br>
					<button class="button-57" role="button" type="submit" onclick="submitForm1()">
						<span class="text">Next</span>
						<span>
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
								<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
							</svg>
						</span>
					</button>
				</form>
				<?php
				if (isset($_SESSION["invalid_email"])) {
					echo '<script>alert("Invalid email format. Please enter a valid email address.");</script>';
					unset($_SESSION["invalid_email"]);
				}
				?>
				<div id="add" class="wrap-input100" style="display:none;">
					<select class="input100" name="product" id="product-select">
						<option value="" disabled selected>Select a product</option>

						<?php
						include 'PHP/conn.php';

						$sql = "SELECT * FROM products";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$remainingVotes = 50 - $row['votes'];
								$percentage = ($remainingVotes / 50) * 100;
								$zeroToHundred = 100 - $percentage;
								echo '<option value="' . $row['name'] . '">' . $row['name'] . '		Progress: ' . $zeroToHundred . '%)</option>';
							}
						}

						$conn->close();
						?>
						<option value="add_product">Add Product</option>
					</select>
				</div>
				<div id="add-product-card" style="display: none;">
					<form class="login100-form" method="post" action="PHP/insertProduct.php" enctype="multipart/form-data">
						<div class="wrap-input100">
							<input class="input100" type="text" name="product_name" placeholder="Product Name" required>
						</div>

						<div class="wrap-input100">
							<textarea class="input100" name="product_description" placeholder="Product Description" required></textarea>
						</div>

						<div class="wrap-input100">
							<input class="input100" type="file" name="product_image" accept="image/*">
						</div>

						<button class="button-57" role="button" type="submit">
							<span class="text">Submit</span>
							<span>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
								</svg>
							</span>
						</button>
					</form>
				</div>

				<div id='product-card' class="card" style="width: 20rem;display:none;">
					<img id="product-image" src="" alt="Product Image">
					<div class="card-body">
						<h5 class="card-title product-name" id='product-name'>Product 1</h5>
						<p class="card-text product-description" id='product-description'>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
						<p id="votos"></p>
						<form action="PHP/addVote.php" method="post">
							<?php
							if (isset($_SESSION['product_id'])) {
								$product_id = $_SESSION['product_id'];
							} else {
								$product_id = "";
							}
							echo "<button class='mybutton-57' role='button' type='submit' id='buttonVote' onclick='disableButton()'><span class='text'>Vote</span>"
							?>
							<span>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
									<path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z" />
								</svg>
							</span>
							</button>
						</form>
						<div class="icon-container">
							<button type="button" class="btn btn-success btn-custom" disabled>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
									<path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z" />
								</svg>
								<span id="product-votes">0</span>
							</button>
						</div>
					</div>
				</div>

				<div id="dropDownSelect1"></div>

				<!-- ===============================Formulário de login===============================-->
				<div id="formLogin" style="display:none;">
					<form class="login100-form validate-form" action="PHP/loginUser.php" method="post">
						<div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
							<input class="input100" type="email" name="email" required>
							<span class="focus-input100" data-placeholder="Email"></span>
						</div>
						<p id="noEmail" style="color: red; display: none;text-align: center;">Incorrect email.</p>
						<div style="text-align:center;">
							<a href="#" onclick="showForm1()">If you don't have an account yet, please click here to register.</a>
						</div>
						<br>
						<button class="button-57" role="button" type="button" id="loginButton" onclick="submitForm(event)">
							<span class="text">Login</span>
							<span>
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
									<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
								</svg>
							</span>
						</button>
					</form>
				</div>
				<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
				<!--===============================================================================================-->
				<script src="vendor/animsition/js/animsition.min.js"></script>
				<!--===============================================================================================-->
				<script src="vendor/bootstrap/js/popper.js"></script>
				<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
				<!--===============================================================================================-->
				<script src="vendor/select2/select2.min.js"></script>
				<!--===============================================================================================-->
				<script src="vendor/daterangepicker/moment.min.js"></script>
				<script src="vendor/daterangepicker/daterangepicker.js"></script>
				<!--===============================================================================================-->
				<script src="vendor/countdowntime/countdowntime.js"></script>
				<!--===============================================================================================-->
				<script src="js/main.js"></script>

				<!--==My JS==-->
				<script src="js/showForms.js"></script>
				<script src="js/event.js"></script>

				<!-- ===============================PASSAR DE UM FORMULÁRIO PARA OUTRO===============================-->



				<!-- ===============================SELEÇÃO DO PRODUTO===============================-->
				<script>
					$(document).ready(function() {
						// Evento quando selecionar um produto
						$("#product-select").on("change", function() {
							var productName = $(this).val();

							if (productName === "add_product") {
								$("#add-product-card").show();
								$("#product-card").hide();
							} else {
								$("#add-product-card").hide();
								$("#product-card").show();

								// Faz uma requisição para obter as informações do produto selecionado
								$.ajax({
									url: "PHP/getProduct.php",
									type: "POST",
									dataType: "json",
									data: {
										productName: productName
									},
									success: function(response) {
										// Atualiza o card com as informações do produto
										$("#product-name").text(response.name);
										$("#product-description").text(response.description);
										$("#product-image").attr("src", response.file);
										$("#product-votes").text(response.votes);
										$("#product-status_id").text(response.status_id);
									},
									error: function(xhr, status, error) {
										console.log(xhr.responseText);
										console.log(status);
										console.log(error);
									}
								});
							}
						});
					});
				</script>
				<!-- Desativar o butão 57 -->
				<script>
					function disableButton() {
						document.getElementById("buttonVote").disabled = true;
					}
				</script>
				<?php
				// Check if the client_id session variable exists
				if (isset($_GET["client_id"])) {
					echo '<script>
            			document.getElementById("form1").style.display = "none";
            			document.getElementById("add").style.display = "block";
          			</script>';
				}
				?>
</body>

</html>