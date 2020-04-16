        var i=1;
    var curr_selectId='';
    var curr_mot='';
    var mots_ajoute=[];
    $(document).ready(function(){
        //ajouter glose dans la base de donnée
        $('#btnAddGlose').click(function(){
            var glose = $('#glose_input').val();
            ajouter_glose(glose);

            /*var Mot = $('#'+curr_mot).val();
            
            var dataSet = {"glose" : glose, "motAmbigu" : Mot}
            $.ajax({
                type: "POST",
                url: "Create_Phrase/ajouterGlose",
                data: dataSet,
                success: function(data){
                    // raffraichirGlose();
                    swal(
                        'Good job!',
                        'Data has been save!',
                        'success'
                    )                    
                }  
            });*/
        });

        //ajouter le field MotAmbigu et récupérer les gloses associé
        $('#Mot_butt').click(function(){
            var mot = add_mot();
            /*$.ajax({
                type: "GET",
                url: "Create_Phrase/recuperer_Gloses/"+mot,
                success: function(data){
                    afficherGlose(data);
                }  
            });*/
        });
    });

    /*function raffraichirGlose(){
        for(var j=0;j<i;j++){
            var mot = $('#mot_ambigu'+j).val();
            var gloseID = '#gloses'+j;
            $.ajax({
                type: "GET",
                url: "Create_Phrase/recuperer_Gloses/"+mot,
                success: function(data){
                    console.log(data);
                    afficherGlose(data,gloseID);
                }  
            });
        }
    }*/

    /*function afficherGlose(data,glose=''){
        arr = JSON.parse(data);
        console.log(arr);
        $.each( arr, function( index, val ){
            var option="<option>"+val['Glose']+"</option>";
            if(glose == ''){
                $('#'+curr_selectId).append(option);
            }else{
                $('#'+curr_selectId).each(function(){
                    if (this.value == val['Glose'] ) {
                        console.log(value);
                        $(glose).append(option);
                    }
                });
            }
        });
    }*/

    function ajouter_glose(value){
        //ajoute la glose dans select
        let option="<option selected>"+value+"</option>";
        $('#'+curr_selectId).append(option);
        $('#'+curr_selectId).multiselect('destroy');
        $('#'+curr_selectId).multiselect();
        newChangeSelectName(curr_selectId);

        hide_form();
    }

    function add_mot(){
        let selection = '';
        $('#phrase').focus();
        selection = window.getSelection();
        selectionTest = selection.toString().replace( /\s/g, '');
        // && jQuery.inArray( selection , mots_ajoute)==-1
        if(selectionTest != ''){
            mots_ajoute.push(selection);
            let divId='mot'+i;
            let selectId = 'gloses'+i;
            let buttonId = 'ajouter_glose'+i;
            let MotId = 'mot_ambigu'+i;
            let sup_mot_id='supprimer_mot'+i;
            let form =  "<div id='"+divId+"' class='row row-eq-height'>"
                        +"<div class='col-xs-12 col-sm-3 col-md-3'>"
                        +"<label class='control-label required'>Mot ambigu</label>"
                        +"<input type='text' class='form-control widthInput' name='mot_ambiguD[]' id='"+MotId+"' autocomplete='off' value='"+selection+"'>"
                        +"</div>"
                        +"<div class='col-xs-12 col-sm-4 col-md-4 selectMultiple selectMultipleRight'>"
                        +"<label class='control-label'>Glose associée</label>"
                        +"<div>"
                        +"<select class='gloses form-control widthSelect' multiple name='selection_box' id='"+selectId+"' required='required'></select>"
                        +"</div>"
                        +"</div>"
                        +"<div class='col-xs-12 col-sm-5 col-md-5 actionMargin'>"
                        +"<div class='form-group'>"
                        +"<label class='control-label'>Actions</label>"
                        +"<div class='divActionBtn'>"
                        +"<button id='"+buttonId+"' type='button' class='btn btn-primary btnAjouterMargin'>Ajouter une glose</button>"
                        +"<button id='"+sup_mot_id+"' type='button' class='btn btn-danger actionBtnMargin'>Supprimer le mot ambigu</button>"
                        +"</div>"
                        +"</div>"
                        +"</div>"
                        +"<script id=\"script-\""+selectId+">$(function() {$('#"+selectId+"').multiselect({includeSelectAllOption: true}); changeSelectName();});</script>"
                        +"</div>";
            curr_selectId=selectId;
            $('#Mots_space').append(form);
            let scriptElement = document.getElementById("select-script");
            $('#'+divId).append("<input name='ordre[]' type='hidden' value='"+i+"'>");
            $('#'+sup_mot_id).click({id:divId, select:selection }, supp_mot);
            $('#'+buttonId).click({selectId:selectId, MotId:MotId}, show_form);
            $('#phrase').selection('replace', {text: "<amb id = \'"+i+"\'>"+ selection + "</amb>"});
            i++;
            return selection;
        }
    }

    function supp_mot(param){
        mots_ajoute = $.grep(mots_ajoute, function(value) {
                return value != param.data.select;
            });
        let id="#"+param.data.id;
        $(id).remove();

    }

    function show_form(param){
        curr_selectId=param.data.selectId;
        curr_mot=param.data.MotId;
        $('#glose_form')[0].reset(); // reset form on modals
        $('#addGlose').modal('show'); // show bootstrap modal
    }

    function hide_form(){
        curr_selectId='';
        curr_mot='';
        $('#addGlose').modal('hide');
    }

    window.onload = function() {
        var url = document.location.href.split("?creation=");
    
        if (url[1] == "%22true%22") {
            var messageSuccess = document.getElementById("messageSuccess");
            messageSuccess.removeAttribute("hidden");        
            messageSuccess.innerHTML="La phrase a bien été crée.";
        }
    }

    function sendData() {
        let data = getSentence();

        if (data !== false) {
            let dataSet = {"data": data};

            $.ajax({
                type: "POST",
                url: "Create_Phrase/saveData",
                data: dataSet,
                success: function(data){
                    var reponse = JSON.parse(data);
                    
                    if (reponse["reponse"] === true) {
                        document.location.href="create?creation=\"true\"";
                    }
                }  
            });
        }
    }

    function getSentence() {
        let messageError = document.getElementById("messageError");
        messageError.setAttribute("hidden", "");
        messageError.innerHTML = "";
        var reponse = "";

        if (document.getElementById("phrase").value.trim() === "") {
            messageError.removeAttribute("hidden");
            messageError.innerHTML = "Erreur lors de l'insertion de la phrase -> La phrase ne doit pas être vide";
            return false;
        }

        if (i > 1) {
            reponse = "{\"phrase\": \"" +document.getElementById("phrase").value+ "\",\"motsAmbigus\": [";

            for (let k = 1; k < i; k++) {
                
                if (k !== 1 && k !== i) {
                    reponse = reponse.concat(",");
                }

                let result = getWordsAndGlosses(k);
                if (result === false) {
                    messageError.removeAttribute("hidden");
                    messageError.innerHTML = "Vous n'avez selectionné aucune glose pour le mot ambigu \"" +document.getElementById("mot_ambigu"+k).value+ "\"";
                    return false;
                } else {
                    messageError.setAttribute("hidden", "");
                    messageError.innerHTML = ""
                    reponse = reponse.concat(result);
                }             

                if (k === i-1) {
                    reponse = reponse.concat("]}");
                }
            }

            return reponse;
        } else {
            messageError.removeAttribute("hidden");
            messageError.innerHTML = "Erreur lors de l'insertion de la phrase -> Il faut au moins 1 mot ambigu";
            return false;
        }
    }
    

    function getWordsAndGlosses(param){
        var reponse = "";

        if (param < i && param > 0) {
            reponse = "{\"motAmbigu\": \"" +document.getElementById("mot_ambigu"+param).value+ "\",\"position\": " +param+ ",\"gloses\": [";
            var elementSelect = document.getElementById("gloses"+param);
            
            if(elementSelect !== null) {
                var optionSelected = elementSelect[elementSelect.selectedIndex].text;
    
                for (let k = 1; k < elementSelect.options.length; k++) {
    
                    if (k !== 1 && k !== elementSelect.options.length) {
                        reponse = reponse.concat(",");
                    }
    
                    if (elementSelect.options[k].text === optionSelected) {
                        reponse = reponse.concat("{\"selected\": true, \"valeur\": \"" +elementSelect.options[k].text+ "\"}")
                    } else {
                        reponse = reponse.concat("{\"selected\": false, \"valeur\": \"" +elementSelect.options[k].text+ "\"}")
                    }
    
                    if (k === elementSelect.options.length - 1) {
                        reponse = reponse.concat("]}");
                    }
                }
            }
        }

        if (reponse.includes("true")) {
            return reponse;
        } else {
            return false;
        }
    }

    function changeSelectName() {        
        let val = $("#gloses"+(i-1)).val();

        if (val !== undefined && val.toString() !== "") {
            arrayVal = val.toString().split(",");
            document.getElementsByClassName("multiselect-selected-text")[0].innerHTML = "Selecionner les gloses (" +arrayVal.length+ ")";
        } else {
            document.getElementsByClassName("multiselect-selected-text")[0].innerHTML = "Selecionner les gloses (0)";
        }

        document.getElementsByClassName("multiselect-selected-text")[0].setAttribute("class", "count");
    }

    function newChangeSelectName(param) {
        let val = $("#"+param).val();

        if (val !== undefined && val.toString() !== "") {
            arrayVal = val.toString().split(",");
            arrayParam = param.split("gloses");
            if (document.getElementsByClassName("multiselect-selected-text")[0] !== undefined) {
                document.getElementsByClassName("multiselect-selected-text")[0].innerHTML = "Selecionner les gloses (" +arrayVal.length+ ")";
                document.getElementsByClassName("multiselect-selected-text")[0].setAttribute("class", "count");
            }
        }
    } // change ta maniere de pensée, c'est le 2 qui as fait la demande et lui, il te recupere le 1 (comme tu le voulais), mais c'est plutot le 0 qu'il faut modifier, le seule element existant
