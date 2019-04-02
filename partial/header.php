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
			Bonjour, <?= $action->getUsername() ?> 
		</div>
		<ul>
			<li><a href="index.php">Page d'accueil</a></li>
			<?php
				if ($action->isLoggedIn()) {
					?>
					<li><a href="home.php">Home</a></li>
					<li>Calendrier</li>
					<li>Budget</li>
					<li>Listes</li>
					<?php
				}
				else {
					?>
					<li><a href="index.php">Se connecter</a></li>
					<?php
				}
			?>
		</ul>
		<?php
			if ($action->isLoggedIn()) {
				?>
				<div class="logout">
					[
					<a href="?logout=true">Déconnexion</a>
					]
				</div>
				<?php
			}
		?>
	</div>
	<div class="site-title-section">
		<h2>Coupling of things</h2>
		<?= $action->getPageTitle() ?>
	</div>

<div class="container">
