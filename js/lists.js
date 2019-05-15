let addListBtn = null;
let newList = null;
let listTitleInputNode = null;
let listTitleNode = null;
let newListElementInputNode = null;
let btnSubmitList = null;

window.onload = () => {
    addListBtn = document.querySelector(".add-list-button");
	newList = document.querySelector(".new-list");
	listTitleInputNode =  document.getElementById("new-list-name");
	newListElementInputNode = document.getElementById("new-list-element-input");
	listTitleNode = document.querySelector(".list-title");
	btnSubmitList = document.querySelector(".btn-submit-list");
	btnSubmitList.addEventListener("click", submitNewList);
}

const addList = () => {
    newList.style.display = "block";
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
	document.querySelector(".btn-submit-list").style.display = "block";
	console.log("icic");
	
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
	document.querySelector(".list").style.display = "block";
}

const manageInput = () =>{
	if(isKeyPressedEnter(event.keyCode) && listTitleNode.value != ""){
		checkListTitleUnicity();
	}
}

const addElementList = () => {
	
	if(isKeyPressedEnter(event.keyCode) && newListElementInputNode.value != ""){		
		createNewListElementNode(newListElementInputNode.value);
		newListElementInputNode.value = " ";
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
	
} 