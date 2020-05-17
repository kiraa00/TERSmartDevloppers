function verify_form(){
    var error = false;
    var pseudo = document.getElementById("pseudo").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value.trim();
    var password_verify = document.getElementById("password_verify").value.trim();
    var errorPseudo = document.getElementById("errorPseudo");
    var errorEmail = document.getElementById("errorEmail");
    var errorPassword = document.getElementById("errorPassword");
    var errorPasswordVerify = document.getElementById("errorPasswordVerify");

    if (pseudo === "") {
        errorPseudo.removeAttribute("hidden");
        errorPseudo.innerHTML = "Vous devez indiquer un pseudo.";
        error = true;
    } else {
        errorPseudo.setAttribute("hidden", "");
        errorPseudo.innerHTML = "";
    }

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

    if (password_verify !== password) {
        errorPasswordVerify.removeAttribute("hidden");
        errorPasswordVerify.innerHTML = "Les mots de passes ne correspondent pas.";
        error = true;
    } else {
        errorPasswordVerify.setAttribute("hidden", "");
        errorPasswordVerify.innerHTML = "";
    }

    if (error === true) {
        return;
    }

    var dataSet = {"pseudo" : pseudo, "email" : email};
    
    $.ajax({
        type: "POST",
        url: "Inscription/verifyPseudoAndEmail",
        data: dataSet,
        success: function(data){
            var reponse = JSON.parse(data);
            
            if (reponse['pseudo'] === false) {
                errorPseudo.removeAttribute("hidden");
                errorPseudo.innerHTML = "Le pseudo \"" +pseudo+ "\" est déjà utilisé.";
                error = true;
            } else {
                errorPseudo.setAttribute("hidden", "");
                errorPseudo.innerHTML = "";
            }

            if (reponse['email'] == false) {
                errorEmail.removeAttribute("hidden");
                errorEmail.innerHTML = "L'adresse email \"" +email+ "\" est déjà utilisé.";
                error = true;
            } else {
                errorEmail.setAttribute("hidden", "");
                errorEmail.innerHTML = "";
            }

            if (error == true) {
                return;
            }

            var dataSet = {"pseudo" : pseudo, "email" : email, "password" : password};

            $.ajax({
                type: "POST",
                url: "Inscription/registerUser",
                data: dataSet,
                success: function(data){
                    document.location.href="Connexion?inscription=\"true\"";
                }  
            });
        }  
    });
}