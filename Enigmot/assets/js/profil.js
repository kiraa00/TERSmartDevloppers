function validedForm() {
    let errorPassword = document.getElementById("msgError");

    let ancienMotDePasse = document.getElementById("ancienMotDePasse").value.trim();
    let nouveauMotDePasse = document.getElementById("nouveauMotDePasse").value.trim();
    let confirmMotDePasse = document.getElementById("confirmMotDePasse").value.trim();

    if (ancienMotDePasse === "" || nouveauMotDePasse === "" || confirmMotDePasse === "") {
        errorPassword.removeAttribute("hidden");
        errorPassword.innerHTML = "Aucun champs ne doit être vide.\nL'espace n'est pas accepté.";
        return;
    }

    if (nouveauMotDePasse.length < 6) {
        errorPassword.removeAttribute("hidden");
        errorPassword.innerHTML = "Le nouveau mot de passe doit contenir au moins 6 caractères.\nL'espace n'est pas accepté.";
        return;
    } else {
        errorPassword.setAttribute("hidden", "");
        errorPassword.innerHTML = "";
    }

    if (nouveauMotDePasse !== confirmMotDePasse) {
        errorPassword.removeAttribute("hidden");
        errorPassword.innerHTML = "Les mots de passes ne correspondent pas.";
        return;
    } else {
        errorPassword.setAttribute("hidden", "");
        errorPassword.innerHTML = "";
    }

    var dataSet = {"ancienMotDePasse" : ancienMotDePasse, "nouveauMotDePasse" : nouveauMotDePasse};

    $.ajax({
        type: "POST",
        url: "Profil/editPassword",
        data: dataSet,
        success: function(data){
            var reponse = JSON.parse(data);
            if (reponse['reponse'] === false) {
                errorPassword.removeAttribute("hidden");
                errorPassword.innerHTML = reponse["message"];
            } else {
                errorPassword.setAttribute("hidden", "");
                errorPassword.innerHTML = "";
                document.getElementById("ancienMotDePasse").value = "";
                document.getElementById("nouveauMotDePasse").value = "";
                document.getElementById("confirmMotDePasse").value = "";

                swal(
                    'Nouveau mot de passe enregistré',
                    reponse['message'],
                    'success'
                ) 
            }
        }  
    });
}

function modifyInfo() {
    let errorGenre = document.getElementById("errorGenre");
    let errorDateNaissance = document.getElementById("errorDateNaissance");

    let genre = $("input:checked").val();
    let dateNaissance = document.getElementById("dateNaissance").value;
    
    if (genre !== "Femme" && genre !== "Homme" && (dateNaissance === "" || parseInt(dateNaissance.split("-")[0]) < 1900 || parseInt(dateNaissance.split("-")[0]) > (new Date()).getFullYear())) {
        document.location.href = "profil";
    }

    let dataSet;

    if ((genre === "Femme" || genre === "Homme") && dateNaissance !== "" && parseInt(dateNaissance.split("-")[0]) <= (new Date()).getFullYear() && parseInt(dateNaissance.split("-")[0]) >= 1900) {
        dataSet = {"genre" : genre, "dateNaissance" : dateNaissance, "type" : "GD"};
    } else if (genre === "Femme" || genre === "Homme") {
        dataSet = {"genre" : genre, "type" : "G"};
    } else if (dateNaissance !== "" && parseInt(dateNaissance.split("-")[0]) <= (new Date()).getFullYear() && parseInt(dateNaissance.split("-")[0]) >= 1900) {
        dataSet = {"dateNaissance" : dateNaissance, "type" : "D"};
    }
    
    $.ajax({
        type: "POST",
        url: "Profil/editInfo",
        data: dataSet,
        success: function(data){
            document.location.href = "profil";
        }  
    });
}