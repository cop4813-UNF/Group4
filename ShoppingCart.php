<?php
       require_once('Database.php');
       
       Class ShoppingCart extends Database {
       


             public function __construct(){                    		  
		    	
		   parent::__construct();
	   	   if (session_status() !== PHP_SESSION_ACTIVE) {
     		      @session_start();
   		   }	
   
   		   $this->create_sc_table();	  
   		    
   		  
             }

             private function create_sc_table() {

                  return;
             }

       }


?>
