function sendMessage() {
    let dataSet;
    let msgError = document.getElementById("msgError");
    
    let pseudo = document.getElementById("pseudo");
    let email = document.getElementById("email");
    let objet = document.getElementById("objet").value;
    let message = document.getElementById("message").value;
    
    if (pseudo !== null) {
        pseudo = pseudo.value;
        email = email.value;

        if (pseudo.trim() === "" || email.trim() === "" || objet.trim() === "" || message.trim() === "") {
            msgError.removeAttribute("hidden");
            msgError.innerHTML = "Aucun champs ne doit être vide.";
            return;
        }

        dataSet = {"pseudo" : pseudo, "email" : email, "objet" : objet, "message" : message};
    } else {
        if (objet.trim() === "" || message.trim() === "") {
            msgError.removeAttribute("hidden");
            msgError.innerHTML = "Aucun champs ne doit être vide.";
            return;
        }
        dataSet = {"objet" : objet, "message" : message};
    }

    $.ajax({
        type: "POST",
        url: "Contact/saveMessage",
        data: dataSet,
        success: function(data){
            var reponse = JSON.parse(data);
            if (reponse['reponse'] === true) {
                document.getElementById('pseudo').value = "";
                document.getElementById('email').value = "";
                document.getElementById('objet').value = "";
                document.getElementById('message').value = "";
                swal(
                    'Formulaire de contact envoyé',
                    reponse['message'],
                    'success'
                ) 
            }
        }  
    });
}