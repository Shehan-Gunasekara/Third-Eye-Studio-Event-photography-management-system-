var isCheckData = true;

function checkData(){
	if(document.getElementById("accountrole").value == "" ||
        document.getElementById("fname").value == "" || 
        document.getElementById("lname").value == "" || 
        document.getElementById("address").value == "" || 
        document.getElementById("mnum").value == "" || 
        document.getElementById("dob").value == "" ||
        document.getElementById("email").value == "" ||
        document.getElementById("username").value == ""||
        document.getElementById("password").value == ""){
		alert("Found missing fields");
		isCheckData = false;
	}else{
		alert("You are about to add new employee");
	}
}

function checkedData(){
    return isCheckData;
}