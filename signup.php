<?php
	require_once("action/SignupAction.php");
	$action = new SignupAction();
	$action->execute();

	require_once("partial/header.php");
?>
<script src="js/signup.js"></script>
<script src="js/jquerry.min.js"></script>

<div id="sideSection">
<h1>Coupling</h1>
<p id="presentation">Coupling est une solution simple pour les vies de couple compliquées. Vous pourrez dorénavant être en synchronicité dans l'organisation de votre planning mutuel.</p>
</div>

<form action="signup.php" method="post">
	<div id="signup-form">
		<div class="form-singleLine">
			<div class="form-label">
				Nom d'utilisateur :
			</div>
			<div class="form-input">
				<input type="text" name="username" id="username" required>
			</div>
			<div class="validation-info" id="username-check">
			</div>
		</div>
		<div class="form-singleLine">
			<div class="form-label">
				Email :
			</div>
			<div class="form-input">
				<input type="email" name="email" id="email" required>
			</div>
			<div class="validation-info" id="email-check">
			</div>
		</div>        
		<div class="form-singleLine">
			 <div class="form-label">
				 Prénom :
			 </div>
			 <div class="form-input">
				 <input type="text" name="firstName" required>
			 </div>
			 <div class="validation-info">
			</div>
		 </div>
		 <div class="form-singleLine">
			 <div class="form-label">
				 Nom :
			 </div>
			 <div class="form-input">
				 <input type="text" name="lastName" required>
			 </div>
			 <div class="validation-info">
			</div>
		 </div>
		<div class="form-singleLine">
			<div class="form-label">
				Mot de passe :
			</div>
			<div class="form-input">
				<input type="password" name="password" id="password" required>
			</div>
			<div class="validation-info">
			</div>
        </div>
        <div class="form-singleLine">
			<div class="form-label">
				Confirmez le mot de passe :
			</div>
			<div class="form-input">
				<input type="password" name="password-confirm" id="password-confirm" required>
			</div>
			<div class="validation-info" id="passwords-check">
			</div>
        </div>
        <div class="form-singleLine">
			<div class="form-label">
				Nom d'usager de votre partenaire (facultatif) :
			</div>
			<div class="form-input">
				<input type="text" name="partner">
			</div>
			<div class="validation-info">
			</div>
        </div>
        
		<div class="form-singleLine">
			<div class="form-input">
				<button type="submit">S'inscrire</button>
			</div>
		</div>
	</div>
</form>


<?php
	require_once("partial/footer.php");
