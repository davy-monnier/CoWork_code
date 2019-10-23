function showForm(){
 $("#tableau").fadeOut(function(){
 	$("#addpage").slideDown();
 });
 
}

function normal(){
   $("#addpage").slideUp(function(){
 	$("#tableau").fadeIn();
 });
}
function echoTab(obj ){
	var sup = "non";
	var poss = "non";
  	var reserv = "non";
   	
 	if(obj.supervise == 1)sup = "oui";
    if(obj.supervise == -1)sup = "sur commande";
 	if(obj.client_possession == -1)poss= "non";
    else if(obj.client_possession == -2){
      poss= "réparation";
    }
    else{
      poss = "oui";
     
    }
  	var typage="" ;
  
   	if( obj.id_type == null ){ 
      typage = "événement";
      obj.id_type = -1
    }else{
   
      typage = obj.id_type.nom;
      obj.id_type =obj.id_type.id;
      
    }
  	var date = null;
  	if(obj.date != null) date = "'"+obj.date+"'";
  	var prepare = "("+obj.id+",'"+obj.nom+"',"+obj.supervise+",'"+obj.description+"','"+obj.id_type+"',"+date+","+obj.prix+",'"+obj.image+"',"+obj.quantite+")";
 	return  ' <tr><td>'+obj.id+'</td><td>'+obj.nom+'</td><td>'+sup+'</td><td>'+poss+'</td><td>'+typage+'</td><td><button class="btn btn-warning" onclick="prep'+prepare+'">modifier</button></td><td><button class="btn btn-danger delete">suprimer</button></td><td><button class="btn btn-info">planning</button></td></tr>';
}
 function deleterow(id){
  
 }
function prep(id,nom,sup,des,type,date,prix,img,quant){
 try{
 	showForm();
   	prepare(id,nom,sup,des,type,date,prix,img,quant);
 }catch(erreur){} 
}
$("#addpage").hide();
$.get("[URL_API]/routes/getObjectStock.php",function(data){
  	
    var string ='<thead><tr><th >Id</th><th >Nom</th><th >Supervisé</th><th >Posséder</th><th >type</th><th >modifier</th><th>suprimer</th><th >planning</th></tr></thead><tbody > ';
    
    var objs = JSON.parse(data);

    for(client in objs){
        string += echoTab(objs[client]);
    }
    string += "</tbody>";
    $("#tb").html(string);
	var table =  $("#tb").DataTable({    
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
 $('#tb').on( 'click', 'tbody tr  .delete', function () {
    $('#tb').DataTable().row( $(this).parents('tr') ).remove().draw();
} );
  if($('#email_s').text() != "" || $('#email_s').text() != null){
   		table.search($('#email_s').text()).draw(); 
  }
});