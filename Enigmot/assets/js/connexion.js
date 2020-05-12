window.onload = function() {
    var url = document.location.href.split("?inscription=");

    if (url[1] == "%22true%22") {
        var messageSuccess = document.getElementById("messageSuccess");
        messageSuccess.removeAttribute("hidden");        
        messageSuccess.innerHTML="Inscription effectuée avec succès. Vous pouvez vous connecter dès maintenant.";
    }
}

function verify_form_connexion(){

    var messageSuccess = document.getElementById("messageSuccess");
    messageSuccess.innerHTML = "";
    messageSuccess.setAttribute("hidden", "");

    var error = false;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value.trim();
    var errorEmail = document.getElementById("errorEmail");
    var errorPassword = document.getElementById("errorPassword");
    var messageError = document.getElementById("messageError");

    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (!email.match(mailformat)) {
        errorEmail.removeAttribute("hidden");
        errorEmail.innerHTML = "L'adresse email n'est pas valide.";
        error = true;
    } else {
        errorEmail.setAttribute("hidden", "");
        errorEmail.innerHTML = "";
    }

    if (password.length < 6) {
        errorPassword.removeAttribute("hidden");
        errorPassword.innerHTML = "Le mot de passe doit contenir au moins 6 caractères.\nL'espace n'est pas accepté.";
        error = true;
    } else {
        errorPassword.setAttribute("hidden", "");
        errorPassword.innerHTML = "";
    }

    if (error === true) {
        return;
    }

    var dataSet = {"email" : email, "password" : password};
    
    $.ajax({
        type: "POST",
        url: "Connexion/verifyUserWhenConnecting",
        data: dataSet,
        success: function(data){
            var reponse = JSON.parse(data);
            if (reponse['reponse'] === false) {
                messageError.removeAttribute("hidden");
                messageError.innerHTML = "Adresse e-mail ou mot de passe eronné.";
            } else {
                messageError.setAttribute("hidden", "");
                messageError.innerHTML = "";
                document.location.href = "home";
            }
        }  
    });
}