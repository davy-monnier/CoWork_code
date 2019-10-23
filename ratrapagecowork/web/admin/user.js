function echoTab(client){
   //var nom = client.client.nom;
  if(client.object == null)$obj = "aucun";
  else $obj = '<a href="[URL_API]/web/admin/adminobject.php?email_s='+client.client.email+'">oui</a>';
  if(client.abo.nom == null)$abo ="sans abonnement";
  else $abo =client.abo.nom;
  $id = client.client.id;
  if(client.client.arrivee < client.client.depart || client.client.arrivee == null )$btn_arr = '<button class="btn btn-warning" onclick="depart('+$id+')">arrivée</button>';
  else $btn_arr = '<button class="btn btn-warning" onclick="arrivee('+$id+')">départ</button>';
  return  ' <tr><td>'+client.client.nom+'</td><td>'+client.client.prenom+'</td><td>'+client.client.email+'</td><td id="dette'+$id+'">'+client.client.dette+'</td><td>'+$obj+'</td><td>'+$abo+'</td><td id="btnarr'+$id+'">'+$btn_arr+'</td><td><button onclick="payer('+client.client.id+')" class="btn btn-warning">payer</button></td></tr>';
}


function payer(id){
 $.post( "[URL_API]/routes/payer.php" ,{id: id},function(data){
   
   $("#dette"+id).text("0");
 });
}

function arrivee(id){
  $.post("[URL_API]/routes/arrivee.php",{id:id},function(data){
   	var user = JSON.parse(data);
    $("#dette"+id).text(user.dette.toFixed(2));
    $("#btnarr"+id).html('<button class="btn btn-warning" onclick="depart('+id+')">arrivée</button>');
  });
}
function depart(id){
   $.post("[URL_API]/routes/depart.php",{id:id},function(data){
     
   	var user = JSON.parse(data);
     $("#btnarr"+id).html('<button class="btn btn-warning" onclick="arrivee('+id+')">départ</button>')
    
  });
}



$.get("[URL_API]/routes/getUser.php",function(data){
 alert(data);
    var string ='<thead><tr><th >Nom</th><th >Prenom</th><th >Email</th><th >Dette</th><th >Objet possession</th><th >Abonnement</th><th >Arrivée/départ</th><th >Caisse</th></tr></thead><tbody > ';
    var objs = JSON.parse(data);
    for(client in objs){
        string += echoTab(objs[client]);
    }
  	string += '</tbody>';
    $("#tb").html(string);
   $("#tb").DataTable({    
     language: {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    }});
});