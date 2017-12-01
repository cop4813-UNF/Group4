<?php
       require_once('Database.php');
       
       Class User extends Database {
      
        public function __construct(){                    		  
		      $this->get_user_data();	
		      parent::__construct();
	   	   if (session_status() !== PHP_SESSION_ACTIVE) {
     		      @session_start();
   		   }	   
   		   $this->create_user_table();	  
   		   $this->create_role_table();			       
		   $this->create_admin_user();	
		   $this->create_admin_role($this->username);	  		   		      
        }
	       
	      private function create_admin_user(){
	      	   $pw = $this->hash_password($this->password);	      	
	      		$conn = new mysqli("localhost", $this->username, $this->password, $this->dbname);
	             
	   	       $check= 'SELECT id FROM Users WHERE username = "' . $this->username . '" LIMIT 1';
		      	 $sql = 'INSERT INTO Users (id,  firstName,  lastName, email, username,
		      	 password) VALUES (NULL, NULL, NULL, NULL, "' . $this->username . '","' .  $pw . 

'")';	
		          $result = $conn->query($check);
		          		          
		          if ($result->num_rows == 0) {
		          	$sql = 'INSERT INTO Users (id,  firstName,  lastName, email, username,
		      	   password) VALUES (NULL, NULL, NULL, NULL, "' . $this->username . '","' .  $pw . 

'")';	         
		            $result = $conn->query($sql);
		          }
		    
			       $conn = null;        
         }
         private function create_admin_role($username) {   
	              $conn = new mysqli("localhost", $this->username, $this->password, $this->dbname);	     

        
	              $check= 'SELECT id FROM Users WHERE username = "' . $username . '" LIMIT 1';
	              $result = $conn->query($check);
	              if ($result->num_rows > 0) {
	                $rows = $result->fetch_array(MYSQLI_ASSOC);
	                $admin_id = $rows['id'];
	                
	                $role_exist = 'SELECT Users.id, Roles.role 
	                FROM  Users
	                INNER JOIN Roles 
	                ON Roles.user_id = Users.id
                   LIMIT 1 ';
	                $result = $conn->query($role_exist);
	               
	                if ($result->num_rows == 0) {
		      	      $sql = 'INSERT INTO Roles (id,  role, user_id) VALUES (NULL, "admin",' . 

$admin_id. ')'; 
				         $result = $conn->query($sql);
				       } 
				     }
			       $conn = null;        
         }
         public function create_customer($post_arr){
         	$this->add_user($post_arr);
         	$this->create_customer_role($post_arr['username']);
         	
         }
         
         private function create_customer_role($usr) {   
	           $conn = new mysqli("localhost", $this->username, $this->password, $this->dbname);	     

        
	           $check= 'SELECT id FROM Users WHERE username = "' . $usr . '" LIMIT 1';
	           $result = $conn->query($check);
	           if ($result->num_rows > 0) {
	                $rows = $result->fetch_array(MYSQLI_ASSOC);
	                $usr_id = $rows['id'];
	                
	                $role_exist = 'SELECT Users.id, Roles.role 
	                FROM  Users
	                INNER JOIN Roles 
	                ON Roles.user_id = Users.id
                        LIMIT 1 ';
	                $result = $conn->query($role_exist);
	               
	                if ($result->num_rows == 0) {
		      	      $sql = 'INSERT INTO Roles (id,  role, user_id) VALUES (NULL, "customer",' . 

$usr_id. ')'; 
				         $result = $conn->query($sql);
				       } 
				     }
			       $conn = null;        
         }
         
       private function create_user_table(){        	    
        	   	// sql to create table
		    	  $sql = "CREATE TABLE IF NOT EXISTS Users (
		    	    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    	    firstName VARCHAR(256),
		    	    lastName VARCHAR(256),
		    	    email VARCHAR(256),
			       username VARCHAR(256),
		    	    password VARCHAR(256) 
		        )";
		        $this->query_exec($sql);		             	
        }
        
        private function create_role_table(){     	    
        	   	// sql to create table
		    	  $sql = "CREATE TABLE IF NOT EXISTS Roles(
		    	    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    	    role VARCHAR(128) NOT NULL,
		    	    user_id INT(6) NOT NULL	    	   
		        )";
		        $this->query_exec($sql);		            	
        }
	       
	public function is_admin() {
             if(!empty(trim($_SESSION['username']))){
                if(trim($_SESSION['role']) == "admin" ){
                     return true;
                 } else {
                     return false;
                 }
             }
         }
	       
	 public function is_customer() {
             if(!empty(trim($_SESSION['username']))){
                if(trim($_SESSION['role']) == "customer" ){
                     return true;
                 } else {
                     return false;
                 }
             }
         }   
         
        
        
        private function get_stored_password($usr){
          $conn = new mysqli("localhost", $this->username, $this->password, $this->dbname);	             

          $pw = NULL;
	  $check= 'SELECT password FROM Users WHERE username = "' . $usr . '" LIMIT 1';
	  $result = $conn->query($check);
	  if ($result->num_rows > 0) {
             $rows = $result->fetch_array(MYSQLI_ASSOC);
	     $pw = $rows['password'];
           }
           return $pw;
        }
        
        private function hash_password($password){
           return password_hash($password, PASSWORD_DEFAULT);
        }
        
        private function is_password_valid($uid, $password) {    
          if(empty(trim($uid)) != TRUE){		
	     if(password_verify ($password, $this->get_stored_password($uid))) {
		 return true;
	      }
	   }
           return false;
	}

        private function get_user_role($usr){
             $conn = new mysqli("localhost", $this->username, $this->password, $this->dbname);
             $role = NULL;
                  
                         $sql = 'SELECT Users.id, Roles.role 
	                         FROM  
                                    Users
	                         INNER JOIN Roles 
	                            ON Roles.user_id = Users.id
                                 WHERE  
                                    Users.id ="' . $usr . '"';
          
               $result = $conn->query($sql);
	        if ($result->num_rows > 0) {
                     $rows = $result->fetch_array(MYSQLI_ASSOC);
                     $role = $rows['role'];
                 }
                 return $role;

           }  


        public function log_in($usr, $pw) {
           $_SESSION['username']= NULL;
           $_SESSION['role']= NULL;	
           if($this->is_password_valid($usr, $pw)){  
              $_SESSION['username']=$usr;  
              $_SESSION['role']=$this->get_user_role($usr);
	      return true;
           }		     
           return false;
        }
        
		public function get_user_id(){
			if(isset($_SESSION['username'])) {
				return $_SESSION['username'];
			} else {
			  return false;
			}
		}
		public function log_out() {
			$_SESSION['username']=NULL;
			
		}
		
         
          
          
        private function validate_email($email){
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
               echo "This email address is considered valid.\n";
            } else{
               echo "This email address is considered INVALID.\n";            
            }        
        }
        
        private function add_user($arr){
         try {
             $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", 
             $this->username, $this->password);
    	       // set the PDO error mode to exception
   	       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			
    	
			    // prepare sql and bind parameters
			    $stmt = $conn->prepare("INSERT INTO Users (firstName, lastName, email, username, 

password)
			    VALUES (:firstName, :lastName, :email, :username, :password)");			
			    $stmt->bindParam(':firstName', $firstName);
			    $stmt->bindParam(':lastName', $lastName);
			    $stmt->bindParam(':email', $email);
		       $stmt->bindParam(':username', $username);
			    $stmt->bindParam(':password', $password);			    
			
			    // insert a row
			    $firstName = $this->filter_input($arr['firstName']);
			    $lastName = $this->filter_input($arr['lastName']);
			    $email = $this->filter_input($arr['email']);
		       $username = $this->filter_input($arr['username']);
			    $password = $this->filter_input($arr['password']);		     
			    $password = $this->hash_password($password);
			    $stmt->execute();
			    
			    echo "New record created successfully";
			}
			catch(PDOException $e) {
			   echo "Error: " . $e->getMessage();
			}
			  $conn = null;        
        }
               
     }
       
   
?>
