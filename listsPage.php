<?php
	require_once("action/ListsPageAction.php");
	$action = new ListsPageAction();
	$action->execute();

	require_once("partial/header.php");
?>
<script src="js/lists.js"></script>

<div class="btn-group-lists">

	<div class="btn-VoirListes">Voir listes</div>
	<div class="btn-AjouterListe">Ajouter une liste</div>

</div>






<div class="all-lists">
	
	<template id="list-template">
		<div class="list-name"></div>
		<div class="list-elements"></div>
	</template>

</div>

<div>
	<button class="add-list-button" onclick="addList()">Ajouter
</div>

<div class="new-list">

	<form action="listsPage.php" method="post">
		<input type="text" name="new-list-name">
	</form>

</div>


<?php
	require_once("partial/footer.php");