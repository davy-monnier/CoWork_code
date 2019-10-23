
function showCards(titre, corp ,image ,boutton ,duree, id_statut , prix ,photo){
  		corp = corp.replace(/\n/g,"<br>");
  		if(boutton=="Souscrire") boutton =  '<button id="yo" class="btn btn-warning" onclick="souscrir('+id_statut+','+duree+')">'+boutton+'</button>';
  		else boutton = ' <button id="yo" class="btn btn-warning" onclick="voirplus('+id_statut+',\''+photo+'\','+prix+')">'+boutton+'</button>';
        return '  <div class="main-card mb-3 card"><img height="250" width="370" src="'+image+'" alt="Card image cap" class="card-img-top"><div class="card-body"><h5 class="card-title">'+titre+'</h5><p>'+corp+'</p><br>'+boutton+'</div><div class="card-footer"> </div></div>';
}

function test(){
 	alert("test"); 
}
function souscrir(id_statut ,duree ){
	$.post("[URL_API]/routes/newAbonnement.php",{ id_statut:id_statut, duree:duree },function(data){
    	alert(data);
    });
}
function voirplus(id_statut ,photo, prix){
    
                        var toinsert="";
                    	
  						alert("je passe");
                   	 	$.post("[URL_API]/routes/selectStatut.php",{id : id_statut , className : "STATUT"},function(data){
                    	alert(data);	
                          var objs = JSON.parse(data);
                            toinsert += showCards(objs.nom, objs.description ,photo ,"Souscrire",objs.duree,id_statut);
                        	$("#insert").html(toinsert);
                          
                     	});
}
function abo(div , url){
       
    
            
            var rep = $.get(url ,function( data ) {
            	var objs = JSON.parse(data);
            	var toinsert ="";
               
                	for( var obj in objs){
                      
                    	var prix        = objs[obj].prix;
                    	var id_statut   = objs[obj].id_statut;
                    	var id_site     =objs[obj].id_statut;
                        var photo = "premium.jpg";
                   	 	$.post("[URL_API]/routes/selectStatut.php",{id : id_statut , className : "STATUT"},function(data){
                    		var objs = JSON.parse(data);
                           toinsert += showCards(objs.nom, objs.description.substring(0,255) ,"premium.jpg" ,"voir plus",objs.duree ,objs.id,prix,photo);
                        	$("#"+div).html(toinsert);
                          
                     	});
	           		}
               
 
            });
     
   
   
   
   
}


abo("insert","[URL_API]/routes/getAbonnement.php");         