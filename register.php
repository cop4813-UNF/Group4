<!DOCTYPE HTML>
<html>
  <head>
     <title>Osprey Emporium</title>	 
     <link rel="stylesheet" href="../css/style.css">
     <?php	 
       require_once('debug.php');    
	    require_once('User.php');	    
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
		    <h1> Please Enter Info: </h1><br>
			<table>
				<tr>
					<td>
					   First Name:</td><td> <input type="text" name="firstName"> 
					</td>
					<td>
					   Last Name:</td><td> <input type="text" name="lastName"> 
					</td>
				</tr>
				<tr>
					<td>
					   Email:</td><td> <input type="text" name="email"> 
					</td>
				</tr>
				<tr><td>
				      Password:</td><td> <input type="password" name="password"> 
				</td></tr>
				<tr><td>
				      Verify Password:</td><td> <input type="password" name="password2"> 
				</td></tr>
				<tr><td>
				<input type="submit" name = "submit" value="Save">
				</td></tr>
				<tr><td>
				 
				</td></tr>
			</table>
		</form>
		 <?php
		   
		   if ( isset( $_POST['submit']) ) { 		     
		     
		      if(strcmp($_POST['password'],$_POST['password2'])!=0){
		         echo "passwords do not match";	
		      }else{
		      	 $usr = New User();
		      	 $usr->add_user_test($_POST);
		      }
		   }
		 ?>
	  </div>
  </body>  
</html>




