// Affichage du swal lorsqu'une phrase a bien été créé
var url = document.location.href.split("?/");
var enigmot = document.location.href.split("ENIGMOT");

if (url[1] !== undefined && !isNaN(parseInt(enigmot[1])) && url[1] == "creation") {
    swal(
        'Votre phrase a bien été enregistré',
        'La création de cette phrase vous a coûtée '+enigmot[1]+' crédits.',
        'success'
    ) 
}

// Déclaration des variables globales
var i = 1;
var cost = 0;
var arrayGlose = Array();

//Verification du mot sélectionner dans la phrase
function verifyAndGetWord() {
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
    let messageError = document.getElementById("messageErrorR");
    messageError.setAttribute("hidden", "");
    messageError.innerHTML = "";

    if (selectionText.trim() === '') {
        messageError.removeAttribute("hidden");
        messageError.innerHTML = messageError.innerHTML + "Veuillez d'abord sélctionner un mot dans votre phrase<br>";
        return false;
    }

    if (phraseEditor.html() != parentBase.innerHTML || phraseEditor.html() != parentFocus.innerHTML) {
        messageError.removeAttribute("hidden");
        messageError.innerHTML = messageError.innerHTML + 'Le mot sélectionné est déjà ambigu ou est déjà rattacher à un mot existant<br>';
        error = true;
    }

    if (selection.anchorNode != selection.focusNode) {
        messageError.removeAttribute("hidden");
        messageError.innerHTML = messageError.innerHTML + 'Le mot sélectionné contient déjà un mot ambigu ou un mot déjà rattacher à un mot existant<br>';
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
        return false;
    } else {
        return selection;
    }
}

// Fonction permettant d'ajouter un nouveau mot ambigu
function addMotAmb(){

    let selection = verifyAndGetWord();

    if(selection === false) {
        return;
    }

    let divId = 'div' + i;
    let selectId = 'gloses' + i;
    let buttonId = 'ajouter_glose' + i;
    let MotId = 'mot_ambigu' + i;
    let sup_mot_id = 'supprimer_mot' + i;
    
    let form =  "<div style='margin-bottom: 15px; padding-bottom: -20px;' id='"+divId+"' class='row row-eq-height'>"
                +"<div class='col-xs-12 col-sm-3 col-md-3'>"
                +"<label class='control-label required'>Mot ambigu</label>"
                +"<input type='text' class='form-control widthInput' name='mot_ambiguD[]' id='"+MotId+"' autocomplete='off' value=\""+selection+"\">"
                +"</div>"
                +"<div class='col-xs-12 col-sm-4 col-md-4 selectMultipleRight'>"
                +"<label class='control-label'>Glose associée</label>"
                +"<div>"
                +"<select class='form-control widthSelect' name='selection_box' id='"+selectId+"' required='required'><option selected disabled>Sélectionner le bon rattachement</option></select>"
                +"</div>"
                +"</div>"
                +"<div class='col-xs-12 col-sm-5 col-md-5 actionMargin'>"
                +"<div class='form-group'>"
                +"<label class='control-label'>Actions</label>"
                +"<div class='divActionBtn'>"
                +"<button id='"+buttonId+"' type='button' class='btn btn-primary btnAjouterMargin'>Rattacher le mot</button>"
                +"<button id='"+sup_mot_id+"' type='button' class='btn btn-danger actionBtnMargin'>Supprimer le mot ambigu</button>"
                +"</div>"
                +"</div>"
                +"</div>"
                +"<script id=script-"+selectId+">"
                    +"$('#"+divId+"').unbind();"
                    +"$('#"+divId+"').mouseover({idM:'m"+i+"', idD:'"+divId+"'}, addEventMoussover);"
                    +"$('#"+divId+"').mouseout({idM:'m"+i+"', idD:'"+divId+"'}, addEventMoussout);"

                    +"$('#m"+i+"').unbind();"
                    +"$('#m"+i+"').mouseover({idM:'m"+i+"', idD:'"+divId+"'}, addEventMoussover);"
                    +"$('#m"+i+"').mouseout({idM:'m"+i+"', idD:'"+divId+"'}, addEventMoussout);"

                    +"$('#"+MotId+"').unbind();"
                    +"$('#"+MotId+"').keyup({idM:'m"+i+"', idD:'"+MotId+"'}, addEventKey);"
                    +"$('#"+MotId+"').keypress({idM:'m"+i+"', idD:'"+MotId+"'}, addEventKey);"
                    +"$('#"+MotId+"').keydown({idM:'m"+i+"', idD:'"+MotId+"'}, addEventKey);"
                    +"$('#"+MotId+"').blur({idM:'m"+i+"', idD:'"+MotId+"'}, addEventKey);"

                    +"$('#phrase').blur({idM:'m"+i+"', idD:'"+MotId+"'}, addEventBlurSentence);"
                +"</script>"
                +"</div>";

    curr_selectId = selectId;
    
    document.execCommand('insertHTML', true, "<amb id=m"+i+" class='amb'>" + selection.toString().trim() + "</amb>");
    $('#divAmbigu').append(form);
    $("#"+curr_selectId).niceSelect();
    $(".list").addClass("scrollGloses");

    $('#'+sup_mot_id).click({selectId:selectId, divId:divId, MotId:"m"+i}, suppressDiv);
    $('#'+buttonId).click({selectId:selectId, divId:divId, MotId:"m"+i}, addRattachement);
    
    arrayGlose[i] = 0;
    cost+=25;
    document.getElementById("cost").innerHTML = cost;

    i++;
    return selection;
}

