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
	<?php
		if ($action->isLoggedIn()) {
	?>
		<div class="menu">		
			<div class="imageUser"></div>
			<div class="username-section">
				<?= $action->getFirstname() ?> 
			</div>
			<ul>
				<li><a href="home.php">Home</a></li>
				<li><a href="calendarPage.php">Calendrier</a></li>
				<li><a href="budgetPage.php">Budget</a></li>
				<li><a href="listsPage.php">Listes</a></li>
				<li><a href="?logout=true">Déconnexion</a></li>
			</ul>
		</div>
		<div class="site-title-section">
			<h2>Coupling of things</h2>
			<?= $action->getPageTitle() ?>
		</div>
		<div class="container">

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
	
	

