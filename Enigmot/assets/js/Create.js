var url = document.location.href.split("?/");
var enigmot = document.location.href.split("ENIGMOT");

if (url[1] !== undefined && !isNaN(parseInt(enigmot[1])) && url[1] == "creation") {
    swal(
        'Votre phrase a bien été enregistré',
        'La création de cette phrase vous a coûtée '+enigmot[1]+' crédits.',
        'success'
    ) 
}


var i=1;
var curr_selectId='';
var curr_mot='';
var curr_selId='';
var mots_ajoute=[];
var cost = 0;
var arrayGlose = Array();
$(document).ready(function(){
    //ajouter glose dans la base de donnée
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

        if (document.getElementById(curr_selectId) !== null) {
            let options = document.getElementById(curr_selectId).options;
            for (let k = 0; k < options.length; k++) {
                if (options[k].text.trim() === glose.trim()) {
                    document.getElementById("msgErrorPopup").removeAttribute("hidden");
                    document.getElementById("msgErrorPopup").innerHTML = "Cette glose existe déjà pour ce mot ambigus.";
                    return; 
                } 
            }
        }

        ajouter_glose(glose.toLowerCase());

        swal(
            'Glose Ajouté!',
            'Vous pouvez la selectionner dans la liste deroulante.',
            'success'
        )
    });

    //ajouter le field MotAmbigu et récupérer les gloses associé
    $('#Mot_butt').click(function(){
        var mot = add_mot();
    });
});

$("#phrase").on('keypress', function(e) {
    var keyCode = e.which;

    if (keyCode == 13) {
        return false;
    }
});

$(document).ready(function() {
      $(".list").niceScroll();
});

function ajouter_glose(value){
    //ajoute la glose dans select
    let option="<option selected>"+value+"</option>";
    $('#'+curr_selectId).append(option);
    $('#'+curr_selectId).multiselect('destroy');
    $('#'+curr_selectId).multiselect();
    newChangeSelectName(curr_selectId);

    $('#'+curr_selId).append(option);
    $('#'+curr_selId).niceSelect("update");
    $(".list").niceScroll();
    $(".list").addClass("scrollGloses");

    let positionGlose = curr_selectId[curr_selectId.length - 1];
    arrayGlose[positionGlose] = arrayGlose[positionGlose] + 1;
    cost+=50;
    document.getElementById("cost").innerHTML = cost;

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
    let selId = 'select'+i;
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
                +"<div class='col-xs-12 col-sm-3 col-md-3 selectGloseMargin'>"
                +"<label class='control-label'>Glose sélectionée</label>"
                +"<div>"
                +"<select class='form-control selectGloseWidth' id='"+selId+"' required='required'><option selected disabled>Sélectionner le bon sens</option></select>"
                +"</div>"
                +"</div>"
                +"<div class='col-xs-12 col-sm-4 col-md-4 actionMargin'>"
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
                    +"$('#"+selId+"').niceSelect();"
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
    $('#'+buttonId).click({selectId:selectId, MotId:MotId, selId:selId}, show_form);
    arrayGlose[i] = 0;
    i++;
    getGloses(selectionText.trim(), selectId, selId);

    $('#'+selectId).change({idSelect:selId}, changeGloseListener);
    
    cost+=50;
    document.getElementById("cost").innerHTML = cost;


    return selection;
}

