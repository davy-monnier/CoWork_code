function inscri(){
    
    var email = $('#emaili').text();
    var nom = $('#nomi').text();
    var prenom = $('#prenomi').text();
    var mdp = $('#mdpi').text();
    var mdpc = $('#mdpci').text();
    if(email =="" || nom == ""||prenom == ""||mdp == ""||mdpc ==""){
        alert("veuillez saisir tous les champs "+email+nom+prenom+mdp+mdpc);
        return;
    }
    if(mdp == mdpc){
        alert("mot de passe différent.");
        return;
    }
    $.poste("[URL_API]/routes/inscription.php",{email:email,password:mdp,nom:nom,prenom:prenom ,confirmpassword:mdpc},function(data){
        if(data == "erreur"){
            alert("mauvaise saisie des champs");
            return;
        }
        window.location.href = "[URL_API]/web/co.php";
    })
}