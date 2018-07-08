<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
	$_SESSION['type'] = test_input($_POST["typeOption"]);
	$_SESSION['numOfPlayers'] = test_input($_POST["counter1"]);
	if ($type == 2) {
		$_SESSION['numOfPlaysAgainst'] = test_input($_POST["counter2"]);
	}
	$_SESSION['numOfPlayersQualified'] = test_input($_POST["QualifyOption"]);
	$_SESSION['legsKnockout'] = test_input($_POST["counter3"]);
	$_SESSION['legsFinal'] = test_input($_POST["counter4"]);
  
	header("Location: tournament2.php");
	die();
	
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
			Type
			<select name="typeOption" id="typeOption" class="select">
				<option value="1">Knockout</option>
				<option value="2">League and knockout</option>
			</select>
			
			<script>
				$('#typeOption').change(function(){
				   selection = $(this).val();    
				   switch(selection)
				   { 
					   case '2':
						   $('#LeagueAndKnockout').show();
						   break;
					   default:
						   $('#LeagueAndKnockout').hide();
						   break;
				   }
				});
			</script>
			
			<br><br>
			
			
			<div id="plusMinus_div">
			Number of Players
				<input type="button" value="-" id="moins" onclick="minusButton('<?php echo 1;?>')">
				<input type="text" size="8" value="1" name="counter1" id="counter1" class="plusMinusInput">
				<input type="button" value="+" id="plus" onclick="plusButton('<?php echo 1;?>')">
			</div>
			
			<br><br>
			
			<div id="LeagueAndKnockout" style="display:none;">
			
				<div id="plusMinus_div">
				Number of plays against each team
					<input type="button" value="-" id="moins" onclick="minusButton('<?php echo 2;?>')">
					<input type="text" size="8" value="1" name="counter2" id="counter2" class="plusMinusInput">
					<input type="button" value="+" id="plus" onclick="plusButton('<?php echo 2;?>')">
				</div>
				
			</div>
			
			<br><br>
			
			Number of players that will be in the knockout stage
			<select name="QualifyOption" class="select">
				<option value="1">16 Players (Round of 16, quarter-final, semi-final and final)</option>
				<option value="2">8 Players (Quarter-final, semi-final and final)</option>
				<option value="3">4 Players (Semi-final and final)</option>
				<option value="4">2 Players (Final)</option>
			</select>
			
			<br><br>
			
			
			<div id="plusMinus_div">
			Legs per match in knockout stage
				<input type="button" value="-" id="moins" onclick="minusButton('<?php echo 3;?>')">
				<input type="text" size="8" value="1" name="counter3" id="counter3" class="plusMinusInput">
				<input type="button" value="+" id="plus" onclick="plusButton2('<?php echo 3;?>')">
			</div>
			
			<br><br>
			
			
			<div id="plusMinus_div">
			Number of legs in final
				<input type="button" value="-" id="moins" onclick="minusButton('<?php echo 4;?>')">
				<input type="text" size="8" value="1" name="counter4" id="counter4" class="plusMinusInput">
				<input type="button" value="+" id="plus" onclick="plusButton2('<?php echo 4;?>')">
			</div>
			
			<br><br>
			
			<input type="submit" name="submit" value="Pick Teams">  
		</form>


	</body>
	
</html>