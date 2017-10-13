<?php
 
 
class Database
{
    private static $db;  
    
    DB_NAME = "database";
    DB_HOST = "localhost";
    DB_USER = "username";
    DB_PASS = "password";
    $conn = null; 

    public static function init() {
       if(!connect_to_db(DB_NAME))
         create_database(DB_NAME);     
    }
            
    public static function connect_to_db($dbname)
    {
        if (!$this->conn)
        {
            try {
    		$this->conn = new PDO("mysql:host=DB_HOST;dbname=$dbname", $username, $password);
    		// set the PDO error mode to exception
   	        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected successfully";
                return true;
            }
            catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();
                return false;
            }
         }          
    }

    public function close_db() {
       mysqli_close($this->conn); 
    }

    public function create_database($dbname) {         
	// Check connection
    	if ($this->conn->connect_error) {
    	   die("Connection failed: " . $conn->connect_error);
        }

        // Create database
	$sql = "CREATE DATABASE DB_NAME";
	if ($this->conn->query($sql) === TRUE) {
    	   echo "Database created successfully";
	} else {
    	   echo "Error creating database: " . $conn->error;
	}
	$this->conn->close();
    }


}

?>
