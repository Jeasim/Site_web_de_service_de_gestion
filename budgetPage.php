<?php
	require_once("action/BudgetPageAction.php");
	$action = new BudgetPageAction();
	$action->execute();

	require_once("partial/header.php");
?>

<script src="js/budget.js"></script>

<div class="expenses-list">

	<h2 class="sub-title">Liste des dépenses</h2>

	<ul class="list-expenses"> 
		<li class="expenses-single-line">
			<div class="expenses-description expense">Description</div>
			<div class="expenses-type expense">Type</div>
			<div class="expenses-place expense">Endroit</div>
			<div class="expenses-price expense">Montant</div>
			<div class="expenses-date expense">Date</div>
			<div class="expenses-owner expense">Acheteur</div>
		</li>

		<?php 
			foreach ($action->expenses as $expense) {
				if($expense['id_owner'] == $_SESSION["user_id"]){

			?>		
					<div class="color-1">
			<?php
				}
			else{
			?>
					<div class="color-2">
			<?php
			}
			?>	
				<li class="expenses-single-line" onclick="manageExpenseOptions(<?= $expense['id'] ?>)">
					<div class="expenses-description expense"> <?= $expense['description'] ?> </div>
					<div class="expenses-type expense"> <?= $expense['type'] ?> </div>
					<div class="expenses-place expense"> <?= $expense['place'] ?> </div>
					<div class="expenses-price expense money"> <?= $expense['price'] ?>$ </div>
					<div class="expenses-date expense"> <?= $expense['date_of_purchase'] ?> </div>
					<div class="expenses-owner expense"> <?= $expense['firstname'] ?> </div>
				</li>
			</div>
		<?php
		}
		
		?>
	</ul>

</div>

<div class="section-flex">
	
	<div class="form-new-expense">

		<h2 class="sub-title">Ajouter une dépenses</h2>

		<div class="form-single-line">
			<div>Decription</div>
			<input type="text" name="new-expense-description">
		</div>

		
		<div class="form-single-line">
			<div>Type d'achat</div>
			<select name="new-expense-type" id="expense-type-select">

				<?php 
					foreach ($action->expenseTypes as $expenseType) {
				?>
					<option value="<?= $expenseType ?>" name="new-expense-type"><?= $expenseType ?></option>
				<?php
					}
				?>

			</select>
		</div>

		<div class="form-single-line">
			<div>Endroit de l'achat</div>
			<input type="text" name="new-expense-place">
		</div>

		<div class="form-single-line">
			<div>Coût</div>
			<input type="text"name="new-expense-price">
		</div>

		<div class="form-single-line">
			<div>Acheteur</div>
			<select name="new-expense-owner" id="expense-owner-select">

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

		<div class="form-single-line">
			<div>Date de l'achat</div>
			<input type="date" name="new-expense-date-purchase" id="new-expense-date-purchase">
		</div>	

		<div class="form-single-line">
			<button type="submit" onclick="addNewExpense()">Ajouter</button>
		</div>	
	</div>


	<div class="expenses-summary">

		<h2 class="sub-title">Résumé</h2>

		<div class="section-flex expenses-summary-array">
			<div class="summary-column" id="first-column">
				<div>\</div>
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

		<div class="form-single-line">
			<div>Trier par type d'achat</div>
			<select name="new-expense-type" id="expense-type-select-summary" onchange="changeTypeExpense()">
					<option value="tous-types" name="tous-types">Tous les types</option>
				<?php 
					foreach ($action->expenseTypes as $expenseType) {
				?>
					<option value="<?= $expenseType ?>" name="new-expense-type"><?= $expenseType ?></option>
				<?php
					}
				?>

			</select>
		</div>
	</div>

</div>

<?php
	require_once("partial/footer.php");
