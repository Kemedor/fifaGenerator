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
		<script type="text/javascript" src="../js/plusMinusButton.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	
	<body>
	
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			
			<?php 
			
				$numOfPlayers = $_SESSION['numOfPlayers'];
				
				echo "Number of players " + $numOfPlayers;
				
				for ($i=0; $i < $numOfPlayers; $i++) {
			?>
			
				<input type="text" size="8" name="<?php echo htmlspecialchars("playerName" + $i);?>" id="<?php echo htmlspecialchars("playerName" + $i);?>">
				<input type="text" size="8" name="<?php echo htmlspecialchars("playerName" + $i);?>" id="<?php echo htmlspecialchars("teamName" + $i);?>">
			
			<?
				} 
			
			?>
			
			
			<input type="submit" name="submit" value="Create Tournament">  
		</form>


	</body>
	
</html>