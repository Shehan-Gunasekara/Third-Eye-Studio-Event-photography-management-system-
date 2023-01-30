var isCheckData = true;

function checkData(){
	if(document.getElementById("fname").value == "" || 
    document.getElementById("lname").value == "" || 
    document.getElementById("address").value == "" || 
    document.getElementById("mnum").value == "" || 
    document.getElementById("dob").value == "" ||
    document.getElementById("eventdate").value == ""){
		alert("Found missing fields");
		isCheckData = false;
	}else{
		alert("You are about to place new booking");
	}
}

function checkedData(){
    return isCheckData;
}