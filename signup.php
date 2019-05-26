<?php
	require_once("action/SignupAction.php");
	$action = new SignupAction();
	$action->execute();

	require_once("partial/header.php");
?>
<script src="js/signup.js"></script>
<script src="js/jquerry.min.js"></script>

<div class="form">
	<h2>Bienvenue!</h2>
	<form action="signup.php" method="post">
		<div class="form-singleLine">
			<div class="form-label">
				Nom d'utilisateur 
			</div>
			<div class="form-input">
				<input type="text" name="username" id="username" class="input" required>
			</div>

		</div>
		<div class="form-singleLine">
			<div class="form-label">
				Adresse courriel 
			</div>
			<div class="form-input">
				<input type="email" name="email" id="email" class="input" required>
			</div>			
		</div>        
		<div class="form-singleLine">
			 <div class="form-label">
				 Prénom 
			 </div>
			 <div class="form-input">
				 <input type="text" name="firstName" class="input" required>
			 </div>
		 </div>
		 <div class="form-singleLine">
			 <div class="form-label">
				 Nom 
			 </div>
			 <div class="form-input">
				 <input type="text" name="lastName" class="input" required>
			 </div>
		 </div>
		<div class="form-singleLine">
			<div class="form-label">
				Mot de passe 
			</div>
			<div class="form-input">
				<input type="password" name="password" id="password" class="input" required>
			</div>
        </div>
        <div class="form-singleLine">
			<div class="form-label">
				Confirmation du mot de passe 
			</div>
			<div class="form-input">
				<input type="password" name="password-confirm" id="password-confirm" class="input" required>
			</div>
		</div>  
		<!-- <div class="form-singleLine">
			<div class="form-input">
				<input type="file"/>
			</div>
		</div>       -->
		
		<button type="submit" class="form-submit">S'inscrire</button>
		
	</form>
	<div id="validation-info"></div>
</div>


<?php
	require_once("partial/footer.php");
