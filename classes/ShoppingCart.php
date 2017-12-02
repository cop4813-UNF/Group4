<?php
       require_once('Database.php');
       
       Class ShoppingCart  {
       


       public function __construct(){                    		  
		    	
		      parent::__construct();
	   	   if (session_status() !== PHP_SESSION_ACTIVE) {
     		      @session_start();
   		   }	
   		   $this->create_shopping_cart();
   		}   
   	
   		   private function create_shopping_cart(){
   		      if(!isset($_SESSION['cart']){ 
                   $_SESSION['cart']=NULL;
               }
   		   }
   
            public function add_to_cart($post_array){
                 $_SESSION['cart'][$post_array['item_name']]=$post_array;     
            }
          
             public function remove_from_cart($item_name){
                unset($_SESSION['cart']['item_name']);     
            }
            
            public function view_cart(){
               return $_SESSION['cart'];
            }
}

?>
