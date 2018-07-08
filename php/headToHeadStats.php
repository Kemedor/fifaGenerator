<?php
session_start();


unset($_SESSION["player"]);
unset($_SESSION["teamPlayer"]);


if ( ($_SERVER["REQUEST_METHOD"] == "POST") && ($_POST['submitFindPlayers']) ) {


	unset($_SESSION["headToHead"]);
	unset($_SESSION["headToHeadPerTeam"]);

	$player1Name = test_input($_POST["player1Name"]);
	$player2Name = test_input($_POST["player2Name"]);

	$conn = connect_to_db();
	$query = "SELECT * FROM head_to_head WHERE (player1_name = '$player1Name' AND player2_name = '$player2Name') OR
											   (player1_name = '$player2Name' AND player2_name = '$player1Name')";
	$result = mysqli_query($conn, $query) or die('Error querying database.');
	if ($result->num_rows == 0) {
		$queryErr = "Invalid Players";
	}
	else if ($result->num_rows == 1) {
		while($row = mysqli_fetch_assoc($result)) {

			$stats = new HeadToHeadStats($row["matches_played"], $row["player1_wins"], $row["draws"], $row["player2_wins"],
										 $row["player1_goals"], $row["player2_goals"]);
			$headToHead = new HeadToHead($row["id"], $row["player1_name"], $row["player2_name"], $stats);
			$_SESSION['headToHead'] = $headToHead;

			$query = "SELECT * FROM head_to_head_team WHERE (player1_name = '$player1Name' AND player2_name = '$player2Name') OR
															(player1_name = '$player2Name' AND player2_name = '$player1Name')
													  ORDER BY team1_name , team2_name";
			$result = mysqli_query($conn, $query) or die('Error querying database.');
			if ($result->num_rows > 0) {
				$headToHeadPerTeam = array();
				while($row = mysqli_fetch_assoc($result)) {
					$stats = new HeadToHeadStats($row["matches_played"], $row["player1_wins"], $row["draws"], $row["player2_wins"],
												 $row["player1_goals"], $row["player2_goals"]);
					$headToHeadPerTeam[] = new HeadToHeadPerTeam($row["id"], $row["player1_name"], $row["team1_name"],
														   $row["player2_name"], $row["team2_name"], $stats);
				}
				$_SESSION['headToHeadPerTeam'] = $headToHeadPerTeam;
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



class HeadToHead {
    public $id;
    public $player1Name;
	public $player2Name;
	public $stats;

    public function __construct ($Id, $Player1Name, $Player2Name, $Stats) {
        $this->id = $Id;
		$this->player1Name = $Player1Name;
		$this->player2Name = $Player2Name;
		$this->stats = $Stats;
    }
}


class HeadToHeadPerTeam {
    public $id;
    public $player1Name;
	public $team1Name;
	public $player2Name;
	public $team2Name;
	public $stats;


    public function __construct ($Id, $Player1Name, $Team1Name, $Player2Name, $Team2Name, $Stats) {
        $this->id = $Id;
		$this->player1Name = $Player1Name;
		$this->team1Name = $Team1Name;
		$this->player2Name = $Player2Name;
		$this->team2Name = $Team2Name;
		$this->stats = $Stats;
    }
}


class HeadToHeadStats {
    public $matchesPlayed;
	public $player1Wins;
	public $draws;
	public $player2Wins;
	public $player1Goals;
	public $player2Goals;

	public $player1WinRatio;
	public $drawRatio;
	public $player2WinRatio;
	public $player1AverageGoalsScored;
	public $player2AverageGoalsScored;


    public function __construct ($MatchesPlayed, $Player1Wins, $Draws, $Player2Wins, $Player1Goals, $Player2Goals) {
        $this->matchesPlayed = $MatchesPlayed;
		$this->player1Wins = $Player1Wins;
		$this->draws = $Draws;
		$this->player2Wins = $Player2Wins;
		$this->player1Goals = $Player1Goals;
		$this->player2Goals = $Player2Goals;

		$this->player1WinRatio = number_format((float)$this->player1Wins / $this->matchesPlayed, 2, '.', '') * 100;
		$this->drawRatio = number_format((float)$this->draws / $this->matchesPlayed, 2, '.', '') * 100;
		$this->player2WinRatio = number_format((float)$this->player2Wins / $this->matchesPlayed, 2, '.', '') * 100;
		$this->player1AverageGoalsScored = number_format((float)$this->player1Goals / $this->matchesPlayed, 1, '.', '');
		$this->player2AverageGoalsScored = number_format((float)$this->player2Goals / $this->matchesPlayed, 1, '.', '');
    }
}


?>

</!DOCTYPE html>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="../css/headToHeadStats.css">
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
    divsO = document.getElementById("selectForm").getElementsByClassName('selectShowHide');
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

		<form class="form-inline" method="post" name="findPlayers" id="findPlayers" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="row">
				<label class="col-sm-3 col-form-label" for="submitFindPlayers">Find players:</label>
				<input class="col-sm-2 form-control" type="text" name="player1Name" id="player1Name" required>
				<input class="col-sm-2 form-control" type="text" name="player2Name" id="player2Name" required>
				<input class="btn" type="submit" name="submitFindPlayers" value="GO!">
			</div>
		</form>

		<?php
		if (isset($_SESSION['headToHead'])) {
		?>

			<form method="post" id="selectForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<select name="selMyList" onchange="showHide(this)">
					<option value="1">Total</option>
					<?php
						for ($i=0; $i < count($_SESSION['headToHeadPerTeam']); $i++) {
					?>
						<option value="<?php echo htmlspecialchars($i+2);?>">
							<?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->team1Name . " - " . $_SESSION['headToHeadPerTeam'][$i]->team2Name);?>
						</option>
					<?php
						}
					?>
				</select>


				<div id="statsView1" class="selectShowHide">


					<div id="player1">
						<li> <?php echo htmlspecialchars($_SESSION['headToHead']->player1Name);?> </li>
						<br><br><br>
						<li> Wins: <?php echo htmlspecialchars($_SESSION['headToHead']->stats->player1Wins);?> </li>
						<li> Win Ratio: <?php echo htmlspecialchars($_SESSION['headToHead']->stats->player1WinRatio . "%");?> </li>
						<br><br>
						<li> Goals Scored: <?php echo htmlspecialchars($_SESSION['headToHead']->stats->player1Goals);?> </li>
						<li> Average Goals Scored: <?php echo htmlspecialchars($_SESSION['headToHead']->stats->player1AverageGoalsScored);?> </li>
					</div>

					<div id="player2">
						<li> <?php echo htmlspecialchars($_SESSION['headToHead']->player2Name);?> </li>
						<br><br><br>
						<li> Wins: <?php echo htmlspecialchars($_SESSION['headToHead']->stats->player2Wins);?> </li>
						<li> Win Ratio: <?php echo htmlspecialchars($_SESSION['headToHead']->stats->player2WinRatio . "%");?> </li>
						<br><br>
						<li> Goals Scored: <?php echo htmlspecialchars($_SESSION['headToHead']->stats->player2Goals);?> </li>
						<li> Average Goals Scored: <?php echo htmlspecialchars($_SESSION['headToHead']->stats->player2AverageGoalsScored);?> </li>
					</div>

					<div id="rest">
						<br><br>
						<li> Matches Played: <?php echo htmlspecialchars($_SESSION['headToHead']->stats->matchesPlayed);?> </li>
						<br>
						<li> Draws: <?php echo htmlspecialchars($_SESSION['headToHead']->stats->draws);?> </li>
						<li> Draw Ratio: <?php echo htmlspecialchars($_SESSION['headToHead']->stats->drawRatio . "%");?> </li>
					</div>



				</div>

				<?php
				for ($i=0; $i < count($_SESSION['headToHeadPerTeam']); $i++) {
				?>

				<div id="<?php echo htmlspecialchars("statsView" . ($i+2));?>"  class="selectShowHide" style="display:none;">

					<div id="player1">
						<li> <?php echo htmlspecialchars($_SESSION['headToHead']->player1Name);?> </li>
						<li> Team: <?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->team1Name);?> </li>
						<br><br><br>
						<li> Wins: <?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->stats->player1Wins);?> </li>
						<li> Win Ratio: <?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->stats->player1WinRatio . "%");?> </li>
						<br><br>
						<li> Goals Scored: <?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->stats->player1Goals);?> </li>
						<li> Average Goals Scored: <?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->stats->player1AverageGoalsScored);?> </li>
					</div>

					<div id="player2">
						<li> <?php echo htmlspecialchars($_SESSION['headToHead']->player2Name);?> </li>
						<li> Team: <?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->team2Name);?> </li>
						<br><br><br>
						<li> Wins: <?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->stats->player2Wins);?> </li>
						<li> Win Ratio: <?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->stats->player2WinRatio . "%");?> </li>
						<br><br>
						<li> Goals Scored: <?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->stats->player2Goals);?> </li>
						<li> Average Goals Scored: <?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->stats->player2AverageGoalsScored);?> </li>
					</div>

					<div id="rest">
						<br><br><br>
						<li> Matches Played: <?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->stats->matchesPlayed);?> </li>
						<br>
						<li> Draws: <?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->stats->draws);?> </li>
						<li> Draw Ratio: <?php echo htmlspecialchars($_SESSION['headToHeadPerTeam'][$i]->stats->drawRatio . "%");?> </li>
					</div>



				</div>

				<?php
				}
				?>

			</form>





		<?php
		}
		?>




	</body>

</html
