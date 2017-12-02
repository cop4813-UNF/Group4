<?php
       require_once('Database.php');
       
       Class Product extends Database {
       


      public function __construct(){                    		  
		    	
		   parent::__construct();
	   	   if (session_status() !== PHP_SESSION_ACTIVE) {
     		      @session_start();
   		   }	
   
   		   $this->create_product_table();	  
   		    
   		  
        }

        private function create_product_table(){        	    
        	   	// sql to create table
		    	  $sql = "CREATE TABLE IF NOT EXISTS Products (
		    	    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    	    item_name varchar(140) NOT NULL,
		    	    item_description varchar(256) NOT NULL,
		    	    price decimal(9,2) NOT NULL,
			       quantity int(16) NOT NULL,
                image_link varchar(256) DEFAULT NULL
		        )";  
		        $this->query_exec($sql);		             	
        }
        
        public function get_all_products(){
              $conn = new mysqli("localhost", $this->username, $this->password, $this->dbname);	             
              $sql= 'SELECT item_name, item_description, price, quantity, image_link FROM Products';
	           $result = $conn->query($sql);
	           if ($result->num_rows > 0) {
                  $rows = $result->fetch_array(MYSQLI_ASSOC);
	               return $rows;
              }
              print 'No products present in  the table';
              return NULL;
        }   
        
        public function select_products($category){
        	  $conn = new mysqli("localhost", $this->username, $this->password, $this->dbname);	             
              $sql= 'SELECT item_name, item_description, price, quantity, image_link FROM Products
              INNER JOIN Categories on Products.id = Categories.product_id where 
              Categories.category =' .$category;
	           $result = $conn->query($sql);
	           if ($result->num_rows > 0) {
                  $rows = $result->fetch_array(MYSQLI_ASSOC);
	               return $rows;
              }
              print 'No products found for that category';
              return NULL;
        	
        }     
        
        public function insert_product($arr){
            $conn = new mysqli("localhost", $this->username, $this->password, $this->dbname);	
	                
            $sql = 'INSERT INTO Products (item_name, item_description, price, quantity, image_link) 
            VALUES (?,?,?,?,?)'; 
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("ssdds", $item_name, $description,$price,$qty,$link);
              $item_name = $arr['item_name'];
              $description = $arr['item_description'];
              $price = $arr['price'];
              $qty = $arr['quantity'];
              $link = $arr['image_link'];
              $stmt->execute();				        
				  print '<div class ="success">Product added successfully</div>';
				  $conn = NULL;
			 }        
        
        

  }


?>
