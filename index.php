<?php
session_start();
?>

</!DOCTYPE html>
<html>

	<head>
		<link rel="stylesheet" type="text/css" href="./css/indexStyle.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	</head>

	<body>
		<nav id="menu" class="navbar">
			<div class="fifadiv">
				<img/>
			</div>
			<ul>
				<li>
					<i class="fa fa-trophy"></i>
					<a href="./php/tournament.php">New Tournament</a>
				</li>
				<li>
					<i class="fas fa-chart-pie"></i>
					<a href="./php/personalStats.php">Personal Stats</a>
				</li>
				<li>
					<i class="fa fa-users"></i>
					<a href="./php/headToHeadStats.php">Head to Head Stats</a>
				</li>
				<li>
					<i class="fa fa-plus-circle"></i>
					<a href="./php/AddNewItems.php">Add New Items</a>
				</li>
			</ul>
		</nav>
	</body>

</html>
