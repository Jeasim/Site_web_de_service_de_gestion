
const manageExpenseOptions = (expenseID) =>{
    deleteExpense(expenseID);
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