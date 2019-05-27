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

const modifyExpense = () =>{

	document.querySelector("#form-new-expense h2").innerHTML = "Modifier une dépense";
	document.querySelector("#form-new-expense div button").style.display = "none";
	let btnModify = document.createElement("button");
	btnModify.innerHTML = "Modifier";
	btnModify.setAttribute("class", "form-submit");
	btnModify.addEventListener("click", updateExpense);
	document.querySelector("#form-expense-btn-div").appendChild(btnModify);
	fetchExpense();	
}

const fillInInputs = (expense) =>{
	

	document.querySelector("input[name = new-expense-description]").value = expense['description'];
	document.querySelector("select[name = new-expense-type]").value = expense['id_type'];
	document.querySelector("input[name = new-expense-place]").value = expense['place'];
	document.querySelector("input[name = new-expense-price]").value = expense['price'];
	document.querySelector("select[name = new-expense-owner]").value = expense['id_owner'];
	document.querySelector("input[name = new-expense-date-purchase]").value = expense['date_of_purchase'];

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

const fetchExpense = () =>{
	
	$.ajax({
		url : "fetchExpense.php",
		type: "POST",
		data: {
			expenseID : selectedExpense
		}
	})
	.done(response => {
		expense = JSON.parse(response);
		fillInInputs(expense[0]);
	})
}	

const updateExpense = () =>{
	
	$.ajax({
		url : "updateExpense.php",
		type: "POST",
		data: {
			expenseID : selectedExpense,
			description : document.querySelector("input[name = 'new-expense-description']").value,
            place : document.querySelector("input[name = 'new-expense-place']").value,
            price : document.querySelector("input[name = 'new-expense-price']").value,
			owner : document.querySelector("select[name = 'new-expense-owner']").value,
			type : document.querySelector("select[name = 'new-expense-type']").value,
			date : document.querySelector("input[name = 'new-expense-date-purchase']").value
		}
	})
	.done(response => {
		expense = JSON.parse(response);
		location.reload();
	})
}	