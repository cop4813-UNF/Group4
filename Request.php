
<?php
        require_once('User.php');
	
	Class Request {
		
	   public function __construct() {
		
	   	if (session_status() !== PHP_SESSION_ACTIVE) {
     		  @session_start();
   		}
	   	
	        	      
	   }
	
	   public function request_register_page(){
            header("Location: register.php");
           }
        
          public function request_login($username, $password ){
	     $usr = New User();  
	  }
	
    }

?>
