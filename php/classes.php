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