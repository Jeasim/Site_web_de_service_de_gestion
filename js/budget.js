
const addNewExpense = () =>{
    // checks
    insertNewExpenses();
}

const manageExpenseOptions = (expenseID) =>{
    deleteExpense(expenseID);
}

// Requetes AJAX

const insertNewExpenses = () =>{
 
	$.ajax({
		url : "insertExpense.php",
		type: "POST",
		data: {
            description : document.querySelector("input[name = 'new-expense-description']").value,
            place : document.querySelector("input[name = 'new-expense-place']").value,
            price : document.querySelector("input[name = 'new-expense-price']").value,
            price : document.querySelector("input[name = 'new-expense-price']").value,
            owner : document.querySelector("select[name = 'new-expense-owner']").value
		}
	})
	.done(response => {
        message = JSON.parse(response);
        location.reload();
        
	})
}

const deleteExpense = (expenseIDParam) =>{
    
	$.ajax({
		url : "deleteExpense.php",
		type: "POST",
		data: {
			expenseID : expenseIDParam
		}
	})
	.done(response => {
		message = JSON.parse(response);

	})
}