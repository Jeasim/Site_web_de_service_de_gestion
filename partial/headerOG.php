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
	<div class="menu">		
		<div class="imageUser"></div>
		<div class="username-section">
			<?= $action->getFirstname() ?> 
		</div>
		<ul>
			<?php
				if ($action->isLoggedIn()) {
					?>
					<li><a href="home.php">Home</a></li>
					<li><a href="calendarPage.php">Calendrier</a></li>
					<li><a href="budgetPage.php">Budget</a></li>
					<li><a href="listsPage.php">Listes</a></li>
					<li><a href="?logout=true">Déconnexion</a></li>
					<?php
				}
				else {
					?>
					<li><a href="login.php">Se connecter</a></li>
					<li><a href="signup.php">S'inscire</a></li>
					<?php
				}
			?>
		</ul>
	</div>
	<div class="site-title-section">
		<h2>Coupling of things</h2>
		<?= $action->getPageTitle() ?>
	</div>
	<div class="container">

