<!DOCTYPE HTML>
<html>
  <head>
     <title>Osprey Emporium</title>	 
     <link rel="stylesheet" href="../css/style.css">
     <?php	 
        require_once('debug.php');  
        require_once('Request.php');
     ?>
	 
	 <style>
	   table{
		   margin-left: auto;
           margin-right: auto;
       }
	   #error {
		 color: red;
		 background-color:white;
		 width:25%;
		 margin-left: auto;
         margin-right: auto;
	   }  
	 </style>
  </head>
 
 
  <body>
      
     <div class="wrapper">            
     	<form method="post">
		    <h1> Please Login: </h1><br>
			<table>
				<tr><td>
				Username:</td><td> <input type="text" name="username"> 
				</td></tr>
				<tr><td>
				Password:</td><td> <input type="password" name="password"> 
				</td></tr>
				<tr><td>
				<input type="submit" name = "submit" value="Login">
				</td>
				<td>
				 
             <input type="submit" name = "register" value="Register"> 
             
				</td></tr>
			</table>
		</form>
		 <?php
		   $req = New Request(); 
		   if ( isset( $_POST['register']) ) {		   	
		   	$req->request_register_page();
		   }
		   
		   if ( isset( $_POST['submit']) ) { 
		       $req->request_login($_POST['username'],$_POST['password'] );
		   }
		 ?>
	  </div>
  </body>  
</html>