function changeGloseListener(param) {
    let optionsMultiSelect = $(this).val();
    let optionsSelect = "<option selected disabled>Sélectionner le bon sens</option>";
    let positionGlose = (param.data.idSelect)[(param.data.idSelect).length - 1];
    arrayGlose[positionGlose] = optionsMultiSelect.length;

    for (let k = 0; k < optionsMultiSelect.length; k++) {
        optionsSelect = optionsSelect + "<option>"+optionsMultiSelect[k]+"</option>";
    }
    
    document.getElementById(param.data.idSelect).innerHTML = optionsSelect;
    $("#"+param.data.idSelect).niceSelect("update");
    $(".list").niceScroll();
    $(".list").addClass("scrollGloses");

    let nbrGloses = 0;
    cost = 0;
    for (let k = 0; k < i; k++) {
        if (document.getElementById("mot"+k) !== null) {
            cost = cost + 50;
            nbrGloses = nbrGloses + arrayGlose[k];
        }
    }
    cost = cost + nbrGloses * 50;
    document.getElementById("cost").innerHTML = cost;
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
    let divId;

    if (param.data !== undefined) {
        divId = "#"+param.data.id;
    } else {
        divId = "#"+param;
    }

    let mId = "m"+divId.replace("#mot", "");
    if (document.getElementById(mId) !== null) {
        document.getElementById(mId).removeAttribute("class");
    }
    let reg3 = new RegExp('<amb id="'+mId+'">(.*?)</amb>', 'g');
    let mot;
    if (document.getElementById(mId) !== null) {
        mot = document.getElementById(mId).innerHTML;
    }
    
    document.getElementById("phrase").innerHTML = document.getElementById("phrase").innerHTML.replace(reg3, mot)

    $(divId).remove();

    //Ré-calcule du couts lorsqu'un mot est supprimé
    let positionGlose = (param.data.id)[(param.data.id).length - 1];
    arrayGlose[positionGlose] = 0;
    let nbrGloses = 0;
    cost = 0;
    for (let k = 1; k < i; k++) {
        if (document.getElementById("mot"+k) !== null) {
            cost = cost + 50;
            nbrGloses = nbrGloses + arrayGlose[k];
        }
    }
    cost = cost + nbrGloses * 50;
    document.getElementById("cost").innerHTML = cost;

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

function show_form(param, param2){
    if (param.data !== undefined) {
        curr_selectId=param.data.selectId;
        curr_mot=param.data.MotId;
        curr_selId = param.data.selId;
    } else {
        curr_selectId = param;
        curr_mot = param2;
    }

    document.getElementById("glose_input").value = "";
    document.getElementById("h4Message").innerHTML = "Ajouter une glose au mot ambigu \""+document.getElementById(curr_mot).value+"\"";
    document.getElementById("msgErrorPopup").setAttribute("hidden", "hidden");
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
    let messageError = document.getElementById("messageError");
    messageError.setAttribute("hidden", "");
    messageError.innerHTML = "";
    
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
                    document.location.href="?q=h&rlz=1C1CHBD_frFR887FR887ENIGMOT"+reponse["cost"]+"ENIGMOT&oq=h&aqs=?/creation";
                } else {
                    messageError.removeAttribute("hidden");
                    messageError.innerHTML = "Vous n'avez pas assez de crédits.<br>Il vous faut au moins "+reponse["cost"]+" crédits pour pouvoir créer cette phrase."
                }
            }  
        });
    }
}

