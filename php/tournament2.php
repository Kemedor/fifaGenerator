<?php
session_start();

// define variables and set to empty values
$usernameErr = $passwordErr = $queryErr = "";
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$flag = "true";

	$numOfPlayers = $_SESSION['numOfPlayers'];

	$playerArray = array();
	$teamArray = array();

	for ($i=0; $i < $numOfPlayers; $i++) {
		if ( (empty($_POST["playerName"+$i])) || (empty($_POST["teamName"+$i])) ) {
			$flag = "false";
		}
		else {
			$playerArray = test_input($_POST["playerName"+$i]);
			$teamArray = test_input($_POST["teamName"+$i]);
		}
	}

	if($flag == "true") {
		$row = mysqli_fetch_array($result);
		$conn->close();
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		header("Location: index.php");
		die();
	}
	else {
		?>

		<li id="missingFieldError"> Please fill all inputs </li>

		<?php
	}

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function connect_to_db() {
	$user = 'Kemedor';
	$pass = 'fifa';
	$db = 'fifagenerator';
	$conn = new mysqli('localhost' , $user , $pass , $db);
	// Check connection
	if ($conn->connect_error) {
		 die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}

?>





</!DOCTYPE html>
<html>



	<head>
		<link rel="stylesheet" type="text/css" href="../css/tournament.css">
		<link rel="import" href="./navbar.html">
	</head>

	<body>

		<nav id="menu" class="navbar">
			<div class="fifadiv">
				<img/>
			</div>
			<ul>
				<li>
					<i class="fa fa-trophy"></i>
					<a href="./tournament.php">New Tournament</a>
				</li>
				<li>
					<i class="fas fa-chart-pie"></i>
					<a href="./personalStats.php">Personal Stats</a>
				</li>
				<li>
					<i class="fa fa-users"></i>
					<a href="./headToHeadStats.php">Head to Head Stats</a>
				</li>
				<li>
					<i class="fa fa-plus-circle"></i>
					<a href="./addNewItems.php">Add New Items</a>
				</li>
			</ul>
		</nav>

	<form class="tournamentDetails" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

		<section>
			<h2>
				Number of players: <?php echo $_SESSION['numOfPlayers']; ?>
			</h2>
		</section>

			<?php
				$numOfPlayers = $_SESSION['numOfPlayers'];
				for ($i=0; $i < $numOfPlayers; $i++) {
			?>
				<div class="form-group row">
					<div class="input-group col-sm-2">
						<input class="form-control" type="text" size="8" name="<?php echo htmlspecialchars("playerName" + $i);?>" id="<?php echo htmlspecialchars("playerName" + $i);?>" required>
						<input class="form-control" type="text" size="8" name="<?php echo htmlspecialchars("playerName" + $i);?>" id="<?php echo htmlspecialchars("teamName" + $i);?>" required>
					</div>
				</div>
			<?
				}

			?>
			<input class="btn" type="submit" name="submit" value="Create Tournament">
		</form>
	</body>

</html>
