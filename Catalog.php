<?php
       require_once('Database.php');
       
       Class Catalog extends Database {
       


             public function __construct(){                    		  
		    	
		   parent::__construct();
	   	   if (session_status() !== PHP_SESSION_ACTIVE) {
     		      @session_start();
   		   }	
   
   		   $this->create_product_table();	  
   		   $this->create_category_table(); 
   		  
             }

             private function create_product_table() {

                  return;
             }

             private function create_category_table() {

                  return;
             }

       }


?>
