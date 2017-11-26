 
     <?php	 
         require_once('classes/debug.php');  
         require_once('classes/Request.php');
         require_once('templates/header.php');
      ?>



     <!-- Enter page content here -->

     <div class="container" >
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
						      Username:</td><td> <input type="text" name="username"> 
						</td></tr>
						
						
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
			   $req = New Request();
			   if ( isset( $_POST['submit']) ) { 		     
			     
			      if(strcmp($_POST['password'],$_POST['password2'])!=0){
			         echo "passwords do not match";	
			      }else{
				      
				   
			      	  // add in register code here 
				  //$req->register_user($_POST);
				   
			      	 
			      }
			   }
			 ?>
		  </div>
     </div>
     <?php	           
         require_once('templates/footer.php');
     ?>


