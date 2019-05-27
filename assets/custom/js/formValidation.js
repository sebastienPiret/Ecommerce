// form validation warning

var form  = document.getElementsByTagName('form')[0];

var nom = document.getElementById('first_name');
var prenom = document.getElementById('last_name');
var email = document.getElementById('mail');
var password=document.getElementById('password');
var password_confirmation=document.getElementById('password_confirmation');

var error = document.querySelector('.error');

nom.addEventListener("input", function (event) {
    // checking mail validity
    if (nom.value == ""){
        error.innerHTML = "Please enter your name";
        error.className = "error active";
    }else{
        error.innerHTML = ""; // On réinitialise le contenu
        error.className = "error"; // On réinitialise l'état visuel du message
    }
}, false);
prenom.addEventListener("input", function (event) {
    // checking mail validity
    if (prenom.value == ""){
        error.innerHTML = "Please enter your last name";
        error.className = "error active";
    }else{
        error.innerHTML = ""; // On réinitialise le contenu
        error.className = "error"; // On réinitialise l'état visuel du message
    }
}, false);

email.addEventListener("input", function (event) {
    // checking mail validity
    if (email.validity.valid) {
        // S'il y a un message d'erreur affiché et que le champ
        // est valide, on retire l'erreur
        error.innerHTML = ""; // On réinitialise le contenu
        error.className = "error"; // On réinitialise l'état visuel du message
    }
}, false);

password_confirmation.addEventListener('input',function(event){
    if(password_confirmation.value == password.value){
        error.innerHTML = ""; // On réinitialise le contenu
        error.className = "error"; // On réinitialise l'état visuel du message
    }else{
        error.innerHTML = "passwords must match";
        error.className = "error active";

    }
},false);
password.addEventListener('input',function(event){


    if(password_confirmation.value == password.value){
        error.innerHTML = ""; // On réinitialise le contenu
        error.className = "error"; // On réinitialise l'état visuel du message
    }else{
        error.innerHTML = "passwords must match";
        error.className = "error active";

    }
},false);



form.addEventListener("submit", function (event) {
    // Chaque fois que l'utilisateur tente d'envoyer les données
    // on vérifie que le champ email est valide.
    if (!email.validity.valid) {

        // S'il est invalide, on affiche un message d'erreur personnalisé
        error.innerHTML = "Waiting for valid mail !";
        error.className = "error active";
        // Et on empêche l'envoi des données du formulaire
        event.preventDefault();
    } else if(password_confirmation.value != password.value){
        error.innerHTML = "Passwords must match!";
        error.className = "error active";
        // Et on empêche l'envoi des données du formulaire
        event.preventDefault();
    }else if(nom.value==""|| prenom.value==""){
        error.innerHTML = "First name and last name must be filled";
        error.className = "error active";
        // Et on empêche l'envoi des données du formulaire
        event.preventDefault();
    }
}, false);