function getSentence() {
    let messageError = document.getElementById("messageError");
    messageError.setAttribute("hidden", "");
    messageError.innerHTML = "";
    let ambiguWordIsExists = false;

    if (document.getElementById("phrase").innerHTML.trim() === "") {
        messageError.removeAttribute("hidden");
        messageError.innerHTML = "La phrase ne doit pas être vide";
        return false;
    }

    for (let k = 1; k < i; k++) {
        if (document.getElementById("m"+k) !== null) {
            ambiguWordIsExists = true;
        }
    }

    if (!ambiguWordIsExists) {
        messageError.removeAttribute("hidden");
        messageError.innerHTML = "Il faut au moins 1 mot ambigu";
        return false;
    }

    //Construction du JSON à envoyer au controller
    let reponse = "";
    let isFirst = true;
    let positionWord = 0;

    for (let k = 1; k < i; k++) {
        
        if (document.getElementById("mot"+k) !== null) {
            if(!isFirst && k !== i) {
                reponse = reponse.concat(",");
            }

            isFirst = false;
            positionWord++;

            let result = getWordsAndGlosses(k, positionWord);
            if (result === false) {
                messageError.removeAttribute("hidden");
                messageError.innerHTML = "Vous n'avez selectionné aucune glose pour le mot ambigu \"" +document.getElementById("mot_ambigu"+k).value+ "\"";
                return false;
            } else if (result === "no glose") {
                messageError.removeAttribute("hidden");
                messageError.innerHTML = "Vous n'avez pas selectionné le bon sens du mot ambigu \"" +document.getElementById("mot_ambigu"+k).value+ "\"";
                return false;
            } else if (result === "1 glose") {
                messageError.removeAttribute("hidden");
                messageError.innerHTML = "Vous devez associer au moins 2 gloses pour le mot ambigu \"" +document.getElementById("mot_ambigu"+k).value+ "\"";
                return false;
            } else {
                messageError.setAttribute("hidden", "");
                messageError.innerHTML = ""
                reponse = reponse.concat(result);
            }
        }
    }

    positionWord = 0;

    for (let k = 1; k < i; k++) {
        if (document.getElementById("mot"+k) !== null) {
            positionWord++;
            document.getElementById("m"+k).setAttribute("id", "m"+positionWord);
            document.getElementById("mot"+k).setAttribute("id", "mot"+positionWord);
            document.getElementById("gloses"+k).setAttribute("id", "gloses"+positionWord);
            document.getElementById("select"+k).setAttribute("id", "select"+positionWord);
            document.getElementById("mot_ambigu"+k).setAttribute("id", "mot_ambigu"+positionWord);
            document.getElementById("ajouter_glose"+k).setAttribute("id", "ajouter_glose"+positionWord);
            document.getElementById("supprimer_mot"+k).setAttribute("id", "supprimer_mot"+positionWord);
            
            $('#ajouter_glose'+positionWord).unbind();
            $('#ajouter_glose'+positionWord).click({selectId:"gloses"+positionWord, MotId:"mot_ambigu"+positionWord, selId:"select"+positionWord}, show_form);
            
            $('#supprimer_mot'+positionWord).unbind();
            $('#supprimer_mot'+positionWord).click({id:"mot"+positionWord}, supp_mot);

            $('#m'+positionWord).unbind();
            $('#m'+positionWord).mouseover({idM:"m"+positionWord, idD:"mot"+positionWord}, addEventMoussover);
            $('#m'+positionWord).mouseout({idM:"m"+positionWord, idD:"mot"+positionWord}, addEventMoussout);

            $('#mot'+positionWord).unbind();
            $('#mot'+positionWord).mouseover({idM:"m"+positionWord, idD:"mot"+positionWord}, addEventMoussover);
            $('#mot'+positionWord).mouseout({idM:"m"+positionWord, idD:"mot"+positionWord}, addEventMoussout);

            $('#mot_ambigu'+positionWord).unbind();
            $('#mot_ambigu'+positionWord).keypress({idM:"m"+positionWord, idD:"mot_ambigu"+positionWord}, addEventKey);
            $('#mot_ambigu'+positionWord).keyup({idM:"m"+positionWord, idD:"mot_ambigu"+positionWord}, addEventKey);
            $('#mot_ambigu'+positionWord).keydown({idM:"m"+positionWord, idD:"mot_ambigu"+positionWord}, addEventKey);
            $('#mot_ambigu'+positionWord).blur({idM:"m"+positionWord, idD:"mot_ambigu"+positionWord}, addEventKey);

            $('#gloses'+positionWord).unbind();
            $('#gloses'+positionWord).change({idSelect:"select"+positionWord}, changeGloseListener);
        }
    }

    // Nettoyage de la phrase avant l'insertion dans la base de donnée
    let phrase = document.getElementById("phrase").innerHTML.replace(/\"/g, "'");
    phrase = phrase.replace(/&nbsp;/g, " ");
    phrase = phrase.replace(/class='amb'/g, "");
    phrase = phrase.replace(/  /g, "");
    phrase = phrase.replace(/ >/g, ">");
    if (phrase[0] !== "<") {
        phrase = phrase[0].toUpperCase() + phrase.substring(1, phrase.length);
    } else {
        phrase = phrase.substring(0, 13) + phrase[13].toUpperCase() + phrase.substring(14, phrase.length);
    }
    phrase = phrase + ".";
    
    
    //Construction du JSON à envoyer au controller
    reponse = "{\"phrase\": \"" +phrase+ "\",\"motsAmbigus\": [" + reponse;
    reponse = reponse.concat("]}");
    return reponse;
}

function addEventMoussover(param) {
    $("#"+param.data.idM).addClass('ambColor');
    $("#"+param.data.idD).addClass('ambColor');
}

function addEventMoussout(param) {
    $("#"+param.data.idM).removeClass('ambColor');
    $("#"+param.data.idD).removeClass('ambColor');
}

function addEventKey(param) {
    if (document.getElementById(param.data.idM) !== null) {
        document.getElementById(param.data.idM).innerHTML = document.getElementById(param.data.idD).value;
    }
}

function getWordsAndGlosses(param, position){
    let reponse = "";

    if (param < i && param > 0) {
        reponse = "{\"motAmbigu\": \"" +document.getElementById("mot_ambigu"+param).value+ "\",\"position\": " +position+ ",\"gloses\": [";
        let optionsSelected = $("#gloses"+param).val();

        if (optionsSelected.length !== 0) {
            if (optionsSelected.length >= 2) {
                    let optionSelected = $("#select"+param).val();
            
                if (optionSelected !== null) {
                    for (let k = 0; k < optionsSelected.length; k++) {
                        if (k !== 0 && k !== optionsSelected.length) {
                            reponse = reponse.concat(",");
                        }
            
                        if (optionsSelected[k] === optionSelected) {
                            reponse = reponse.concat("{\"selected\": true, \"valeur\": \"" +optionsSelected[k]+ "\"}")
                        } else {
                            reponse = reponse.concat("{\"selected\": false, \"valeur\": \"" +optionsSelected[k]+ "\"}")
                        }
            
                        if (k === optionsSelected.length - 1) {
                            reponse = reponse.concat("]}");
                        }
                    }
                } else {
                    return "no glose";
                }
            } else {
                return "1 glose";
            }
        } else {
            return false;
        }
    }

    if (reponse.includes("motAmbigu") && reponse.includes("selected") && reponse.includes("true")) {
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

function getGloses(mot, selectGloses, selId) {
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