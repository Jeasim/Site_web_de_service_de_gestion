window.onload = () =>{
	document.getElementById("new-expense-date-purchase").valueAsDate = new Date();
}


const addNewExpense = () =>{
    // checks
    insertNewExpenses();
}

const manageExpenseOptions = (expenseID) =>{
    deleteExpense(expenseID);
}

const changeTypeExpense = () =>{
	let selectedType = document.getElementById("expense-type-select-summary").value;
	getExpensesOfType(selectedType);
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
			owner : document.querySelector("select[name = 'new-expense-owner']").value,
			type : document.querySelector("select[name = 'new-expense-type']").value,
			date : document.querySelector("input[name = 'new-expense-date-purchase']").value
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
        location.reload();
	})
}

const getExpensesOfType = (selectedType) =>{
	
	$.ajax({
		url : "fetchSelectedTypeExpenses.php",
		type: "POST",
		data: {
			type : selectedType
		}
	})
	.done(response => {
		message = JSON.parse(response);
		console.log(message);
	})
}