<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="css/global.css">
	<title>Coupling</title>

</head>
<body>
<div class="header">
				<div class="site-title-section">
					<h2>Coupling of things</h2>
					<?= $action->getPageTitle() ?>
				</div>
				<div class="username-section">
					Bonjour, <?= $action->getUsername() ?> !
					<?php
						if ($action->isLoggedIn()) {
							?>
							<div>
								[
								<a href="?logout=true">Déconnexion</a>
								]
							</div>
							<?php
						}
					?>
				</div>
				<div class="clear"></div>

				<div class="menu">
					<ul>
						<li><a href="index.php">Accueil du site</a></li>
						<?php
							if ($action->isLoggedIn()) {
								?>
								<li><a href="home.php">Mon accueil perso</a></li>
								<?php
							}
							else {
								?>
								<li><a href="login.php">Se connecter</a></li>
								<?php
							}
						?>
					</ul>
				</div>
			</div>
<div class="container">
