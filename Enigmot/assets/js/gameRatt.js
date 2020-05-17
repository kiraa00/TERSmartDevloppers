var curr_selectId;
var idMot;
var errors = false;
$(document).ready(function(){
    $('form#jouerForm').on('submit', function(form){
        form.preventDefault();
        var empty = false;

        $('.gloseValid').each(function(index) {
            if(index%2==0){
                if(this.value==''){
                    empty = true;
                }
            }
        });
        if(empty){
            if(!errors){
                messageError.removeAttribute("hidden");
                messageError.innerHTML = messageError.innerHTML + 'Veuillez choisir une glose pour chacun des mots ambigus.<br>';
                errors=true;
            }
        }else{
            document.getElementById("jouerForm").submit();
        }
    });


    $('.list li').each( function(){
        var valeur = $(this).data("value").split(":");
        if(valeur[0]!=''){
            $(this).attr("id","d"+valeur[1]);        
            $(this).attr("onMouseOver","showShadow(this)");
            $(this).attr("onMouseOut", "hideShadow(this)");        
        }
    } );

    
    $("amb").attr("onMouseOver","showShadow(this)");
    $("amb").attr("onMouseOut", "hideShadow(this)");

    $("ref").attr("onMouseOver","showShadow(this)");
    $("ref").attr("onMouseOut", "hideShadow(this)");

    $(".list").addClass("scrollGloses");   	
});




function showShadow(element){
    var idDiv,idAmb;
    if(element.id[0]=='d'){
        idDiv = element.id;
        idAmb= idDiv.substring(1,idDiv.length);
    }else{
        idDiv = 'd'+element.id;
        idAmb = element.id;
    }
    $('#'+idDiv).addClass('ambColor');
    $('#'+idAmb).addClass('ambColor');

}

function hideShadow(element){
    var idDiv,idAmb;
    if(element.id[0]=='d'){
        idDiv = element.id;
        idAmb= idDiv.substring(1,idDiv.length);
    }else{
        idDiv = 'd'+element.id;
        idAmb = element.id;
    }
    $('#'+idDiv).removeClass('ambColor');
    $('#'+idAmb).removeClass('ambColor');
}
