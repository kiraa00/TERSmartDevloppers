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

    p = 0;

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
        $('#phrase').focus();
        
        let selection = window.getSelection();
        let selectionText = selection.toString();
        let phraseEditor = $("#phrase");

        let regAlpha = /[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]/;

        let parentBase = selection.anchorNode.parentNode;
        let parentFocus = selection.focusNode.parentNode;

        let numPrevChar = Math.min(selection.focusOffset, selection.anchorOffset) - 1;
        let numFirstChar = Math.min(selection.focusOffset, selection.anchorOffset);
        let numLastChar = Math.max(selection.focusOffset, selection.anchorOffset) - 1;
        let numNextChar = Math.max(selection.focusOffset, selection.anchorOffset);
        let prevChar = selection.focusNode.textContent.charAt(numPrevChar);
        let firstChar = selection.focusNode.textContent.charAt(numFirstChar);
        let lastChar = selection.focusNode.textContent.charAt(numLastChar);
        let nextChar = selection.focusNode.textContent.charAt(numNextChar);

        let error = false;
        let messageError = document.getElementById("messageError");
        messageError.setAttribute("hidden", "");
        messageError.innerHTML = "";

        if (selectionText.trim() === '') {
            messageError.removeAttribute("hidden");
            messageError.innerHTML = messageError.innerHTML + "Veuillez d'abord sélctionner un mot à rendre ambigu dans votre phrase<br>";
            return;
        }

        if (phraseEditor.html() != parentBase.innerHTML || phraseEditor.html() != parentFocus.innerHTML) {
            messageError.removeAttribute("hidden");
            messageError.innerHTML = messageError.innerHTML + 'Le mot sélectionné est déjà ambigu<br>';
            error = true;
        }

        if (selection.anchorNode != selection.focusNode) {
            messageError.removeAttribute("hidden");
            messageError.innerHTML = messageError.innerHTML + 'Le mot sélectionné contient déjà un mot ambigu<br>';
            error = true;
        }

        if (prevChar.match(regAlpha)) {
            messageError.removeAttribute("hidden");
            messageError.innerHTML = messageError.innerHTML + 'Le premier caractère sélectionné ne doit pas être précédé d\'un caractère alphabétique<br>';
            error = true;
        }

        if (!firstChar.match(regAlpha)) {
            messageError.removeAttribute("hidden");
            messageError.innerHTML = messageError.innerHTML + 'Le premier caractère sélectionné doit être alphabétique<br>';
            error = true;
        }

        if (!lastChar.match(regAlpha)) {
            messageError.removeAttribute("hidden");
            messageError.innerHTML = messageError.innerHTML + 'Le dernier caractère sélectionné doit être alphabétique<br>';
            error = true;
        }
        
        if (nextChar.match(regAlpha)) {
            messageError.removeAttribute("hidden");
            messageError.innerHTML = messageError.innerHTML + 'Le dernier caractère sélectionné ne doit pas être suivi d\'un caractère alphabétique<br>';
            error = true;
        }

        if (error) {
            return;
        }

        // Si tout est bon

        mots_ajoute.push(selection);
        let divId='mot'+i;
        let selectId = 'gloses'+i;
        let buttonId = 'ajouter_glose'+i;
        let MotId = 'mot_ambigu'+i;
        let sup_mot_id='supprimer_mot'+i;
        let form =  "<div style='margin-bottom: 15px; padding-bottom: -20px;' id='"+divId+"' class='row row-eq-height'>"
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
                    +"<script id=script-"+selectId+">"
                        +"$(function() {"
                            +"$('#"+selectId+"').multiselect({"
                                +"includeSelectAllOption: true"
                            +"});"
                            +"changeSelectName();"
                        +"});"
                        +"$('#"+divId+"').mouseover(function() {"
                            +"$('#"+divId+"').addClass('ambColor');"
                            +"$('#m"+i+"').addClass('ambColor');"
                        +"});"
                        +"$('#"+divId+"').mouseout(function() {"
                            +"$('#"+divId+"').removeClass('ambColor');"
                            +"$('#m"+i+"').removeClass('ambColor');"
                        +"});"
                        +"$('#m"+i+"').mouseover(function() {"
                            +"$('#"+divId+"').addClass('ambColor');"
                            +"$('#m"+i+"').addClass('ambColor');"
                        +"});"
                        +"$('#m"+i+"').mouseout(function() {"
                            +"$('#"+divId+"').removeClass('ambColor');"
                            +"$('#m"+i+"').removeClass('ambColor');"
                        +"});"
                        +"$('#"+MotId+"').keypress(function() {"
                            +"if (document.getElementById('m"+i+"') !== null) {"
                                +"document.getElementById('m"+i+"').innerHTML = document.getElementById('"+MotId+"').value;"
                            +"}"
                        +"});"
                        +"$('#"+MotId+"').keyup(function() {"
                            +"if (document.getElementById('m"+i+"') !== null) {"
                                +"document.getElementById('m"+i+"').innerHTML = document.getElementById('"+MotId+"').value;"
                            +"}"
                        +"});"
                        +"$('#"+MotId+"').keydown(function() {"
                            +"if (document.getElementById('m"+i+"') !== null) {"
                                +"document.getElementById('m"+i+"').innerHTML = document.getElementById('"+MotId+"').value;"
                            +"}"
                        +"});"
                        +"$('#"+MotId+"').blur(function() {"
                            +"if (document.getElementById('m"+i+"') !== null) {"
                                +"document.getElementById('m"+i+"').innerHTML = document.getElementById('"+MotId+"').value;"
                            +"}"
                        +"});"
                        +"$('#phrase').on('blur', function(e) {"
                            +"if (document.getElementById('m"+i+"') !== null) {"
                                +"document.getElementById('"+MotId+"').value = document.getElementById('m"+i+"').innerHTML.replace(/&nbsp;/g, ' ');"
                            +"}"
                        +"});"
                    +"</script>"
                    +"</div>";
        curr_selectId=selectId;
        document.execCommand('insertHTML', false, "<amb id=m"+i+" class='amb'>" + selectionText.trim() + "</amb>");
        $('#Mots_space').append(form);
        $('#'+divId).append("<input name='ordre[]' type='hidden' value='"+i+"'>");
        $('#'+sup_mot_id).click({id:divId, select:selection }, supp_mot);
        $('#'+buttonId).click({selectId:selectId, MotId:MotId}, show_form);
        i++;
        getGloses(selectionText.trim(), selectId);
        return selection;
    }

    function getPhraseTexte() {
        return $("div.form-control")
            .html()
            .replace(/&nbsp;/ig, ' ')
            .replace(/&lt;/g, '<')
            .replace(/&gt;/g, '>')
            .replace(/<br>/g, '')
            .replace(/ style=""/g, '')
            .replace(/ title="Ce mot est ambigu \(id : [0-9]+\)"/ig, '');
    }

    function supp_mot(param){
        // mots_ajoute = $.grep(mots_ajoute, function(value) {
        //         return value != param.data.select;
        //     });
        
        let divId = "#"+param.data.id;
        let mId = "m"+divId.replace("#mot", "");
        document.getElementById(mId).removeAttribute("class");
        let reg3 = new RegExp('<amb id="'+mId+'">(.*?)</amb>', 'g');
        let mot = document.getElementById(mId).innerHTML;
        
        document.getElementById("phrase").innerHTML = document.getElementById("phrase").innerHTML.replace(reg3, mot)

        $(divId).remove();

        for (let k = 1; k < i; k++) {
            if (document.getElementById("m"+k) !== null) {
                $("#m"+k).mouseover(function() {
                    $("#m"+k).addClass('ambColor');
                    $("#mot"+k).addClass('ambColor');
                });
                $("#m"+k).mouseout(function() {
                    $("#m"+k).removeClass('ambColor');
                    $("#mot"+k).removeClass('ambColor');
                });
            }
        }
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
        console.log(data)
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

        if (document.getElementById("phrase").innerHTML.trim() === "") {
            messageError.removeAttribute("hidden");
            messageError.innerHTML = "La phrase ne doit pas être vide";
            return false;
        }

        if (i > 1) {
            reponse = "{\"phrase\": \"" +document.getElementById("phrase").innerHTML.replace(/\"/g, "'")+ "\",\"motsAmbigus\": [";
            let isFirst = true;

            for (let k = 1; k < i; k++) {
                
                if (document.getElementById("mot"+k) !== null) {
                    if(!isFirst && k !== i) {
                        reponse = reponse.concat(",");
                    }

                    isFirst = false;
    
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
            }

            return reponse;
        } else {
            messageError.removeAttribute("hidden");
            messageError.innerHTML = "Il faut au moins 1 mot ambigu";
            return false;
        }
    }
    

    function getWordsAndGlosses(param){
        var reponse = "";

        if (param < i && param > 0) {
            reponse = "{\"motAmbigu\": \"" +document.getElementById("mot_ambigu"+param).value+ "\",\"position\": " +param+ ",\"gloses\": [";
            var optionsSelected = $("#gloses"+param).val();
            
            for (let k = 0; k < optionsSelected.length; k++) {
                if (k !== 0 && k !== optionsSelected.length) {
                    reponse = reponse.concat(",");
                }

                reponse = reponse.concat("{\"selected\": false, \"valeur\": \"" +optionsSelected[k]+ "\"}")

                /*if (optionsSelected[k] === optionSelected) {
                    reponse = reponse.concat("{\"selected\": false, \"valeur\": \"" +elementSelect.options[k].text+ "\"}")
                } else {
                    reponse = reponse.concat("{\"selected\": false, \"valeur\": \"" +elementSelect.options[k].text+ "\"}")
                }*/

                if (k === optionsSelected.length - 1) {
                    reponse = reponse.concat("]}");
                }
            }
        }

        if (reponse.includes("false")) {
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

        document.getElementsByClassName("multiselect-selected-text")[0].setAttribute("class", "gloses"+(i-1));
    }

    function newChangeSelectName(param) {
        var val = document.getElementById(param);

        if (val !== null) {
            if (document.getElementsByClassName("multiselect-selected-text")[0] !== undefined) {
                document.getElementsByClassName("multiselect-selected-text")[0].innerHTML = "Selecionner les gloses (" +val.options.length+ ")";
                document.getElementsByClassName("multiselect-selected-text")[0].setAttribute("class", param);
            }
        }
    }

    function getGloses(mot, selectGloses) {
        let dataSet = {"data": mot};

        $.ajax({
            type: "POST",
            url: "Create_Phrase/getGloses",
            data: dataSet,
            success: function(data){
                var reponse = JSON.parse(data);
                let options = "";

                for (let k = 0; k <reponse['reponse'].length; k++) {
                    options = options.concat("<option>" +reponse['reponse'][k]['glose']+ "</option>\n")
                }
                
                $("#"+selectGloses).append(options);
                $("#"+selectGloses).multiselect('destroy');
                $("#"+selectGloses).multiselect();
                newChangeSelectName(selectGloses);
            }  
        });
    }