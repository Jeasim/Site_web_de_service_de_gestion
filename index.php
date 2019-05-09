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



<?php
	require_once("partial/footer.php");
