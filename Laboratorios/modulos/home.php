<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Login :: InLab v1</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" /> 
    
	<link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="./css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	
	<link href="./css/font-awesome.min.css" rel="stylesheet" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet" />
    
    <link href="./css/ui-lightness/jquery-ui-1.10.0.custom.min.css" rel="stylesheet" />    
    
    <link href="./css/base-admin-2.css" rel="stylesheet" />
    <link href="./css/base-admin-2-responsive.css" rel="stylesheet" />
	
    <link href="./css/pages/signin.css" rel="stylesheet" type="text/css" />

    <link href="./css/custom.css" rel="stylesheet" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

        <body class="focusedform" style="background-image: url(img/fondomicro.jpg); background-size: 100% 150%;  background-repeat: no-repeat;" >
          
   <br><br><br>         
<div class="account-container stacked">
	
	<div class="content clearfix">
		
		<form action="<? echo Config::PAG_ADMIN . "?content=home2"; ?>" method='post' />
	
			<h1>Login</h1>		
			
			<div class="login-fields">
				
				
				<div class="field">
					<label for="username">Usuario:</label>
					<input type="text" name="Usuario" id="Usuario" value="" placeholder="Usuario" class="login username-field" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Contraseña:</label>
					<input type="password" name="Pass" id="Pass" value="" placeholder="Contraseña" class="login password-field" />
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					
				</span>									
				<button class="button btn btn-warning btn-large">Entrar</button>
				
			</div> <!-- .actions -->
		</form>
		 <?
                    // Mostrar error de Autentificación.
                    include ("includes/Mensaje_Error.inc.php");
                    if (isset($_GET['error_login'])) {
                        $error = $_GET['error_login'];
                        echo"<div class='error'>Error: $error_login_ms[$error]</div>";
                    }
                    ?>
	</div> <!-- /content -->
	
</div> <!-- /account-container -->
