<?php
error_reporting(0);
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Disculpe, el sistema no puede iniciar sobre una version de PHP menor a 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("config/db.php");

// load the login class
require_once("classes/Login.php");
require_once("classes/LoginCliente.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();
$loginCliente = new LoginCliente();

// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are logged in" view.
   header("location: clientes.php");

}elseif($loginCliente->isUserLoggedInCliente() == true) 
	header("location: public/index.php");
else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    ?>
	<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Estudio contable</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- CSS  -->
   <!-- <link href="css/login2.css" type="text/css" rel="stylesheet" media="screen,projection"/> -->

   <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400" rel="stylesheet">

<!-- 
   <link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css"> -->

	<link href="css/login2.css" rel="stylesheet" type="text/css" />

</head>
<body  id="login" >




<div class="access">
			<div class="wrapper">
				<h1>Inicio de sesión</h1>
				<div class="wrapper2">
					<form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" >

						<input type="text" placeholder="Nombre de usuario" id="user_name" name="user_name"  value=""  />
						<input type="password" placeholder="Contraseña" id="user_password" name="user_password"  value=""  />
			
						<input type="submit" class="button submitButton" value="Ingresar"  name="login" id="submit" >
				
					
						
						<a class="serviceStatusRedirect" style="margin-top:50%;" name="serviceRedirect" href="http://www.control-app.com/"><i class="fa fa-copyright" aria-hidden="true"> &copy J.L. Vazquez - Control-App.com <?=date('Y')?></i></a>
								

					</form>
				
			</div>
			
		</div>
	</div>
	
	<div class="brand" style="background-image: url('img/fondo.jpeg')">
		<h3 style="color:#ffff"><b>OLIMPUS</b></h3>
	</div>










<!-- 
<div class="limiter" >
		<div class="container-login100">
			

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
				<form class="login100-form validate-form" method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" >
					<span class="login100-form-title p-b-59" style="font-family:sans-serif">
						<h1 style="color:#4f4da7;">Inicio de sesion</h1>
					</span> -->

					<?php
						// show potential errors / feedback (from login object)
						/*if (isset($login)) {
							if ($login->errors) {
								?>
								<div class="alert alert-danger alert-dismissible" role="alert">
									<strong>Error!</strong> 
								
								<?php 
								foreach ($login->errors as $error) {
									echo $error;
								}
								?>
								</div>
								<?php
							}
							if ($login->messages) {
								?>
								<!-- <div class="alert alert-success alert-dismissible" role="alert">
									<strong>Aviso!</strong> -->
								<?php
								foreach ($login->messages as $message) {
									//echo $message;
								}
								?>
								<!-- </div>  -->
								<?php 
							}
						}*/
						?>
					<!-- <div class="wrap-input100 validate-input" data-validate="Username is required">
						<span class="label-input100"></span>
						<input class="input100" type="text" style="font-family:sans-serif" name="user_name" placeholder="Nombre de usuario" required>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<span class="label-input100"></span>
						<input class="input100" type="text" style="font-family:sans-serif" name="user_password" placeholder="Contraseña" required>
						<span class="focus-input100"></span>
					</div>


					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn " name="login" id="submit" style="font-family:sans-serif">
								<h3>Ingresar</h3>
							</button>
						</div>
					</div>
				</form>
			</div>

			<div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>


		</div>
	</div>
	 -->


 <!-- <div class="container">
        <div class="card card-container">
		<h3 style="text-align:center; font-family:fantasy;"><i>Inicio de sesion</i></h3>
            <img id="profile-img" class="profile-img-card" src="img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form method="post" accept-charset="utf-8" action="login.php" name="loginform" autocomplete="off" role="form" class="form-signin"> -->
			<?php
			/*
				// show potential errors / feedback (from login object)
				if (isset($login)) {
					if ($login->errors) {
						?>
						<div class="alert alert-danger alert-dismissible" role="alert">
						    <strong>Error!</strong> 
						
						<?php 
						foreach ($login->errors as $error) {
							echo $error;
						}
						?>
						</div>
						<?php
					}
					if ($login->messages) {
						?>
						<!-- <div class="alert alert-success alert-dismissible" role="alert">
						    <strong>Aviso!</strong> -->
						<?php
						foreach ($login->messages as $message) {
							//echo $message;
						}
						?>
						<!-- </div>  -->
						<?php 
					}
				}*/
				?>
                <!-- <span id="reauth-email" class="reauth-email"></span>
                <input class="form-control" placeholder="Usuario" name="user_name" type="text" value="" autofocus="" required>
                <input class="form-control" placeholder="Contraseña" name="user_password" type="password" value="" autocomplete="off" required>
                <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" name="login" id="submit">Iniciar Sesión</button>
            </form>
            
        </div>
    </div> -->



  </body>
</html>

	<?php
}


