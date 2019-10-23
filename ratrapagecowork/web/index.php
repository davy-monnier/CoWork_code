<?php
$_SESSION["id"] = 1;
include('corptop.php');
$url =' [URL_API]/routes/getEvents.php';
$data = array('id' => $_SESSION["id"] );

echo"
<h2><b>Mes réservations</b> </h2><br>
<div id='calendrier'></div>
<script>
	var calendarEl =$('#calendrier')[0] ;
	$.get('[URL_API]/routes/getEvents.php',function(data){
		var eventsJson = JSON.parse(data);
		var calendar = new FullCalendar.Calendar(calendarEl, {
				lang: 'fr',
				plugins: ['dayGrid', 'timeGrid', 'list','interaction','moment'],
				events:eventsJson,
				eventClick: function(info) { 	
    					var start = moment(info.event.start).format('DD-MM-YYYY HH:mm');
        				var end = moment(info.event.end).format('DD-MM-YYYY HH:mm');
    					var message = '<h3>'+info.event.title+'</h3>informations sur votre résevation:<br> Début: '+start+'<br> Fin: '+end+'<br><button onclick=\'stoppop()\' class=\'btn btn-warning ml10\'> ok</button><button onclick=\'sup()\' class=\'btn btn-danger ml10\'> suprimer</button>';
    					//info.event.id;
        				pop(message);
   
    			}
		});

		calendar.render();
	});
</script>";
include('corpbot.php');