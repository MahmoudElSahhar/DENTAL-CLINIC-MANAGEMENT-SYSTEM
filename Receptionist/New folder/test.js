

function handleRadioButton(radioID , visitDuration){
    var radio = document.getElementById(''+radioID);
    var date = radio.value.substring(0, 10);
    var start = new Date();
    start.setHours(radio.value.substring(11, 13));
    start.setMinutes(radio.value.substring(14, 16));
    start.setSeconds(00);
    
    var options = { hour12: false };
    console.log(date.toLocaleString('en-US', options));
    var slots = visitDuration/30;
    var bool = true;
    var ids = new Array(slots-1);

    for(var i = 0 ; i < (slots-1) ; i++){
        start.setMinutes(start.getMinutes() + 30);
        var time = start.toTimeString().substring(0, 8);
        var id = ''+date+'_'+time;
        if(document.getElementById(''+id) == null){
            bool = false;
        }
        else{
            ids[i] = id;
        }
    }

    if(bool){
        $(":checked").prop('checked', false);
        $("input:checkbox").prop('name', 'appointmentTime');
        radio.checked = true;
        radio.setAttribute('name', 'appointmentTimeTaken');
        for(var i = 0 ; i < (slots-1) ; i++){
            document.getElementById(''+ids[i]).checked = radio.checked;
        }
    }
    else{
        radio.checked = false;
        alert("Impossible");
    }
}