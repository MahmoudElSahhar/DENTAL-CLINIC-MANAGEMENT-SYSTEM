
function updateTo(id , start , end){
    var from = document.getElementById(id);
    var to = parseInt(from.value)-8+1;

    for(var i = start ; i <= end ; i++){
        //alert("index = "+(i-8));
        $("#toSelect option:eq("+(i-8)+")").attr("disabled", false);
    }
    $("#toSelect option:eq("+to+")").attr("selected", "selected");
    for(var j = start ; j <= parseInt(from.value) ; j++){
        //alert("index = "+(j-8));
        $("#toSelect option:eq("+(j-8)+")").attr("disabled", "disabled");
    }
}