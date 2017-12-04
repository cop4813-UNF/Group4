 
     <?php	 
         require_once('classes/debug.php');  
         require_once('classes/Request.php');         
         require_once('templates/header.php');         
      ?>



 

     <div class="container" >        
       <h2>Login </h2>
       <form  method="post" style="width:40%;">
         <div class="imgcontainer">
           <img src="images/profile_icon.png" alt="Avatar" class="avatar" height="200" width="200">
         </div>

         <div class="container">
         <table>
           <tr>
           <td><label><b>Username</b></label></td><td>
           <input type="text" placeholder="Enter Username" name="username" required>
           </td>
           </tr>
           <tr>
           <td>
           <label><b>Password</b></label>
           </td><td>
           <input type="password" placeholder="Enter Password" name="password" required>
           </td></tr>
           <tr><td>
           <input type="submit" name = "submit" value="Login">
           <input type="checkbox" checked="checked"> Remember me</td>
           </tr></table>
         </div>

		<br>
         <div class="container" style="background-color:#f1f1f1">
           <button type="button" class="cancelbtn">Cancel</button>
		   <br>
           Don't have an account? <span class="psw"> <a href="register.php">Register</a></span>
         </div>
       </form>
     </div>
	 
     <?php	           
         //require_once('templates/footer.php');
         if ( isset( $_POST['submit']) ) { 		     
			    $req = New Request();
			    $req->request_login($_POST);			    
			}	
     ?>


