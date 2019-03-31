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

<form action="index.php" method="post" id="formLogin">
	<div id="loginForm">
		<div class="form-singleLine">
			<div class="form-label">
				Nom d'utilisateur :
			</div>
			<div class="form-input">
				<input id="usernameInput" type="text" name="username" required>
			</div>
		</div>
		<div class="form-singleLine"></div>
			<div class="form-label">
				<div class="indication">
					Mot de passe :
			</div>
			<div class="form-input">
				<input id="passwordInput" type="password" name="password" required>
			</div>
		</div>
		<div class="form-singleLine"></div>
			<div class="form-input">
				<button type="submit">Connexion</button>
			</div>
		</div>
	</div>
</form>


<?php
	require_once("partial/footer.php");
