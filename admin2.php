 
     <?php	 
         require_once('classes/debug.php');  
         require_once('classes/Request.php');
         require_once('templates/header.php');
         $req = New Request();
         $req->admin_action();
         print_r($req->get_all_products());
      ?>



     <!-- Enter page content here -->

     <div class="container" >
     
     </div>
     <?php	           
         require_once('templates/footer.php');
     ?>


