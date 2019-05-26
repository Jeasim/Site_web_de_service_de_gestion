let selectedExpense = null;

window.onload = () =>{
	document.getElementById("new-expense-date-purchase").valueAsDate = new Date();
}


const addNewExpense = () =>{
    // checks
    insertNewExpenses();
}

const manageExpenseOptions = (expenseID, node) =>{	
	
	resetAllBorders();
	
	if(selectedExpense != expenseID){
		selectedExpense = expenseID;
		node.style.border = "1px solid #F13C20";
	}
	else{
		selectedExpense = null;
	}
	
}

const changeTypeExpense = () =>{
	let selectedType = document.getElementById("expense-type-select-summary").value;
	getExpensesOfType(selectedType);
}

const resetAllBorders = () =>{
	let nodeListExepenses = document.querySelector("#expenses-ul");
	
	for (let index = nodeListExepenses.childElementCount; index >= 1; index--) {		
		const listElement = nodeListExepenses.querySelector("li:nth-of-type(" + index + ")");
		listElement.style.border = "none";
	}
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

const deleteExpense = () =>{
    
	$.ajax({
		url : "deleteExpense.php",
		type: "POST",
		data: {
			expenseID : selectedExpense
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
	})
}