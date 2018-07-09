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
		<link rel="import" href="./navbar.html">
	</head>

	<body>
		<div class="container-fluid">
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

		<form class="tournamentForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="form-group row">
				<label class="col-sm-2 col-form-label" for="typeOption">Type</label>
				<div class="col-sm-2">
					<select name="typeOption" id="typeOption" class="form-control" required>
						<option value="1">Knockout</option>
						<option value="2">League and knockout</option>
					</select>
				</div>
			</div>

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

			<div id="plusMinus_div" class="form-group row">
				<label class="col-sm-2 col-form-label" for="counter1">Number of Players</label>
				<div class="input-group col-sm-2">
					<span class="input-group-btn">
						<input class="btn btn-default" type="button" value="-" id="moins" onclick="minusButton('<?php echo 1;?>')">
					</span>
					<input class="form-control plusMinusInput" type="text" pattern="^[1-9]\d*$" size="8" value="1" name="counter1" id="counter1" required>
					<span class="input-group-btn">
						<input class="btn btn-default" type="button" value="+" id="plus" onclick="plusButton('<?php echo 1;?>')">
					</span>
				</div>
			</div>

			<div id="LeagueAndKnockout" style="display:none;">
				<div id="plusMinus_div" class="form-group row">
					<label class="col-sm-2 col-form-label" for="counter2">Number of plays against each team</label>
					<div class="input-group col-sm-2">
						<span class="input-group-btn">
							<input class="btn btn-default" type="button" value="-" id="moins" onclick="minusButton('<?php echo 2;?>')">
						</span>
						<input class="form-control plusMinusInput" pattern="^[1-9]\d*$" type="text" size="8" value="1" name="counter2" id="counter2" required>
						<span class="input-group-btn">
							<input class="btn btn-default" type="button" value="+" id="plus" onclick="plusButton('<?php echo 2;?>')">
						</span>
					</div>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label" for="QualifyOption">Number of players that will be in the knockout stage</label>
				<div class="col-sm-2">
					<select name="QualifyOption" class="form-control">
						<option value="1">16 Players (Round of 16, quarter-final, semi-final and final)</option>
						<option value="2">8 Players (Quarter-final, semi-final and final)</option>
						<option value="3">4 Players (Semi-final and final)</option>
						<option value="4">2 Players (Final)</option>
					</select>
				</div>
			</div>

			<div id="plusMinus_div" class="form-group row">
				<label class="col-sm-2 col-form-label" for="counter3">Legs per match in knockout stage</label>
				<div class="input-group col-sm-2">
					<span class="input-group-btn">
						<input class="btn btn-default" type="button" value="-" id="moins" onclick="minusButton('<?php echo 3;?>')">
					</span>
					<input class="form-control plusMinusInput" pattern="^[1-9]\d*$" type="text" size="8" value="1" name="counter3" id="counter3" required>
					<span class="input-group-btn">
						<input class="btn btn-default" type="button" value="+" id="plus" onclick="plusButton2('<?php echo 3;?>')">
					</span>
				</div>
			</div>

			<div id="plusMinus_div" class="form-group row">
				<label class="col-sm-2 col-form-label" for="counter4">Number of legs in final</label>
				<div class="input-group col-sm-2">
					<span class="input-group-btn">
						<input class="btn btn-default" type="button" value="-" id="moins" onclick="minusButton('<?php echo 4;?>')">
					</span>
					<input class="form-control plusMinusInput" pattern="^[1-9]\d*$" type="text" size="8" value="1" name="counter4" id="counter4" required>
					<span class="input-group-btn">
						<input class="btn btn-default" type="button" value="+" id="plus" onclick="plusButton2('<?php echo 4;?>')">
					</span>
				</div>
			</div>

			<input class="btn" type="submit" name="submit" value="Pick Teams">
		</form>
		</div>
	</body>

</html>