function addEventMoussover(param) {
    $("#"+param.data.idM).addClass('ambColor');
    $("#"+param.data.idD).addClass('ambColor');
    $("#"+param.data.idR).addClass('ambColor');
    $("[idref='"+param.data.idR+"']").addClass('ambColor');
}

function addEventMoussout(param) {
    $("#"+param.data.idM).removeClass('ambColor');
    $("#"+param.data.idD).removeClass('ambColor');
    $("#"+param.data.idR).removeClass('ambColor');
    $("[idref='"+param.data.idR+"']").removeClass('ambColor');
}

function addEventKey(param) {
    if (document.getElementById(param.data.idM) !== null) {
        document.getElementById(param.data.idM).innerHTML = document.getElementById(param.data.idD).value;
    }
}

function addEventBlurSentence(param) {
    if (param.data.idM !== undefined && param.data.idR === undefined && document.getElementById(param.data.idM) !== null) {
        document.getElementById(param.data.idD).value = document.getElementById(param.data.idM).innerHTML.replace(/&nbsp;/g, ' ');
    }
    
    if (param.data.idR !== undefined) {
        if ($("#"+param.data.idR)[0] !== undefined) {
            $("#"+param.data.idROption)[0].innerHTML = $("#"+param.data.idR)[0].innerHTML.replace(/&nbsp;/g, ' ');
            $("#"+param.data.idS).niceSelect("update");
            $(".list").addClass("scrollGloses");
            addIdOption(param.data.idM);
            addEventMoussReference(param.data.idM, param.data.idS, param.data.idD);
        }
    }
}

function addIdOption(motId) {
    let positionOption = 0;
    let allOptions = document.getElementsByClassName("option");
    for (k = 0; k < allOptions.length; k++) {
        if (!allOptions[k].outerHTML.includes("id") && allOptions[k].innerHTML !== "Sélectionner le bon rattachement") {
            positionOption++;
            allOptions[k].setAttribute("idref", "ref"+positionOption+"_"+motId);
        }
    }
    return positionOption;
}

