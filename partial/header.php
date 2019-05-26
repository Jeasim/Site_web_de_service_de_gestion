<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/global.css">
	<script src="js/jquerry.min.js"></script>
	<title>Coupling of things</title>

</head>
<body>

	<?php
		if ($action->isLoggedIn()) {
	?>

		<div class="header">	
			<div class="site-name">COUPLING OF THINGS</div>	
			<div class="menu">
				<nav>
					<ul id="menu-header">
						<li class="btn-header"><a href="home.php">Home</a></li>
						<li class="btn-header"><a href="calendarPage.php">Calendrier</a></li>
						<li class="btn-header"><a href="budgetPage.php">Budget</a></li>
						<li class="btn-header"><a href="listsPage.php">Listes</a></li>
					</ul>
				</nav>				
			</div>
			<div class="username-section">
				<a href="userSettingsPage.php" id="btn-settings"><?= $action->getFirstname() ?></a> 
			</div>
			<a href="?logout=true" class="logout-link">| Déconnexion |</a>
		</div>	

		
		<div class="body-wrapper">
					
			<h1 class="page-title"> <?=$action->getPageTitle()?> </h1>

	
	<?php
		}
		else {
	?>

		<div class="index-menu-accueil section-flex">
			<h2><a href="index.php" class="site-name">Coupling of things</a></h2>
			<nav>
				<ul id="home-header">
					<li class="home-btn"><a href="login.php" id="btn-login">Se connecter</a></li>
					<li class="home-btn"><a href="signup.php" id="btn-signup">S'inscrire</a></li>
				</ul>
			</nav>
		</div>

		<div class="body-wrapper">

	<?php
		}
	?>

					