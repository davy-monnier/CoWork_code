
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
  
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	
   <!--Made with love by Mutiullah Samim -->
   	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div id="co" class="card">
          
			<div class="card-header">
				<h3>Sign In</h3>
				<div class="d-flex justify-content-end social_icon">
					
					<span><i class="fab fa-google-plus-square"></i></span>
					
				</div>
			</div>
			<div class="card-body">
				
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input id="email" type="text" class="form-control" placeholder="email">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input id="password" type="password" class="form-control" placeholder="Mot de passe">
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div>
					<div class="form-group">
                      <button type="button" value="Login" class="btn float-right login_btn" onclick="co()">Login</button>
					</div>
				
              <script>
              		function show(){
              			var ins = $('#inscri').html();
                        var co =$('#co').html();
                        $('#inscri').html(co);
                        $('#co').html(ins);
                        
              		}
                    
              </script>
              <script src="script/login.js"></script>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Vous n'avez pas de compte?<a onclick="show()" href="#">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">Forgot your password?</a>
				</div>
			</div>
		</div>
      
      <div id="inscri" >
        <div class="card-header">
          <div class="panel-heading">
			    		<h3 class="panel-title">Inscription à Co'Work </h3>
			</div>
        </div>
            <div class="card-body">
              
        <div class="row centered-form">
        <div class="col">
        	<div class="panel panel-default">
        		
			 			<div class="panel-body">
			    	
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			                <input type="text" name="first_name" id="prenomi" class="form-control input-sm" placeholder="Prenom">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="last_name" id="nomi" class="form-control input-sm" placeholder="Nom">
			    					</div>
			    				</div>
			    			</div>

			    			<div class="form-group">
			    				<input type="email" name="email" id="emaili" class="form-control input-sm" placeholder="Email Address">
			    			</div>
							
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password" id="mdpi" class="form-control input-sm" placeholder="Password">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="password" name="password_confirmation" id="mdpic" class="form-control input-sm" placeholder="Confirm Password">
			    					</div>
			    				</div>
			    			</div>
			    			
                          <button onclick="inscri()" class="btn btn-warning btn-block">Enregistrer</button>
			    		
			    		
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>
        		<div class="card-footer">
				<div class="d-flex justify-content-center links">
					<a onclick="show()" href="#">Login</a>
				</div>
				
			</div>
        </div>
      
      <script src="script/inscription.js"></script>
      
      </div>
        
	</div>

</body>
</html>