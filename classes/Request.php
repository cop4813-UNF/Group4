
<?php
        require_once('User.php');
	
	Class Request {
		
	   public function __construct() {		
	   	if (session_status() !== PHP_SESSION_ACTIVE) {
     		  @session_start();
   		}
	   	$usr = New User();
	        	      
	   }
	
           public function admin_action() {
  $admin = 1;

  return $admin;
}



public function customer_action() {
   $customer = 1;

   return $customer;
}
		
		
	   public function request_register_page(){
            header("Location: ../register.php");
      }
        
		
     public function request_register_user($arr) {
		 $usr->register_user($arr);		  
	  }
		
     public function request_login($username, $password ){
	       
	  }
	
    }

?>
