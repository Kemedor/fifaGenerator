<?php
session_start();

unset($_SESSION["player"]);
unset($_SESSION["teamPlayer"]);
unset($_SESSION["headToHead"]);
unset($_SESSION["headToHeadTeam"]);
unset($_SESSION["queryMessage"]);


if ( ($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST['submitNewPlayer']) ) {
  
	$playerName = test_input($_POST["playerName"]);
	
	$conn = connect_to_db();
	$query = "SELECT * FROM players WHERE name = '$playerName'";
	$result = mysqli_query($conn, $query) or die('Error querying database.');
	if ($result->num_rows == 1) {
		$_SESSION["queryMessage"] = "User exists";
	}
	else if ($result->num_rows == 0) {
		$query = "INSERT INTO players (name) VALUES ('$playerName')";
		$result = mysqli_query($conn, $query) or die('Error querying database.');
		$_SESSION["queryMessage"] = "User " . $playerName . " created";
	}		
	$conn->close();
	
}

if ( ($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST['submitNewMatch']) ) {
  
	$temp1 = test_input($_POST["player1Name"]);
	$temp2 = test_input($_POST["player2Name"]);
	
	$conn = connect_to_db();
	$query = "SELECT * FROM players WHERE name = '$temp1' or name = '$temp2' ORDER BY name";
	$result = mysqli_query($conn, $query) or die('Error querying database -- select players.');
	
	if ($result->num_rows != 2) {
		$_SESSION["queryMessage"] = "At least one of the users does not exist";
	}
	else if ($result->num_rows == 2) {
		
		if (strcmp($temp1,$temp2) <= 0) {
			$player1Name = $temp1;
			$team1Name = test_input($_POST["team1Name"]);
			$player1GoalsScored = intval(test_input($_POST["player1GoalsScored"]));
			$player2Name = $temp2;
			$team2Name = test_input($_POST["team2Name"]);
			$player2GoalsScored = intval(test_input($_POST["player2GoalsScored"]));
		}
		else {
			$player1Name = $temp2;
			$team1Name = test_input($_POST["team2Name"]);
			$player1GoalsScored = intval(test_input($_POST["player2GoalsScored"]));
			$player2Name = $temp1;
			$team2Name = test_input($_POST["team1Name"]);
			$player2GoalsScored = intval(test_input($_POST["player1GoalsScored"]));
		}
		
		
		$player1Wins = 0;
		$player1Draws = 0;
		$player1Loses = 0;
		$player2Wins = 0;
		$player2Draws = 0;
		$player2Loses = 0;
		
		if ($player1GoalsScored > $player2GoalsScored) {
			$player1Wins = 1;
			$player2Loses = 1;
		}
		else if ($player1GoalsScored == $player2GoalsScored) {
			$player1Draws = 1;
			$player2Draws = 1;
		}
		else {
			$player1Loses = 1;
			$player2Wins = 1;
		}
		
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////// Player ///////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		
		while($row = mysqli_fetch_assoc($result)) {
			
			$matchesPlayed = $row["matches_played"] + 1;
			
			if ($row["name"] == $player1Name) {
				$name = $player1Name;
				$wins = $row["wins"] + $player1Wins;
				$draws = $row["draws"] + $player1Draws;
				$loses = $row["loses"] + $player1Loses;
				$goalsScored = $row["goals_scored"] + $player1GoalsScored;
				$goalsAgainst = $row["goals_against"] + $player2GoalsScored;
			}
			else {
				$name = $player2Name;
				$wins = $row["wins"] + $player2Wins;
				$draws = $row["draws"] + $player2Draws;
				$loses = $row["loses"] + $player2Loses;
				$goalsScored = $row["goals_scored"] + $player2GoalsScored;
				$goalsAgainst = $row["goals_against"] + $player1GoalsScored;
			}
			$query2 = "UPDATE players SET matches_played='$matchesPlayed' , wins='$wins' , draws='$draws' , loses='$loses' , "
				   . "goals_scored='$goalsScored' , goals_against='$goalsAgainst' WHERE name='$name'";
			$result2 = mysqli_query($conn, $query2) or die('Error querying database -- update players.');
			
		}
		
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////// Team player //////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		
		
		$query = "SELECT * FROM team_player WHERE player_name = '$player1Name' AND team_name = '$team1Name'";
		$result = mysqli_query($conn, $query) or die('Error querying database -- select team_player 1.');
		
		if ($result->num_rows == 1) {
			$row = mysqli_fetch_assoc($result);
			$matchesPlayed = $row["matches_played"] + 1;
			$wins = $row["wins"] + $player1Wins;
			$draws = $row["draws"] + $player1Draws;
			$loses = $row["loses"] + $player1Loses;
			$goalsScored = $row["goals_scored"] + $player1GoalsScored;
			$goalsAgainst = $row["goals_against"] + $player2GoalsScored;
			$query2 = "UPDATE team_player SET matches_played='$matchesPlayed' , wins='$wins' , draws='$draws' , loses='$loses' , "
				   . "goals_scored='$goalsScored' , goals_against='$goalsAgainst' WHERE player_name='$player1Name' AND team_name = '$team1Name'";
			$result2 = mysqli_query($conn, $query2) or die('Error querying database -- update team_player 1.');
		}
		else {
			$matchesPlayed = 1;
			$query2 = "INSERT INTO team_player (player_name,team_name,matches_played,wins,draws,loses,goals_scored,goals_against) 
					   VALUES ('$player1Name','$team1Name','$matchesPlayed','$player1Wins','$player1Draws','$player1Loses','$player1GoalsScored','$player2GoalsScored')";
			$result2 = mysqli_query($conn, $query2) or die('Error querying database -- insert team_player 1.');
		}
		
		
		$query = "SELECT * FROM team_player WHERE player_name = '$player2Name' AND team_name = '$team2Name'";
		$result = mysqli_query($conn, $query) or die('Error querying database -- select team_player 2.');
		
		if ($result->num_rows == 1) {
			$row = mysqli_fetch_assoc($result);
			$matchesPlayed = $row["matches_played"] + 1;
			$wins = $row["wins"] + $player2Wins;
			$draws = $row["draws"] + $player2Draws;
			$loses = $row["loses"] + $player2Loses;
			$goalsScored = $row["goals_scored"] + $player2GoalsScored;
			$goalsAgainst = $row["goals_against"] + $player1GoalsScored;
			$query2 = "UPDATE team_player SET matches_played='$matchesPlayed' , wins='$wins' , draws='$draws' , loses='$loses' , "
				   . "goals_scored='$goalsScored' , goals_against='$goalsAgainst' WHERE player_name='$player2Name' AND team_name = '$team2Name'";
			$result2 = mysqli_query($conn, $query2) or die('Error querying database -- update team_player 2.');
		}
		else {
			$query2 = "INSERT INTO team_player (player_name,team_name,matches_played,wins,draws,loses,goals_scored,goals_against) 
					   VALUES ('$player2Name','$team2Name',1,'$player2Wins','$player2Draws','$player2Loses','$player2GoalsScored','$player1GoalsScored')";
			$result2 = mysqli_query($conn, $query2) or die('Error querying database  -- insert team_player 2.');
		}
		
		
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////// Head to Head /////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		
		
		$query = "SELECT * FROM head_to_head WHERE player1_name = '$player1Name' AND player2_name = '$player2Name'";
		$result = mysqli_query($conn, $query) or die('Error querying database -- select head_to_head.');
		
		if ($result->num_rows == 1) {
			$row = mysqli_fetch_assoc($result);
			$matchesPlayed = $row["matches_played"] + 1;
			$wins = $row["player1_wins"] + $player1Wins;
			$draws = $row["draws"] + $player1Draws;
			$loses = $row["player2_wins"] + $player2Wins;
			$player1Goals = $row["player1_goals"] + $player1GoalsScored;
			$player2Goals = $row["player2_goals"] + $player2GoalsScored;
			$query2 = "UPDATE head_to_head SET matches_played='$matchesPlayed' , player1_wins='$wins' , draws='$draws' , player2_wins='$loses' , "
				   . "player1_goals='$player1Goals' , player2_goals='$player2Goals' WHERE player1_name = '$player1Name' AND player2_name = '$player2Name'";
			$result2 = mysqli_query($conn, $query2) or die('Error querying database  -- update head_to_head.');
		}
		else {
			$query2 = "INSERT INTO head_to_head (player1_name,player2_name,matches_played,player1_wins,draws,player2_wins,player1_goals,player2_goals) 
					   VALUES ('$player1Name','$player2Name','1','$player1Wins','$player1Draws','$player2Wins','$player1GoalsScored','$player2GoalsScored')";
			$result2 = mysqli_query($conn, $query2) or die('Error querying database  -- insert head_to_head.');
		}
		
		
		
		
		
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////// Head to Head Team ////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		
		
		$query = "SELECT * FROM head_to_head_team WHERE player1_name = '$player1Name' AND team1_name = '$team1Name' 
														AND player2_name = '$player2Name' AND team2_name = '$team2Name'";
		$result = mysqli_query($conn, $query) or die('Error querying database  -- select head_to_head_team.');
		
		if ($result->num_rows == 1) {
			$row = mysqli_fetch_assoc($result);
			$matchesPlayed = $row["matches_played"] + 1;
			$wins = $row["player1_wins"] + $player1Wins;
			$draws = $row["draws"] + $player1Draws;
			$loses = $row["player2_wins"] + $player2Wins;
			$player1Goals = $row["player1_goals"] + $player1GoalsScored;
			$player2Goals = $row["player2_goals"] + $player2GoalsScored;
			$query2 = "UPDATE head_to_head_team SET matches_played='$matchesPlayed' , player1_wins='$wins' , draws='$draws' , player2_wins='$loses' , "
				   . "player1_goals='$player1Goals' , player2_goals='$player2Goals'" 
				   . "WHERE player1_name = '$player1Name' AND team1_name = '$team1Name' AND player2_name = '$player2Name' AND team2_name = '$team2Name'";
			$result2 = mysqli_query($conn, $query2) or die('Error querying database  -- update head_to_head_team.');
		}
		else {
			$query2 = "INSERT INTO head_to_head_team (player1_name,team1_name,player2_name,team2_name,matches_played,player1_wins,draws,player2_wins,player1_goals,player2_goals) 
					   VALUES ('$player1Name','$team1Name','$player2Name','$team2Name','1','$player1Wins','$player1Draws','$player2Wins','$player1GoalsScored','$player2GoalsScored')";
			$result2 = mysqli_query($conn, $query2) or die('Error querying database  -- insert head_to_head_team.');
		}
		
		
		
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////// Matches History //////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		$overtime = test_input($_POST["overtime"]);
		$penalties = test_input($_POST["penalties"]);
		$penaltiesScore = test_input($_POST["penaltiesScore"]);
		
		$query = "INSERT INTO matches_history (player1_name,team1_name,player2_name,team2_name,player1_goals,player2_goals,overtime,penalties,penalties_score) 
				  VALUES ('$player1Name','$team1Name','$player2Name','$team2Name','$player1GoalsScored','$player2GoalsScored','$overtime','$penalties','$penaltiesScore')";
		$result = mysqli_query($conn, $query) or die('Error querying database  -- insert matches_history.');
		
		
	}
		
	$conn->close();
	
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



class Player { 
    public $id;
    public $name;
	public $stats;
    
    
    public function __construct ($Id, $Name, $Stats) { 
        $this->id = $Id;
		$this->name = $Name;
		$this->stats = $Stats;
    } 
}


class TeamPlayer {
    public $id;
	public $playerName;
    public $teamName;
	public $stats;
    
    
    public function __construct ($Id, $PlayerName, $TeamName, $Stats) { 
        $this->id = $Id;
		$this->playerName = $PlayerName;
		$this->teamName = $TeamName;
		$this->stats = $Stats;
    } 
} 


class Stats {
    public $matchesPlayed;
	public $wins;
	public $draws;
	public $loses;
	public $goalsScored;
	public $goalsAgainst;
	public $knockoutsPlayed;
	public $knockoutsWon;
	public $knockoutsFinalist;
	public $leagueAndKnockoutPlayed;
	public $leagueAndKnockoutWon;
	public $leagueAndKnockoutFinalist;
	
	public $winRatio;
	public $drawRatio;
	public $loseRatio;
	public $averageGoalsScored;
	public $averageGoalsAgainst;
    
    
    public function __construct ($MatchesPlayed, $Wins, $Draws, $Loses, $GoalsScored, $GoalsAgainst, $KnockoutsPlayed, $KnockoutsWon, $KnockoutsFinalist,
								 $LeagueAndKnockoutPlayed, $LeagueAndKnockoutWon, $LeagueAndKnockoutFinalist) { 
        $this->matchesPlayed = $MatchesPlayed;
		$this->wins = $Wins;
		$this->draws = $Draws;
		$this->loses = $Loses;
		$this->goalsScored = $GoalsScored;
		$this->goalsAgainst = $GoalsAgainst;
		$this->knockoutsPlayed = $KnockoutsPlayed;
		$this->knockoutsWon = $KnockoutsWon;
		$this->knockoutsFinalist = $KnockoutsFinalist;
		$this->leagueAndKnockoutPlayed = $LeagueAndKnockoutPlayed;
		$this->leagueAndKnockoutWon = $LeagueAndKnockoutWon;
		$this->leagueAndKnockoutFinalist = $LeagueAndKnockoutFinalist;
		
		$this->winRatio = number_format((float)$this->wins / $this->matchesPlayed, 2, '.', '') * 100;
		$this->drawRatio = number_format((float)$this->draws / $this->matchesPlayed, 2, '.', '') * 100;
		$this->loseRatio = number_format((float)$this->loses / $this->matchesPlayed, 2, '.', '') * 100;
		$this->averageGoalsScored = number_format((float)$this->goalsScored / $this->matchesPlayed, 1, '.', '');
		$this->averageGoalsAgainst = number_format((float)$this->goalsAgainst / $this->matchesPlayed, 1, '.', '');
    } 
}


?>

</!DOCTYPE html>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="../css/addNewItems.css">
		<script type="text/javascript" src="../js/plusMinusButton.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>
	
	

	
	<body>
	
		
		<div id="menu">
			<a href="tournament.php">New Tournament</a>
			<a href="personalStats.php">Personal Stats</a>
			<a href="headToHeadStats.php">Head to Head Stats</a>
			<a href="AddNewItems.php">Add New Items</a>
		</div>
		
		
		<?php 
		
		if (isset($_SESSION["queryMessage"])) {
		?>
		<h1 id="message"> <?php echo(htmlspecialchars($_SESSION["queryMessage"])); ?> </h1>
		<?php
		}
		
		?>
		
		<br><br><br>
		
	
		<form method="post" name="newPlayer" id="newPlayer" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h2>New player</h2>
			<input type="text" name="playerName" id="playerName">
			<input type="submit" name="submitNewPlayer" value="Add">  
		</form>
		
		<form method="post" name="newMatch" id="newMatch" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h2>New Match</h2>
			<br>
			Player 1 Name : <input type="text" name="player1Name" id="player1Name">
			Player 2 Name : <input type="text" name="player2Name" id="player2Name"><br>
			Player 1 Team : <input type="text" name="team1Name" id="player1Team">
			Player 2 Team : <input type="text" name="team2Name" id="player2Team"><br>
			Player 1 Goals Scored : <input type="text" name="player1GoalsScored" id="player1Goals">
			Player 2 Goals Scored : <input type="text" name="player2GoalsScored" id="player2Goals"><br>
			Overtime : <input type="checkbox" name="overtime" id="overtime"><br>
			Penalties : <input type="checkbox" name="penalties" id="penalties"><br>
			PenaltiesScore (e.g. 5-3) : <input type="text" size="5" name="penaltiesScore"><br>
			<input type="submit" name="submitNewMatch" value="Add">  
		</form>
		
		
		<br>
		

	</body>
	
</html>