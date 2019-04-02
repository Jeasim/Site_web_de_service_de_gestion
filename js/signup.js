window.onload = () => {
	
	document.querySelector("#username").onblur = () => {
		checkUsernameUnicityAjax();
	}

	document.querySelector("#password-confirm").onblur = () => {
		checkMatchingPasswordsAjax();
	}

	document.querySelector("#password").onblur = () => {
		checkMatchingPasswordsAjax();
	}

}


const checkUsernameUnicityAjax = () => {
	
	$.ajax({
		url : "checkUsernameUnicity.php",
		type: "POST",
		data: {
			username : document.querySelector("#username").value
		}
	})
	.done(check => {
		validity = JSON.parse(check);
		document.querySelector("#username-check").innerHTML = validity;
	})
}

const checkMatchingPasswordsAjax = () => {

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
		document.querySelector("#passwords-check").innerHTML = validity;
	})

}