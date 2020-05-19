$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "/TERSmartDevloppers/Enigmot/index.php/Editer_Information/editCreditsAndPoints",
        success: function(data){
            if (document.getElementsByTagName('credit')[0] !== null && document.getElementsByTagName('credit')[0] !== undefined) {
                var reponse = JSON.parse(data);
                document.getElementsByTagName('credit')[0].innerHTML = reponse['credit'];
                document.getElementsByTagName('point')[0].innerHTML = reponse['point'];
            }
        }  
    });
})
