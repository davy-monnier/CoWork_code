
<div id="pop">
  <div class="main-card mb-3 card">                               		
    <div id="card-body" class="card-body">
    </div>
  </div>
 </div>
 <script>

$("#pop").hide();

function pop(message){
	
    $("#card-body").html(message);
    
    $("#tab-content-0").fadeOut( 400, function() {
    	$("#pop").slideDown( "slow");
  });
    
}

function stoppop(){

    
    
    $("#pop").slideUp( "slow", function() {
    	$("#tab-content-0").fadeIn( 400);
  });
    
}
function popValidate(titre ,message ,fonction){
	
	var html  = "<div>"+titre+"</div>";
    html += " <div>"+message+"</div>";
    html += "<button onclick='"+fonction+"' class='btn btn-warning' > ok </button><button onclick='stoppop()' class='btn btn-danger'> annuler </button>";
    pop(html);
}

function popConfirme(titre ,message ){
	
	var html  = "<div>"+titre+"</div>";
    html += " <div>"+message+"</div>";
    html += "<button onclick='stoppop()' class='btn btn-warning'> ok </button>";
    pop(html);
}

</script>