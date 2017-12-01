    <?php	 
         require_once('classes/debug.php');  
         require_once('classes/Request.php');
         require_once('templates/header.php');
      ?>



 

     <div class="container" >        
         <h1>You are not permitted to perform this action</h1>

         <p class="error"> You do not possess the authorization
         to process this administrator request</p>
             
     </div>
     <?php	           
         require_once('templates/footer.php');
     ?>
