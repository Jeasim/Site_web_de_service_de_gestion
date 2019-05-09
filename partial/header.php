<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/global.css">
	<title>Coupling of things</title>

</head>
<body>

	<!-- Pour les pages où l'usager est connecté -->
	<?php
		if ($action->isLoggedIn()) {
	?>

		<div class="header">	
			<div class="site-name">COUPLING OF THINGS</div>	
			<!-- <div class="imageUser"></div> -->
			<div class="menu">
				<nav>
					<ul>
						<li><a href="home.php">Home</a></li>
						<li><a href="calendarPage.php">Calendrier</a></li>
						<li><a href="budgetPage.php">Budget</a></li>
						<li><a href="listsPage.php">Listes</a></li>
					</ul>
				</nav>				
			</div>
			<div class="username-section">
				<?= $action->getFirstname() ?> 
			</div>
			<a href="?logout=true" class="logout-link">| Déconnexion |</a>
		</div>	

		<!-- Pour les pages accueils, login et signup  -->
	<?php
		}
		else {
	?>

		<div class="index-menu">
			<h2><a href="index.php">Coupling of things</a></h2>
			<nav>
				<ul>
					<li><a href="login.php">Se connecter</a></li>
					<li><a href="signup.php">S'inscrire</a></li>
				</ul>
			</nav>
		</div>

	<?php
		}
	?>
					
					
					
					
					
					
					
					
					
	
	

