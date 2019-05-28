<?php
	require_once("action/BudgetPageAction.php");
	$action = new BudgetPageAction();
	$action->execute();

	require_once("partial/header.php");
?>

<script src="js/budget.js"></script>

<div class="expenses-list">

	<h2 class="sub-title">Liste des dépenses</h2>

	<div id="expenses-complete-array">
		<ul class="list-expenses"> 
			<li class="expenses-single-line">
				<div class="column-description expense">Description</div>
				<div class="column-description expense">Type</div>
				<div class="column-description expense">Endroit</div>
				<div class="column-description expense">Montant</div>
				<div class="column-description expense">Date</div>
				<div class="column-description expense" id="column-description-last">Acheteur</div>
			</li>
		</ul>
		<ul class="list-expenses" id="expenses-ul"> 
			<?php 
				foreach ($action->expenses as $expense) {
					if($expense['id_owner'] == $_SESSION["user_id"]){

				?>		
					<li class="expenses-single-line color-1" onclick="manageExpenseOptions(<?= $expense['id'] ?>, this)">
				<?php
					}
				else{
				?>
					<li class="expenses-single-line color-2" onclick="manageExpenseOptions(<?= $expense['id'] ?>, this)">
				<?php
				}
				?>	
						<div class="expenses-description expense"> <?= $expense['description'] ?> </div>
						<div class="expenses-type expense"> <?= $expense['type'] ?> </div>
						<div class="expenses-place expense"> <?= $expense['place'] ?> </div>
						<div class="expenses-price expense money"> <?= $expense['price'] ?>$ </div>
						<div class="expenses-date expense"> <?= $expense['date_of_purchase'] ?> </div>
						<div class="expenses-owner expense"> <?= $expense['firstname'] ?> </div>
					</li>
			<?php
			}
			?>
		</ul>
	</div>

	<div class="btn-group" id="btn-group-expenses">
		<div class="btn btn-modify" onclick="modifyExpense()">Modifier</div>
		<div class="btn btn-delete" onclick="deleteExpense()">Supprimer</div>
	</div>

</div>

<div class="section-flex">
	
	<div class="form" id="form-new-expense">

		<h2 class="sub-title">Ajouter une dépenses</h2>

		<div class="form-singleLine">
			<div class="form-label">Decription</div>
			<input type="text" name="new-expense-description" class="form-input">
		</div>

		
		<div class="form-singleLine">
			<div class="form-label">Type d'achat</div>
			<select name="new-expense-type" id="expense-type-select" class="form-input">

				<?php 
					foreach ($action->expenseTypes as $expenseType) {
				?>
					<option value="<?= $expenseType ?>" name="new-expense-type"><?= $expenseType ?></option>
				<?php
					}
				?>

			</select>
		</div>

		<div class="form-singleLine">
			<div class="form-label">Endroit de l'achat</div>
			<input type="text" name="new-expense-place" class="form-input">
		</div>

		<div class="form-singleLine">
			<div class="form-label">Coût</div>
			<input type="text"name="new-expense-price" class="form-input">
		</div>

		<div class="form-singleLine">
			<div class="form-label">Acheteur</div>
			<select name="new-expense-owner" id="expense-owner-select" class="form-input">

					<option value="<?= $_SESSION["user_id"] ?>"><?= $_SESSION["user_firstname"] ?></option>

				<?php 
					if($_SESSION["partner_id"] != 0){
				?>
					<option value="<?= $_SESSION["partner_id"] ?>"><?= $_SESSION["partner_firstname"] ?></option>
				<?php
					}
				?>

			</select>
		</div>

		<div class="form-singleLine">
			<div class="form-label">Date de l'achat</div>
			<input type="date" name="new-expense-date-purchase" id="new-expense-date-purchase" class="form-input">
		</div>	

		<div class="form-singleLine" id="form-expense-btn-div">
			<button type="submit" onclick="addNewExpense()" class="form-submit">Ajouter</button>
		</div>	
	</div>


	<div class="expenses-summary">

		<h2 class="sub-title">Résumé</h2>

		<div class="section-flex expenses-summary-array">
			<div class="summary-column" id="first-column">
				<div>\------</div>
				<div>Total : </div>
				<div>Balance : </div>
			</div>

			<div class="expenses-sum-user summary-column color-1">
				<div><?= $_SESSION["user_firstname"] ?></div>
				<div class="money" id="user-sum"> <?= $action->userExpensesSum ?>$ </div>
				<div class="money" id="user-blance"> <?= $action->userExpensesBalance ?>$ </div>
			</div>

			<?php 
				if($_SESSION["partner_id"] != 0){
			?>
				<div class="expenses-sum-partner summary-column color-2">
					<div><?= $_SESSION["partner_firstname"] ?></div>
					<div class="money" id="partner-sum"> <?= $action->partnerExpensesSum ?>$ </div>
					<div class="money" id="user-blance"> <?= $action->partnerExpensesBalance ?>$ </div>
				</div>
			<?php
			}
			?>
		</div>

	</div>

</div>

<?php
	require_once("partial/footer.php");
