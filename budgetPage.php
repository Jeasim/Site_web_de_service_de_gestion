<?php
	require_once("action/BudgetPageAction.php");
	$action = new BudgetPageAction();
	$action->execute();

	require_once("partial/header.php");
?>

<script src="js/budget.js"></script>

	<div class="expenses-list">

		<ul>
			
			<?php 
				foreach ($action->expenses as $expense) {
			?>		
				<li class="expenses-single-line" onclick="manageExpenseOptions(<?= $expense['id'] ?>)">
					<div class="expenses-description"> <?= $expense['description'] ?> </div>
					<div class="expenses-price"> <?= $expense['price'] ?> </div>
					<div class="expenses-place"> <?= $expense['place'] ?> </div>
					<div class="expenses-owner"> <?= $expense['firstname'] ?> </div>
				</li>

			<?php
				}
			?>

		
		</ul>

	</div>

	<div class="expenses-summary">
		<div class="expenses-sum-user">
			<div><?= $_SESSION["user_firstname"] ?></div>
			<div id="user-sum"> <?= $action->userExpensesSum ?> </div>
		</div>
		<?php 
			if($_SESSION["partner_id"] != 0){
		?>
			<div class="expenses-sum-partner">
			<div><?= $_SESSION["user_firstname"] ?></div>
			<div id="partner-sum"></div>
			</div>
		<?php
			}
		?>
	</div>


	<div class="section-form-new-expense">
		
		<div class="form-single-line">
			<div>Decription</div>
			<input type="text" name="new-expense-description">
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
			<select name="new-expense-owner" id="">
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
		<button type="submit" onclick="addNewExpense()">Ajouter</button>
		</div>
		
				
	</div>

<?php
	require_once("partial/footer.php");
