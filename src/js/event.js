var isCheckData = true;

function checkprogress(){
    alert("You are about to change event progress");
    isCheckData = true;
}

function checkedprogress(){
    return isCheckData;
}

function checkpayment(){
    alert("You are about to change payment statement");
    isCheckData = true;
}

function checkedpayment(){
    return isCheckData;
}