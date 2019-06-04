<?php	
	session_start();
	if (!isset($_SESSION['user_login_status'])  ) {
		    if (!isset($_SESSION['cliente_login_status'])){
					header("location: ../login.php");
					exit;
				}
        
    }