function checkPassword(){
	if(document.getElementById("pwd").value != document.getElementById("cnfrmpwd").value){
		alert("Password Mismatch!");
		return false;
	}else{
		alert("Password matched!");
	}
}

function enableButton(){
	if(document.getElementById("checkPolicy").checked){
		document.getElementById("submitBtn").disabled = false;
	}else{
		document.getElementById("submitBtn").disabled = true;
	}
}