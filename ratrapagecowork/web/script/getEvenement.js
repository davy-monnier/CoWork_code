$("#datepicker").datetimepicker();
$("#datepicker2").datetimepicker();




function showCards(titre, corp ,image ,boutton , id_object,dated , datef  ,quant ){
  		corp = corp.replace(/\n/g,"<br>");
  		var idc = $("#id_c").text();
        return '  <div class="main-card mb-3 card">  <div class="main-card mb-3 card"><img height="250" width="370" src="'+image+'" alt="Card image cap" class="card-img-top"><div class="card-body"><h5 class="card-title">'+titre+'</h5><p>'+corp+'</p><br> <button id="yo" class="btn btn-warning" onclick="reserve('+idc+','+id_object+',\''+dated+'\',\''+datef+'\')">'+boutton+'</button></div><div class="card-footer">Quantité: .<span id="test">'+quant+'</span> </div></div>';
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
    		
             
    
    function show(){
    
    	var time1 =  $("#datepicker").val();
        var time2 =  $("#datepicker2").val();
      	var id_t = $("#id_t").text();
        if(time1 > time2) alert("erreur la date de fin doit être supèrieure à la date de début.");
         var rep = $.post("/routes/getObject.php",{id_type : id_t ,id_site :$("#site").text() , datedebut: time1.replace("/","-") , datefin: time2.replace("/","-")},function( data ) {
            			 
              				
            				var objs = JSON.parse(data);              
            				var toinsert ="";         
           
                			for( var obj in objs){									
                           			toinsert += showCards(objs[obj].nom, objs[obj].description ,"./image/"+objs[obj].image ,"reserver",objs[obj].id,objs[obj].date,objs[obj].date,objs[obj].quantite);                       			                                       	
	           				}
           					if(toinsert == "") toinsert ="Aucun produit n'est disponible pour ce service. veuillez ressayer ultèrieurement s'il vous plaits";	
               				$("#insert").html(toinsert);
                          
                     });

    }

	function reserve(id_c , id_o ,dt_d , dt_f){
     		$.post("/routes/newReservation.php", {id_client: id_c , id_object: id_o, date_debut: dt_d ,date_fin: dt_f},function(data){
               if(data == "ok")alert("Reservation enregistrée.");
               else alert("Reservation Impossible."+data);
              redirectPost("/web/mesService.php","");
            });
    }