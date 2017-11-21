
<?php
    require_once('Database.php');
	
	Class Request {
		
	   public function __construct() {
		
	   	if (session_status() !== PHP_SESSION_ACTIVE) {
     		  @session_start();
   		}
	   	
	        	      
	   }
	
	   public function request_register_page(){
            header("Location: register.php");
      }
        

	
	}

?>