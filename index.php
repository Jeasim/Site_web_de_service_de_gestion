<?php
	require_once("action/IndexAction.php");
	$action = new IndexAction();
	$action->execute();

	require_once("partial/header.php");
?>

<div id="sideSection">
	<h1>Coupling</h1>
	<p id="presentation">Coupling est une solution simple pour les vies de couple compliquées. Vous pourrez dorénavant être en synchronicité dans l'organisation de votre planning</p>
</div>
<!-- 
<div id="loginForm">
	<form action="index.php" method="post">
		<div class="form-singleLine">
			<div class="form-label">
				Nom d'utilisateur :
			</div>
			<div class="form-input">
				<input id="usernameInput" type="text" name="username" required>
			</div>
			<div class="validation-info">
				<?php if($action->wrongUsername){
				?> 
				Usager non-existant!
				<?php
				}
				?>
			</div>
		</div>
		<div class="form-singleLine">
			<div class="form-label">
				Mot de passe :
			</div>
			<div class="form-input">
				<input id="passwordInput" type="password" name="password" required>
			</div>
			<div class="validation-info">
				<?php if($action->wrongPassword){
				?> 
				Mauvais mot de passe!
				<?php
				}
				?>
			</div>
		</div>
		<div class="form-singleLine"></div>
			<button type="submit">Connexion</button>
		</div>
	</form>
	<a href="signup.php">S'inscrire</a>
</div> -->



<?php
	require_once("partial/footer.php");
