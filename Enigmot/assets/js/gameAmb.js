var curr_selectId;
var idMot;
var errors = false;
$(document).ready(function(){

$(".list").addClass("scrollGloses");

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
	$('#btnAddGlose').click(function(){
        document.getElementById("msgErrorPopup").setAttribute("hidden", "hidden");
        
        var glose = $('#glose_input').val();
        if (glose.trim() === "") {
            document.getElementById("msgErrorPopup").removeAttribute("hidden");
            document.getElementById("msgErrorPopup").innerHTML = "Vous n'avez saisi aucune glose.";
            return;
        }

        if (glose.length > 25) {
            document.getElementById("msgErrorPopup").removeAttribute("hidden");
            document.getElementById("msgErrorPopup").innerHTML = "La taille de cette glose est trop grande.<br> Veuillez n'écrire que des gloses composé d'au plus 25 caractères.";
            return;
        }   
        
        var dataSet = {"glose" : glose, "id_Ambigu" : idMot};
        console.log(dataSet);
        $.ajax({
            type: "POST",
            url: "Jouer/ajouterGlose",
            data: dataSet,
            success: function(data){
            	var reponse = JSON.parse(data);
                if(reponse['message'] === ''){
                    ajoutGlose(glose.toLowerCase(),reponse['id_Glose']);
                    document.getElementsByTagName('credit')[0].innerHTML=reponse['credit'];
                swal(
                    'Glose Ajouté !',
                    'Vous pouvez la selectionner dans la liste déroulante.',
                    'success'
                )             
                }else{
                    
                    document.getElementById("msgErrorPopup").removeAttribute("hidden");
                    document.getElementById("msgErrorPopup").innerHTML = reponse['message'];
                }
		        
                                  
            }  
        });
    });

    
    $("amb").attr("onMouseOver","showShadow(this)");
    $("amb").attr("onMouseOut", "hideShadow(this)");

    $("ref").attr("onMouseOver","showShadow(this)");
    $("ref").attr("onMouseOut", "hideShadow(this)");


    //gestion du button j'aime
    // var clique=false;
    // $('#phraseLike').click(function(){
    //     if(clique){
    //         $(this).attr('class:','btn-sm btn-light btn-like');
    //         clique=false;
    //     }else{
    //         $(this).attr('class:','btn btn-xs btn-primary');
    //         clique=true;
    //     }
    // }
});

function addGlose(Select,MotId){
	$('#FormReset')[0].reset();
	$('#addGlose').modal('show');
	curr_selectId = Select.id;
	idMot = MotId;
}

function ajoutGlose(value,idGlose){
    //ajoute la glose dans select
    var compteur = $('#nbr'+curr_selectId).val();
    compteur++;
    $('#nbr'+curr_selectId).val(compteur);
    let optionChoisir = "<option selected='' disabled='' value=''> Choisissez une glose ("+compteur+" existantes)</option>";
    let optionV="<option value='"+idGlose+":'>"+value+"</option>";
    $('#'+curr_selectId+' option:first-child').replaceWith(optionChoisir+optionV);
    // $('#'+curr_selectId).append(optionV);
    $('#'+curr_selectId).niceSelect('update');
    $(".list").addClass("scrollGloses");
    hide_form();
}


function hide_form(){
    curr_select='';
    idMot='';
    $('#addGlose').modal('hide');
}

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