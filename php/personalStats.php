<?php
session_start();

unset($_SESSION["headToHead"]);
unset($_SESSION["headToHeadTeam"]);


if ( ($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST['submitFindPlayer']) ) {


	unset($_SESSION["player"]);
	unset($_SESSION["teamPlayer"]);

	$playerName = test_input($_POST["playerName"]);

	$conn = connect_to_db();
	$query = "SELECT * FROM players WHERE name = '$playerName'";
	$result = mysqli_query($conn, $query) or die('Error querying database.');
	if ($result->num_rows == 0) {
		$queryErr = "Invalid User";
	}
	else if ($result->num_rows == 1) {
		while($row = mysqli_fetch_assoc($result)) {

			$stats = new Stats($row["matches_played"], $row["wins"], $row["draws"], $row["loses"], $row["goals_scored"], $row["goals_against"],
							   $row["knockouts_played"], $row["knockouts_won"], $row["knockouts_finalist"],
							   $row["league_and_knockout_played"], $row["league_and_knockout_won"], $row["league_and_knockout_finalist"]);
			$player = new Player($row["id"], $row["name"], $stats);
			$_SESSION['player'] = $player;

			$query = "SELECT * FROM team_player WHERE player_name = '$playerName'";
			$result = mysqli_query($conn, $query) or die('Error querying database.');
			if ($result->num_rows > 0) {
				$teamPlayer = array();
				while($row = mysqli_fetch_assoc($result)) {
					$stats = new Stats($row["matches_played"], $row["wins"], $row["draws"], $row["loses"], $row["goals_scored"], $row["goals_against"],
							   $row["knockouts_played"], $row["knockouts_won"], $row["knockouts_finalist"],
							   $row["league_and_knockout_played"], $row["league_and_knockout_won"], $row["league_and_knockout_finalist"]);
					$teamPlayer[] = new TeamPlayer($row["id"], $row["player_name"], $row["team_name"], $stats);
				}
				$_SESSION['teamPlayer'] = $teamPlayer;
			}

		}
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
		<link rel="stylesheet" type="text/css" href="../css/statistics.css">
		<link rel="import" href="./navbar.html">
	</head>

	<script type="text/javascript">

	function showHide(elem) {
	    if(elem.selectedIndex >= 0) {
	         //hide the divs
	         for(var i=0; i < divsO.length; i++) {
	             divsO[i].style.display = 'none';
	        }
	        //unhide the selected div
	        document.getElementById('statsView'+elem.value).style.display = 'block';
	    }
	}

	window.onload=function() {
	    //get the divs to show/hide
	    divsO = document.getElementById("selectForm").getElementsByTagName('div');
	}
	</script>

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

		<form class="form-inline" method="post" name="findPlayer" id="findPlayer" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<input class="form-control" type="text"
				   name="playerName" id="playerName" maxlength="30" placeholder="Find player" required>
			<input class="btn" type="submit" name="submitFindPlayer" value="GO!">
		</form>


		<?php
		if (isset($_SESSION['player'])) {
		?>

			<form method="post" id="selectForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<select name="selMyList" onchange="showHide(this)">
					<option value="1">Total</option>
					<?php
						for ($i=0; $i < count($_SESSION['teamPlayer']); $i++) {
					?>
						<option value="<?php echo htmlspecialchars($i+2);?>"><?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->teamName);?></option>
					<?php
						}
					?>
				</select>

				<li> Player Name: <?php echo htmlspecialchars($_SESSION['player']->name);?> </li>

				<div id="statsView1">
					<li> Matches Played: <?php echo htmlspecialchars($_SESSION['player']->stats->matchesPlayed);?> </li>
					<li> Wins: <?php echo htmlspecialchars($_SESSION['player']->stats->wins);?> </li>
					<li> Draws: <?php echo htmlspecialchars($_SESSION['player']->stats->draws);?> </li>
					<li> Loses: <?php echo htmlspecialchars($_SESSION['player']->stats->loses);?> </li>
					<li> Goals Scored: <?php echo htmlspecialchars($_SESSION['player']->stats->goalsScored);?> </li>
					<li> Goals Against: <?php echo htmlspecialchars($_SESSION['player']->stats->goalsAgainst);?> </li>
					<li> Knockouts Played: <?php echo htmlspecialchars($_SESSION['player']->stats->knockoutsPlayed);?> </li>
					<li> Knockouts Won: <?php echo htmlspecialchars($_SESSION['player']->stats->knockoutsWon);?> </li>
					<li> Knockouts Finalist: <?php echo htmlspecialchars($_SESSION['player']->stats->knockoutsFinalist);?> </li>
					<li> League and Knockouts Played: <?php echo htmlspecialchars($_SESSION['player']->stats->leagueAndKnockoutPlayed);?> </li>
					<li> League and Knockouts Won: <?php echo htmlspecialchars($_SESSION['player']->stats->leagueAndKnockoutWon);?> </li>
					<li> League and Knockouts Finalist: <?php echo htmlspecialchars($_SESSION['player']->stats->leagueAndKnockoutFinalist);?> </li>

					<li> Win Ratio: <?php echo htmlspecialchars($_SESSION['player']->stats->winRatio . "%");?> </li>
					<li> Draw Ratio: <?php echo htmlspecialchars($_SESSION['player']->stats->drawRatio . "%");?> </li>
					<li> Lose Ratio: <?php echo htmlspecialchars($_SESSION['player']->stats->loseRatio . "%");?> </li>
					<li> Average Goals Scored: <?php echo htmlspecialchars($_SESSION['player']->stats->averageGoalsScored);?> </li>
					<li> Average Goals Against: <?php echo htmlspecialchars($_SESSION['player']->stats->averageGoalsAgainst);?> </li>

				</div>

				<?php
				for ($i=0; $i < count($_SESSION['teamPlayer']); $i++) {
				?>

				<div id="<?php echo htmlspecialchars("statsView" . ($i+2));?>" style="display:none;">
					<li> Team Name: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->teamName);?> </li>
					<li> Matches Played: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->matchesPlayed);?> </li>
					<li> Wins: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->wins);?> </li>
					<li> Draws: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->draws);?> </li>
					<li> Loses: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->loses);?> </li>
					<li> Goals Scored: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->goalsScored);?> </li>
					<li> Goals Against: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->goalsAgainst);?> </li>
					<li> Knockouts Played: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->knockoutsPlayed);?> </li>
					<li> Knockouts Won: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->knockoutsWon);?> </li>
					<li> Knockouts Finalist: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->knockoutsFinalist);?> </li>
					<li> League and Knockouts Played: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->leagueAndKnockoutPlayed);?> </li>
					<li> League and Knockouts Won: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->leagueAndKnockoutWon);?> </li>
					<li> League and Knockouts Finalist: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->leagueAndKnockoutFinalist);?> </li>

					<li> Win Ratio: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->winRatio . "%");?> </li>
					<li> Draw Ratio: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->drawRatio . "%");?> </li>
					<li> Lose Ratio: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->loseRatio . "%");?> </li>
					<li> Average Goals Scored: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->averageGoalsScored);?> </li>
					<li> Average Goals Against: <?php echo htmlspecialchars($_SESSION['teamPlayer'][$i]->stats->averageGoalsAgainst);?> </li>
				</div>

				<?php
				}
				?>

			</form>

		<?php
		}
		?>

	</body>

</html>
