
function handleOption(selectID){
    var selectedItem = document.getElementById("fromSelect"+selectID);
    for(var i = 8 ; i <= 18 ; i++){
        $("#toSelect"+selectID+" option:eq("+(i-8)+")").attr("disabled", false);
    }
    for(var j = 8 ; j <= parseInt(selectedItem.value) ; j++){
        $("#toSelect"+selectID+" option:eq("+(j-8)+")").attr("disabled", "disabled");
    }
    $("#toSelect"+selectID+" option:eq("+(j-8)+")").attr("selected", "selected");
}

function handleCheckBox(checkId){
    var checkbox = document.getElementById("checkbox"+checkId);
    if(checkbox.checked == true){
        document.getElementById("fromSelect"+checkId).hidden = false;
        document.getElementById("toSelect"+checkId).hidden = false;
    }
    else{
        document.getElementById("fromSelect"+checkId).hidden = true;
        document.getElementById("toSelect"+checkId).hidden = true;
    }
}