function addRattachement(param) {
    let selection = verifyAndGetWord();

    if(selection === false) {
        return;
    }

    let motId = param.data.MotId;
    let divId = param.data.divId;
    let selectId = param.data.selectId;
    let nbrOptions = document.getElementById(selectId).options.length;
    let optionId = motId+"_ref"+nbrOptions;
    let option = "<option id="+optionId+">"+selection.toString().trim()+"</option>";

    $("#"+selectId).append(option);
    $("#"+selectId).niceSelect("update");
    $(".list").addClass("scrollGloses");

    let positionOption = addIdOption(motId);    

    let refId = "ref"+positionOption+"_"+motId;
    document.execCommand('insertHTML', false, "<ref id="+refId+" class='ref'>" + selection.toString().trim() + "</ref>");

    $('#'+motId).unbind();
    $('#'+motId).mouseover({idM:motId, idD:divId}, addEventMoussover);
    $('#'+motId).mouseout({idM:motId, idD:divId}, addEventMoussout);

    $('#'+divId).unbind();
    $('#'+divId).mouseover({idM:motId, idD:divId}, addEventMoussover);
    $('#'+divId).mouseout({idM:motId, idD:divId}, addEventMoussout);

    addEventMoussReference(motId, selectId, divId);
    addEventBlurReference(optionId, refId, selectId, motId, divId);

    let positionGlose = selectId[selectId.length - 1];
    arrayGlose[positionGlose] = arrayGlose[positionGlose] + 1;
    cost+=25;
    document.getElementById("cost").innerHTML = cost;
}

function addEventMoussReference(motId, selectId, divId) {
    let nbrOptions = document.getElementById(selectId).options.length;

    for(let k = 1; k < nbrOptions; k++) {
        let refId = "ref"+k+"_"+motId;
        $("#"+refId).unbind();
        $("#"+refId).mouseover({idM: motId, idD: divId, idR: refId}, addEventMoussover);
        $("#"+refId).mouseout({idM: motId, idD: divId, idR: refId}, addEventMoussout);

        $("[idref='"+refId+"']").unbind();
        $("[idref='"+refId+"']").mouseover({idM: motId, idD: divId, idR: refId}, addEventMoussover);
        $("[idref='"+refId+"']").mouseout({idM: motId, idD: divId, idR: refId}, addEventMoussout);
    }
}

function addEventBlurReference(optionId, refId, selectId, motId, divId) {
    $("#phrase").blur({idR: refId, idROption: optionId, idS: selectId, idM: motId, idD: divId}, addEventBlurSentence);
}

function suppressDiv(param){
    let divId = param.data.divId;
    let motId = param.data.MotId;
    let selectId = param.data.selectId;

    $("#"+motId).contents().unwrap();

    for(let k = 1; k < document.getElementById(selectId).options.length; k++) {
        let refId = "ref"+k+"_"+motId;
        $("#"+refId).contents().unwrap();
    }

    document.getElementById("phrase").innerHTML = document.getElementById("phrase").innerHTML;

    $("#"+divId).remove();

    //Ré-calcule du couts et ré-ajout des évenements lorsqu'un mot est supprimé
    let positionGlose = selectId[selectId.length - 1];
    arrayGlose[positionGlose] = 0;
    let nbrGloses = 0;
    cost = 0;
    
    for (let k = 1; k < i; k++) {
        if (document.getElementById("m"+k) !== null) {
            $('#m'+k).unbind();
            $('#m'+k).mouseover({idM:"m"+k, idD:"div"+k}, addEventMoussover);
            $('#m'+k).mouseout({idM:"m"+k, idD:"div"+k}, addEventMoussout);
            
            addEventMoussReference("m"+k, "gloses"+k, "div"+k);
            
            cost = cost + 25;
            nbrGloses = nbrGloses + arrayGlose[k];
        }
    }

    cost = cost + nbrGloses * 25;
    document.getElementById("cost").innerHTML = cost;
}

