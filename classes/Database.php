<?php
		Class Database {		    
		   protected $servername = "localhost";
		   protected $username = "root";
		   protected $password = "zdrnko114";
		   protected $dbname = "group4";
		
		
		   protected function __construct() {		      
		      try {
		         $this->create_database();
		         $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, 
		         $this->password);
		         // set the PDO error mode to exception
		         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);          
		      }
		      catch(PDOException $e)
		      {
		        echo "Connection failed: " . $e->getMessage();
		      }
		
		      
		   }
		
		
		   /* mysqli method to create database */
		   private function create_database(){
		       // Create connection
		       $conn = new mysqli($this->servername, $this->username, $this->password);
		       // Check connection
		       if ($conn->connect_error) {
		          die("Connection failed: " . $conn->connect_error);
		       }
		
		       // Create database
		       $sql = "CREATE DATABASE IF NOT EXISTS " . $this->dbname;
		       if ($conn->query($sql) === FALSE) {
		          echo "Error creating database: " . $conn->error;
		       }
		
		       $conn->close();
		   }
		
		
		   /* 		   
		       performs queries where results are not expected and where 
		       parameter binding is not needed.
		   */
		
		   protected function query_exec($sql) {
		      try {   
		         $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, 
		         $this->password);
		          // set the PDO error mode to exception
		          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  		         
		          $conn->exec($sql);		         
		      }
		      catch(PDOException $e)
		      {
		        echo $sql . "<br>" . $e->getMessage();
		      }
		   }
		
		
		   protected function select_record($id) {
			
			try {
		    	 $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", 
                   $this->username, $this->password);
		    	  // set the PDO error mode to exception
		    	 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
                         // prepare sql
		    	  $sql = $conn->prepare("SELECT * FROM Movies WHERE film_id = :film_id");

                          // bind parameter                          
			  $sql->bindParam(':film_id', $this->filter_input($id));			  
		
		    	  // execute the query
		    	  $sql->execute();
		    	  
		   	}
			catch(PDOException $e)
		    	{
		    	  echo $sql . "<br>" . $e->getMessage();
		    	}
			$conn = null;
		
		   }
		
		   protected function select_all($table) {
			   try {
		    	   $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", 
                   $this->username, $this->password);
		    	  // set the PDO error mode to exception
		    	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		    	    $sql = "SELECT * FROM " . $table;
		          $stmt = $conn->prepare($sql);
		          $stmt->execute();
		          // set the resulting array to associative
		          $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
		          $arr = $stmt->fetchAll();
		          return $arr;
				}catch(PDOException $e){
		    	  echo $sql . "<br>" . $e->getMessage();
		    	}
			    $conn = null;
		   }
		
		 
		
		
		   protected function delete_record($table, $id_label, $id) {      		
			try {
		    	  $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", 
                   $this->username, $this->password);
		    	  // set the PDO error mode to exception
		    	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		      	// sql to delete a record
		      	$sql = "DELETE FROM " . $table . " WHERE " . $id_label . "=" . $id;
		    	  // use exec() because no results are returned
		    	  $conn->exec($sql);
		          echo "Record deleted successfully";
		    	 }
			 catch(PDOException $e)
		    	 {
		    	    echo $sql . "<br>" . $e->getMessage();
		    	 }
			 $conn = null;
		 }
		
		
        protected function update_record($arr, $film_id) {
           // Create connection
           $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

           // Check connection
           if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
           }
             $sql = "UPDATE Movies SET title=?, description=?, release_date=?, genre=?, film_length=?, 
             director=?, writer=?, star=?,costar=?,format=? WHERE film_id=?";
             // prepare and bind
             $stmt = $conn->prepare($sql);           
           
           
             /* strip out html tags */
             $title = $this->filter_input($arr['title']);
			    $description = $this->filter_input($arr['description']);
			    $release_date = $this->filter_input($arr['release_date']);
			    $genre = $this->filter_input($arr['genre']);
			    $film_length = $this->filter_input($arr['film_length']);
			    $director = $this->filter_input($arr['director']);
			    $writer = $this->filter_input($arr['writer']);
			    $star = $this->filter_input($arr['star']);
			    $costar = $this->filter_input($arr['costar']);
			    $format = $this->filter_input($arr['format']);
			    
			    /*bind parameters and their values by reference */
           	 $stmt->bind_param('ssssssssssd', $title, $description, $release_date, 
             $genre, $film_length, $director, $writer,$star, 
             $costar,$format,$film_id);
             
             /*execute the query */
             $stmt->execute();
             $stmt->close();
             $conn->close();                
        }		
		
		  public function close_db() {
		       $this->conn = null;   
		
		  }

          /* remove all html tags and values behind them */
          protected function filter_input($str) {
             return filter_var($str, FILTER_SANITIZE_STRING);
          }
    }  
?>
