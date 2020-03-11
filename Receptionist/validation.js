

function blurFunction(fieldType) {
    //console.log(fieldType);
    //var fields = ["fullname", "dob", "telephone", "username", "password", "email"];

    var txt = document.getElementById(fieldType).value;
    if(txt.length == 0){
        document.getElementById(fieldType+"Div").style.display = "block";
        document.getElementById(fieldType+"Div").innerHTML  = "please fill required fields";
    }
    else if(fieldType == 'telephone' && (txt.length < 11 || txt.length > 11))
    {
        document.getElementById(fieldType+"Div").style.display = "block";
        document.getElementById(fieldType+"Div").innerHTML  = "Invalid telephone number";
    }
    else if(fieldType == 'username')
    {
        var filter = /^[A-z]+$/;

        if (!filter.test(txt)) {
            document.getElementById(fieldType+"Div").style.display = "block";
            document.getElementById(fieldType+"Div").innerHTML  = "username must contain characters only";
        }
        else
        document.getElementById(fieldType+"Div").style.display = "none";
    }
    else if(fieldType == 'password'  && txt.length < 8)
    {
        document.getElementById(fieldType+"Div").style.display = "block";
        document.getElementById(fieldType+"Div").innerHTML  = "password must be at least 8 characters";
    }
    else if(fieldType == 'email')
    {
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (!filter.test(txt)) {
            document.getElementById(fieldType+"Div").style.display = "block";
            document.getElementById(fieldType+"Div").innerHTML  = "Invalid email address";
        }
        else
        document.getElementById(fieldType+"Div").style.display = "none";   
    }
    else
        document.getElementById(fieldType+"Div").style.display = "none";

    
}