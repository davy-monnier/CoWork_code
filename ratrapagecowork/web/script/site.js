function setSite(){
    
    $.get("[URL_API]/routes/getSite.php",function(data){
        var objs = JSON.parse(data);
        var options ="";
        for(var i in objs){
            options += '<option value="'+objs[i].id+'">'+objs[i].nom+'</option>';
        }
        $('#optsite').html(options);
        $('#optsite').change(changeSite);
    });
}

function changeSite(){
    
    var id_site = $('#optsite').val();
    $.post("[URL_API]/routes/changeSite.php",{site:id_site},function(data){
        if(data != "erreur"){
            popConfirme("Changer de site","Vous venez de changer de site!");
        }
    });
    
}

setSite();