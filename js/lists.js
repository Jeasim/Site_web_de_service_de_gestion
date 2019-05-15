let addListBtn 				= null;
let viewListsBtn 			= null;
let newList 				= null;
let allLists				= null;
let list 					= null;
let listTitleInputNode 		= null;
let listTitleNode 			= null;
let newListElementInputNode = null;
let btnSubmitList 			= null;
let btnResetList 			= null;



window.onload = () => {
	initializePageElements();	
}

const addListMode = () => {
	resetNewList();
	newList.style.display = "block";
	allLists.style.display = "none";
	viewListsBtn.style.color = "#4056A1";
	viewListsBtn.style.backgroundColor = "#C5CBE3";
	addListBtn.style.color = "#C5CBE3";
	addListBtn.style.backgroundColor = "#4056A1";
}

const viewListsMode = () => {
	newList.style.display = "none";
	allLists.style.display = "display";
	addListBtn.style.color = "#4056A1";
	addListBtn.style.backgroundColor = "#C5CBE3";
	viewListsBtn.style.color = "#C5CBE3";
	viewListsBtn.style.backgroundColor = "#4056A1";

	fetchAllLists();
}

const resetNewList = () => {
	listTitleInputNode.style.display = "block";
	list.style.display = "none";
	btnResetList.style.display = "none";
	listTitleInputNode.innerHTML = " ";
	listTitleNode.innerHTML = " ";
	newListElementInputNode.innerHTML = " ";
	resetListElements();
}

const checkListTitleUnicity = () => {

	$.ajax({
		url : "checkListTitleUnicity.php",
		type: "POST",
		data: {
			listTitle : listTitleInputNode.value
		}
	})
	.done(check => {
		response = JSON.parse(check);

		if(isValid(response)){
			rightInputField();
			startNewList(listTitleInputNode)
		}
		else{
			wrongInputField(response);
		}

	})
}

const isValid = (response) => { return (response === "valid"); } 

const startNewList = () => {
	giveListTitle();
	switchInputs();
	btnSubmitList.style.display = "block";
	btnResetList.style.display = "block";
}

const createNewListNode = () =>{
	let listNode = document.createElement("ul");
	newList.appendChild(listNode);
}


const createNewListElementNode = (input) =>{
	let parentNode = document.querySelector(".new-list ul");
	let childNode = document.createElement("li");
	childNode.innerHTML = input;
	parentNode.insertBefore(childNode, parentNode.lastElementChild);
}

const giveListTitle = () => {
	listTitleNode.innerHTML = listTitleInputNode.value;
	listTitleInputNode.value = "";
}

const switchInputs = () => {
	listTitleInputNode.style.display = "none";
	list.style.display = "block";
}

const manageInput = () =>{
	if(isKeyPressedEnter(event.keyCode) && listTitleNode.value !== ""){
		checkListTitleUnicity();
	}
}

const addElementList = () => {
	
	if(isKeyPressedEnter(event.keyCode) && newListElementInputNode.value !== ""){		
		createNewListElementNode(newListElementInputNode.value);
		newListElementInputNode.value = "";
	}
}

const isKeyPressedEnter = (keyCode) =>{
	return (keyCode == "13");
}

const wrongInputField = (message) => {
	document.getElementById("validation-info").innerHTML = message;
	listTitleInputNode.style.backgroundColor = "#ffe5e5";
}

const rightInputField = () => {
	document.getElementById("validation-info").innerHTML = "";
	listTitleInputNode.style.backgroundColor = "#fff";
}

const submitNewList = () =>{
	
	let listTitle = listTitleNode.innerHTML; 
	let listElementsArray = getArrayOfListElements();

	$.ajax({
		url : "insertNewList.php",
		type: "POST",
		data: {
			title : listTitle,
			elements : listElementsArray
		}
	})
	.done(response => {
		message = JSON.parse(response);

		resetNewList();
	})
} 

const getArrayOfListElements = () =>{

	let listElementsArray = [];

	for (let index = 1; index < list.childElementCount; index++) {
		const listElement = list.querySelector("li:nth-of-type(" + index + ")");
		listElementsArray.push(listElement.innerHTML);

	}

	return listElementsArray;
}

const resetListElements = () => {
	for (let index = list.childElementCount - 1; index >= 1; index--) {
		const listElement = list.querySelector("li:nth-of-type(" + index + ")");
		list.removeChild(listElement);
	}
}


const initializePageElements = () => {
	addListBtn = document.querySelector(".add-list-btn");
	viewListsBtn = document.querySelector(".view-lists-btn");

	newList = document.querySelector(".new-list");
	list = document.querySelector(".list");
	allLists = document.querySelector(".all-lists");

	listTitleInputNode =  document.getElementById("new-list-name");
	newListElementInputNode = document.getElementById("new-list-element-input");

	listTitleNode = document.querySelector(".list-title");
	btnSubmitList = document.querySelector(".btn-submit-list");
	btnResetList = document.querySelector(".new-list p:first-child");
}


const fetchAllLists = () => {
	$.ajax({
		url : "fetchAllLists.php",
		type: "POST",
		data: {}
	})
	.done(result => {
		lists = JSON.parse(result);
		console.log(lists);
		console.log(result);
		
	})
}