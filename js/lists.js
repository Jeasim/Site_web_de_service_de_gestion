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
	viewListsMode();
}

const addListMode = () => {
	switchModes(addListBtn, viewListsBtn, newList, allLists, "block");
	resetNewList();
}

const viewListsMode = () => {
	switchModes(viewListsBtn, addListBtn, allLists, newList, "flex");
	resetNewList();
	fetchAllListsTitles();
}



const resetNewList = () => {
	listTitleInputNode.style.display = "block";
	nodeList.style.display = "none";
	btnResetList.style.display = "none";
	btnSubmitList.style.display = "none";
	newListElementInputNode.display = "none";
	listTitleInputNode.innerHTML = " ";
	listTitleNode.innerHTML = " ";
	newListElementInputNode.innerHTML = " ";

	resetListElements();
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
	nodeList.style.display = "block";
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



const getArrayOfListElements = () =>{

	let listElementsArray = [];

	for (let index = 1; index < nodeList.childElementCount; index++) {
		const listElement = nodeList.querySelector("li:nth-of-type(" + index + ")");
		listElementsArray.push(listElement.innerHTML);

	}

	return listElementsArray;
}

const resetListElements = () => {
	for (let index = nodeList.childElementCount - 1; index >= 1; index--) {
		const listElement = nodeList.querySelector("li:nth-of-type(" + index + ")");
		nodeList.removeChild(listElement);
	}
}




const showList = (title, listElements) =>{

	let nodeTitle = document.querySelector(".viewer-list-title");
	nodeTitle.innerHTML = title;

	let nodeListElements = document.querySelector(".viewer-list-element");
	emptyNode(nodeListElements);

	listElements.forEach(element => {
		let nodeElement = document.createElement("li");
		nodeElement.innerHTML = element;
		nodeListElements.appendChild(nodeElement);
	});
	
}

const showListsTitle = (listTitles) =>{

	emptyNode(allListsTitles);

	listTitles.forEach(listTitle => {
		let titleNode = document.createElement("li");
		titleNode.innerHTML = listTitle;
		titleNode.setAttribute("class", "single-list-title");
		titleNode.addEventListener("click", ()=>selectList(listTitle));

		allListsTitles.appendChild(titleNode);
	});
}

const selectList = (listTitle) =>{
	fetchList(listTitle);
}

const emptyNode = (nodeToEmpty) =>{
	while(nodeToEmpty.firstChild){
		nodeToEmpty.removeChild(nodeToEmpty.firstChild);
	}
}  

const appendListElements = (list, nodeParent) =>{
	let charHTML = document.getElementById("list-template").innerHTML;

	nodeList.forEach(element => {
		let node = document.createElement("li");
		node.innerHTML = charHTML;

		nodeParent.querySelector(".list-element").innerHTML = element;

		nodeParent.appendChild(node);
	});
}


// Requetes AJAX

const fetchList = (listTitleParam) =>{	

	$.ajax({
		url : "fetchList.php",
		type: "POST",
		data: {
			listTitle : listTitleParam
		}
	})
	.done(result => {
		list = JSON.parse(result);
		showList(listTitleParam, list);				
	})

}

const fetchAllListsTitles = () => {
	$.ajax({
		url : "fetchAllListsTitles.php",
		type: "POST",
		data: {}
	})
	.done(result => {
		listsTitles = JSON.parse(result);		
		showListsTitle(listsTitles);	
	})
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

// Fonctions utilitaires propres a la page
const initializePageElements = () => {
	addListBtn = document.querySelector(".add-list-btn");
	viewListsBtn = document.querySelector(".view-lists-btn");

	newList = document.querySelector(".new-list");
	nodeList = document.querySelector(".list-ul");
	allLists = document.querySelector(".all-lists");
	allListsTitles = document.querySelector(".all-lists-title");

	listTitleInputNode =  document.getElementById("new-list-name");
	newListElementInputNode = document.getElementById("new-list-element-input");

	listTitleNode = document.querySelector(".list-title");
	btnSubmitList = document.querySelector(".btn-submit-list");
	btnResetList = document.querySelector(".new-list p:first-child");
}

const switchModes = (selectedBtn, nonSelectedBtn, viewSection, hideSection, displayType) =>{
	viewSection.style.display = displayType;
	hideSection.style.display = "none";
	selectedBtn.setAttribute("class", "btn-selected");
	nonSelectedBtn.setAttribute("class", "btn-not-selected");
}