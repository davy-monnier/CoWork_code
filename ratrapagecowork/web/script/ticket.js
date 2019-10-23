//ouvre pop up de  validation
function validateCreate(type,description){
    
    var titre = "Création de ticket";
    var corp ="Voulez vous vraiment créer le ticket incident de type "+type+"<br>Message:<br>"+description;
    var fonction = "create("+type+",\""+description+"\")";
    popValidate(titre,corp,fonction);
}

//creer ticket incident
function create(type,description){
    $.post("[URL_API]/routes/newIncident.php",{id_type_panne : type , description: description},function(data){
        alert(data);
        if(data == "erreur"){
            alert("impossible de créer un ticket incident! Veuillez le signaler à la réception.");
        }
        stoppop();
    });
}

//inject les options de type de panne
function insertOptions(){
    $.get("[URL_API]/routes/getTypePanne.php",function(data){
        var json = JSON.parse(data);
        var options ="";
        for(var i in json){
            options += "<option value='"+json[i].id+"'>"+json[i].nom+"</option>";
        }
        $('#options').html(options);
    });
}

//dooner la permission de valider
function check(){
    var vt = "<button class='btn btn-success'>Créer</button>";
    if($("#des").val() != ""){
        vt = "<button class='btn btn-warning' onclick='validateCreate("+$("#options").val()+",\""+$("#des").val()+"\")'>Créer</button>";
    }
  	$("#boutons").html(vt);
}

$(".in").change(function(){
    check();
});
insertOptions();
check();
