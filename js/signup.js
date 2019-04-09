window.onload = () => {
	
	document.querySelector("#username").onblur = () => {
		checkUsernameUnicity();
	}

	document.querySelector("#email").onblur = () => {
		checkEmailUnicity();
	}

	document.querySelector("#password").onblur = () => {
		checkMatchingPasswords();
	}

	document.querySelector("#password-confirm").onblur = () => {
		checkMatchingPasswords();
	}
}


const checkUsernameUnicity = () => {
	
	$.ajax({
		url : "checkUsernameUnicity.php",
		type: "POST",
		data: {
			username : document.querySelector("#username").value
		}
	})
	.done(check => {
		validity = JSON.parse(check);
		checkValidity(validity, document.querySelector("#username"));
	})
}

const checkEmailUnicity = () => {

	$.ajax({
		url : "checkEmailUnicity.php",
		type: "POST",
		data: {
			email : document.querySelector("#email").value
		}
	})
	.done(check => {

		validity = JSON.parse(check);
		checkValidity(validity, document.querySelector("#email"));
	})
}

const checkMatchingPasswords = () => {

	$.ajax({
		url : "checkMatchingPasswords.php",
		type: "POST",
		data: {
			password1 : document.querySelector("#password").value,
			password2 : document.querySelector("#password-confirm").value
		}
	})
	.done(check => {
		validity = JSON.parse(check);
		checkValidity(validity, document.querySelector("#password"));
	})

}

const checkValidity = (validity, node) => {

	if(validity != "valide"){
		wrongInputField(validity, node);
	}
	else{
		rightInputField(node);
	}
} 

const wrongInputField = (message, node) => {
	document.getElementById("validation-info").innerHTML = message;
	node.style.backgroundColor = "#ffe5e5";
}

const rightInputField = (node) => {
	document.getElementById("validation-info").innerHTML = "";
	node.style.backgroundColor = "#fff";
}