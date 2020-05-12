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
                messageError.innerHTML = messageError.innerHTML + 'vous avez pas remplis tous les choix <br>';
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
            	console.log(data);
		        ajoutGlose(glose.toLowerCase(),data);
		        swal(
		            'Glose Ajouté!',
		            'Vous pouvez la selectionner dans la liste deroulante.',
		            'success'
		        )                                    
            }  
        });
    });
    $("amb").attr("onMouseOver","showShadow(this)");
    $("amb").attr("onMouseOut", "hideShadow(this)");	
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
    let optionV="<option value='"+idGlose+"'>"+value+"</option>";
    $('#'+curr_selectId+' option:first-child').replaceWith(optionChoisir+optionV);
    // $('#'+curr_selectId).append(optionV);
    $('#'+curr_selectId).niceSelect('update');

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
