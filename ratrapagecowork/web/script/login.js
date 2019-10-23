function co(){
    var email = $('#email').val();
    var pass =$('#password').val();
    if(email == "" && pass == ""){
        alert("veuillez saisir tous les champs");
        return;
    }
    $.post("[URL_API]/routes/connexion.php",{email:email,password:pass},function(data){
        try{
            var user = JSON.parse(data);
            var id = user.id;
            var site = user.id_site;
            var dette = user.dette;
            var token = user.token;
            var email = user.email;
            $.post("[URL_API]/web/connect.php",{id:id,email:email,site:site,dette:dette,token:token},function (data){
                if(data == "erreur"){
                    alert("une erreur s'est produite");
                    return;
                }
                window.location.href = "[URL_API]/web/";
            });
            
        }catch(e){
            alert("Adresse ou mot de passe invalide");
        }
    });
}