function sendDataR() {
    let messageError = document.getElementById("messageErrorR");
    messageError.setAttribute("hidden", "");
    messageError.innerHTML = "";
    
    let data = getSentenceR();
    
    if (data !== false) {
        let dataSet = {"data": data};

        $.ajax({
            type: "POST",
            url: "creation_rattachement/saveData",
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

function getSentenceR() {
    let messageError = document.getElementById("messageErrorR");
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
        messageError.innerHTML = "Il faut au moins 1 mot ou groupe de mot ambigus";
        return false;
    }

    //Construction du JSON à envoyer au controller
    let reponse = "";
    let isFirst = true;
    let positionWord = 0;

    for (let k = 1; k < i; k++) {
        if (document.getElementById("div"+k) !== null) {
            if(!isFirst && k !== i) {
                reponse = reponse.concat(",");
            }

            isFirst = false;
            positionWord++;

            let result = getWordsAndRattachement(k, positionWord);
            if (result === false) {
                messageError.removeAttribute("hidden");
                messageError.innerHTML = "Vous n'avez selectionné aucun rattachement pour le groupe des mots ambigus \"" +document.getElementById("mot_ambigu"+k).value+ "\"";
                return false;
            } else if (result === "error size") {
                messageError.removeAttribute("hidden");
                messageError.innerHTML = "Vous devez ajouter au moins 2 rattachement au groupe des mots ambigus \"" +document.getElementById("mot_ambigu"+k).value+ "\"";
                return false;
            } else {
                messageError.setAttribute("hidden", "");
                messageError.innerHTML = ""
                reponse = reponse.concat(result);
            }
        }
    }

    positionWord = 0;
    $('#phrase').unbind();

    for (let k = 1; k < i; k++) {
        if (document.getElementById("div"+k) !== null) {
            positionWord++;
            document.getElementById("m"+k).setAttribute("id", "m"+positionWord);
            document.getElementById("div"+k).setAttribute("id", "div"+positionWord);
            document.getElementById("gloses"+k).setAttribute("id", "gloses"+positionWord);
            document.getElementById("mot_ambigu"+k).setAttribute("id", "mot_ambigu"+positionWord);
            document.getElementById("ajouter_glose"+k).setAttribute("id", "ajouter_glose"+positionWord);
            document.getElementById("supprimer_mot"+k).setAttribute("id", "supprimer_mot"+positionWord);
            
            $('#ajouter_glose'+positionWord).unbind();
            $('#ajouter_glose'+positionWord).click({selectId:"gloses"+positionWord, divId:"div"+positionWord, MotId:"m"+positionWord}, addRattachement);
            
            $('#supprimer_mot'+positionWord).unbind();
            $('#supprimer_mot'+positionWord).click({selectId:"gloses"+positionWord, divId:"div"+positionWord, MotId:"m"+positionWord}, suppressDiv);

            $('#m'+positionWord).unbind();
            $('#m'+positionWord).mouseover({idM:"m"+positionWord, idD:"div"+positionWord}, addEventMoussover);
            $('#m'+positionWord).mouseout({idM:"m"+positionWord, idD:"div"+positionWord}, addEventMoussout);

            $('#div'+positionWord).unbind();
            $('#div'+positionWord).mouseover({idM:"m"+positionWord, idD:"div"+positionWord}, addEventMoussover);
            $('#div'+positionWord).mouseout({idM:"m"+positionWord, idD:"div"+positionWord}, addEventMoussout);

            $('#mot_ambigu'+positionWord).unbind();
            $('#mot_ambigu'+positionWord).keypress({idM:"m"+positionWord, idD:"mot_ambigu"+positionWord}, addEventKey);
            $('#mot_ambigu'+positionWord).keyup({idM:"m"+positionWord, idD:"mot_ambigu"+positionWord}, addEventKey);
            $('#mot_ambigu'+positionWord).keydown({idM:"m"+positionWord, idD:"mot_ambigu"+positionWord}, addEventKey);
            $('#mot_ambigu'+positionWord).blur({idM:"m"+positionWord, idD:"mot_ambigu"+positionWord}, addEventKey);

            $('#phrase').blur({idM:"m"+positionWord, idD:"mot_ambigu"+positionWord}, addEventBlurSentence);

            let options = document.getElementById("gloses"+positionWord).options;
            for (let l = 1; l < options.length; l++) {
                document.getElementById("ref"+l+"_m"+k).setAttribute("id", "ref"+l+"_m"+positionWord);
                document.getElementById("m"+k+"_ref"+l).setAttribute("id", "m"+positionWord+"_ref"+l);
                $("[idref='ref"+l+"_m"+k+"']").attr("idref", "ref"+l+"_m"+positionWord);
                addEventBlurReference("m"+positionWord+"_ref"+l, "ref"+l+"_m"+positionWord, "gloses"+positionWord, "m"+positionWord, "div"+positionWord);
            }
        }
    }

    document.getElementById("phrase").innerHTML = document.getElementById("phrase").innerHTML;

    for (let k = 1; k < i; k++) {
        if (document.getElementById("m"+k) !== null) {
            $('#m'+k).unbind();
            $('#m'+k).mouseover({idM:"m"+k, idD:"div"+k}, addEventMoussover);
            $('#m'+k).mouseout({idM:"m"+k, idD:"div"+k}, addEventMoussout);

            addEventMoussReference("m"+k, "gloses"+k, "div"+k);
        }
    }

    // Nettoyage de la phrase avant l'inseration dans la base de donnée
    let phrase = document.getElementById("phrase").innerHTML.replace(/\"/g, "'");
    phrase = phrase.replace(/&nbsp;/g, " ");
    phrase = phrase.replace(/class='amb'/g, "");
    phrase = phrase.replace(/class='ref'/g, "");
    phrase = phrase.replace(/  /g, "");
    phrase = phrase.replace(/ >/g, ">");
    if (phrase[0] !== "<") {
        phrase = phrase[0].toUpperCase() + phrase.substring(1, phrase.length);
    } else if (phrase[1] === "a"){
        phrase = phrase.substring(0, 13) + phrase[13].toUpperCase() + phrase.substring(14, phrase.length);
    } else {
        phrase = phrase.substring(0, 18) + phrase[18].toUpperCase() + phrase.substring(19, phrase.length);
    }
    if ((phrase.substr(phrase.length - 1) !== ".") && (phrase.substr(phrase.length - 1) !== "!") && (phrase.substr(phrase.length - 1) !== "?")) {
        phrase = phrase + ".";
    }

    //Construction du JSON à envoyer au controller
    reponse = "{\"phrase\": \"" +phrase+ "\",\"motsAmbigus\": [" + reponse;
    reponse = reponse.concat("]}");
    
    return reponse;
}

function getWordsAndRattachement(param, position){
    let optionSelected = $("#gloses"+param).val();
    
    if (optionSelected !== null) {
        let options = document.getElementById("gloses"+param).options;
        if (options.length >= 3) {
            let reponse = "{\"motAmbigu\": \"" +document.getElementById("mot_ambigu"+param).value+ "\",\"position\": " +position+ ",\"gloses\": [";
            let trueIsExist = false;

            for (let k = 1; k < options.length; k++) {
                if (k !== 1 && k !== options.length) {
                    reponse = reponse.concat(",");
                }
            
                if (options[k].text === optionSelected  && !trueIsExist) {
                    reponse = reponse.concat("{\"selected\": true, \"valeur\": \"" +options[k].text+ "\", \"identifiant\": \"ref" +k+ "\"}")
                    trueIsExist = true;
                } else {
                    reponse = reponse.concat("{\"selected\": false, \"valeur\": \"" +options[k].text+ "\", \"identifiant\": \"ref" +k+ "\"}")
                }
        
                if (k === options.length - 1) {
                    reponse = reponse.concat("]}");
                }
            }
            return reponse;
        } else {
            return "error size";
        }
    } else {
        return false;
    }
}

$("#phrase").on('keypress', function(e) {
    var keyCode = e.which;

    if (keyCode == 13) {
        return false;
    }
});