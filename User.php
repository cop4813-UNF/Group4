<?php

       require_once('Database.php');
       
       Class User extends Database {
       /* hashed password used for this app, includes salt */
       // private $pw_hash = '$2y$10$n2X/GQh1rJgd88Uc2NTT3Oc.jjCZp0kWnOUlM1KA0EiKC3cYJy3gG';


       
       
       /* user entered password */
        private $pw;

       /* user entered user id */
        private $uid;  

        /* users array for storing external user file data */
        private $stored_users = array();

        public function __construct(){                    		  
		      $this->get_user_data();	
		      parent::__construct();
	   	   if (session_status() !== PHP_SESSION_ACTIVE) {
     		      @session_start();
   		   }	   
   		   $this->create_user_table();	  
   		   $this->create_role_table();	
		   $this->create_user_role_table();
   		  
        }

        public function register_user($arr) {
	   $this->add_user($arr);	
		
		
	}
        private function create_user_table(){        	    
        	   	// sql to create table
		    	  $sql = "CREATE TABLE IF NOT EXISTS Users (
		    	    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    	    firstName VARCHAR(256) NOT NULL,
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
		    	    role VARCHAR(128) NOT NULL			    	   
		        )";
		        $this->query_exec($sql);		            	
        }
	       
	private function create_user_role_table(){     	    
        	   	// sql to create table
		    	  $sql = "CREATE TABLE IF NOT EXISTS User_Roles(
		    	    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		    	    user_id int(6),
                            role_id int(6),
                            FOREIGN KEY (user_id) REFERENCES Users(id),  
                            FOREIGN KEY (role_id) REFERENCES Roles(id))";  
			    	   
		        )";
		        $this->query_exec($sql);		            	
        }
        
        
       
        
        private function hash_password($password){
           return password_hash($password, PASSWORD_DEFAULT);
        }
        
        private function is_password_valid($password) {    
           if(trim($this->uid) != false){		
			 if(password_verify ($password, $this->get_stored_password($this->uid))) {
				return true;
			 }
		   }
           return false;
	   }

        public function is_logged_in() {
           if($this->is_password_valid($this->pw)){  
              $_SESSION['user']=$this->uid;  
			     return true;
           }
		     $_SESSION['user']='guest';
           return false;
        }
        
		public function get_user_id(){
			if(isset($_SESSION['user'])) {
				return $_SESSION['user'];
			} else {
			  return false;
			}
		}
		public function log_out() {
			$_SESSION['user']=NULL;
			
		}
		
		
        public function display_user_name() {
           echo 'Welcome ' . $this->uid;
        }
        
        public function add_user_test($arr){
        	 // print_r($arr);
        	  if(empty($arr['firstName']) || empty($arr['lastName']))
               echo "First and Last Name is needed";      	  
        	  $this->validate_email($arr['email']);
        }
          
          
        private function validate_email($email){
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
               echo "This email address is considered valid.\n";
            } else{
               echo "This email address is considered INVALID.\n";            
            }        
        }
        public function add_user($arr){
         try {
             $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", 
             $this->username, $this->password);
    	       // set the PDO error mode to exception
   	       $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);			

    	
			    // prepare sql and bind parameters
			    $stmt = $conn->prepare("INSERT INTO Users (firstName, lastName, email, username, password)
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
               


         private function get_user_data() {            
          //  $ufile = new Datafile($this->file);
			//$arr = $ufile->get_file_data(); 
  
          //  foreach ($arr as $value) { 
//parse_str($value, $output);      
            //   $this->stored_users[$output['user']] = $output['password'];
           // }   
        }

     }
       


   
?>
