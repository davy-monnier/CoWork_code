
function showCards(titre, corp ,image ,boutton , id_type , id_site ){
  		corp = corp.replace(/\n/g,"<br>");
        return '   <div class="main-card mb-3 card"><img height="250" width="370" src="'+image+'" alt="Card image cap" class="card-img-top"><div class="card-body"><h5 class="card-title">'+titre+'</h5><p>'+corp+'</p><br> <button id="yo" class="btn btn-warning" onclick="voirplus('+id_type+','+id_site+')">'+boutton+'</button></div><div class="card-footer"></div> </div>';
}

function test(){
 	alert("test"); 
}

function redirectPost(url, data) {
    var form = document.createElement('form');
    document.body.appendChild(form);
    form.method = 'post';
    form.action = url;
    for (var name in data) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = data[name];
        form.appendChild(input);
    }
    form.submit();
}
function voirplus(id_type ,id_site){
    		
             redirectPost("[URL_API]/web/objectReservation.php",{id_type : id_type ,id_site :id_site });
              				
            			
}
function service(div , url){
       
    
            
            var rep = $.get(url ,function( data ) {
              
            	var objs = JSON.parse(data);
            	var toinsert ="";
               
                	for( var obj in objs){
                      
                    	var prix        = objs[obj].prix;
                    	var statut_level   = objs[obj].statut_level;
                    	var id_type     =objs[obj].id_type;
                        var photo = "premium.jpg";
                   	 	$.post("[URL_API]/routes/selectType.php",{id : id_type },function(data){
                    		var objs = JSON.parse(data);
                          	
                           toinsert += showCards(objs.nom, objs.description.substring(0,255) ,"./image/"+objs.image  ,"voir plus",objs.id,$('#site').text());
                        	$("#"+div).html(toinsert);
                           
                     	});
	           		}
               		 toinsert += showCards("Evenements", "Retrouvez tous les évènements organisés par CoWork!" ,"./image/evenementscowork.jpg"  ,"voir plus",-1,$('#site').text());
                        	$("#"+div).html(toinsert);
 
            });
     
   
   
   
   
}


service("insert","[URL_API]/routes/getDroitReservation.php");         