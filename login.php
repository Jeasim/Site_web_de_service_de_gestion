<?php
	require_once("action/LoginAction.php");
	$action = new LoginAction();
	$action->execute();

	require_once("partial/header.php");
?>

<div class="form">
	<h2>Re-bienvenue!</h2>
	<form action="login.php" method="post">
		<div class="form-singleLine">
			<div class="form-label">
				Nom d'utilisateur 
			</div>
			<div class="form-input">
				<input id="usernameInput" type="text" name="username" class="input" required>
			</div>
		</div>
		<div class="form-singleLine">
			<div class="form-label">
				Mot de passe 
			</div>
			<div class="form-input">
				<input id="passwordInput" type="password" name="password" class="input" required>
			</div>
		</div>
	
		<button type="submit" class="form-submit">Se connecter</button>
	
	</form>
	<div id="validation-info">
		<?php if($action->wrongPassword){
			?> 
			Mot de passe invalid
			<?php
			} elseif($action->wrongUsername){
			?> 
			Usagé non-existant
			<?php
			}
		?>
	</div>
</div>



<?php
	require_once("partial/footer.php");
