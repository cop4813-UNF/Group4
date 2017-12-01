 
     <?php	 
         require_once('classes/debug.php');  
         require_once('classes/Request.php');
         require_once('templates/header.php');
      ?>



 

     <div class="container" >        
       <h2>Login </h2>
       <form  style="width:40%;" action="/action_page.php">
         <div class="imgcontainer">
           <img src="img_avatar2.png" alt="Avatar" class="avatar">
         </div>

         <div class="container">
           <label><b>Username</b></label>
           <input type="text" placeholder="Enter Username" name="uname" required>

           <label><b>Password</b></label>
           <input type="password" placeholder="Enter Password" name="psw" required>

           <button type="submit">Login</button>
           <input type="checkbox" checked="checked"> Remember me
         </div>

         <div class="container" style="background-color:#f1f1f1">
           <button type="button" class="cancelbtn">Cancel</button>
           <span class="psw"> <a href="#">Register</a></span>
         </div>
       </form>
     </div>
     <?php	           
         require_once('templates/footer.php');
     ?>


