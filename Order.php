<?php
       require_once('Database.php');
       
       Class Order extends Database {
       


             public function __construct(){                    		  
		    	
		   parent::__construct();
	   	   if (session_status() !== PHP_SESSION_ACTIVE) {
     		      @session_start();
   		   }	
   
   		   $this->create_order_table();	  
   		    
   		  
             }

             private function create_order_table() {

                  return;
             }

             

       }


?>
