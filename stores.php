 
     <?php	 
         require_once('classes/debug.php');  
         require_once('classes/Request.php');
         require_once('templates/header.php');
      ?>



     <!-- Enter page content here -->

	 
	 <div class="container">  
		<h2> Store Locations: </h2>
		<br>
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">Jacksonville, FL</div>
        <div class="panel-body"><img src="https://visit-jax.s3.amazonaws.com/37415/jacksonville-skyline(1920x900)__large.jpg" class="img-responsive" style="width:350px;height:250px;" alt="Image"></div>
		<div class="panel-body">1 UNF Dr</div>
        <div class="panel-footer">Jacksonville, FL 32224</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-danger">
        <div class="panel-heading">New York City, New York</div>
        <div class="panel-body"><img src="https://www.city-journal.org/sites/cj/files/New-York.jpg" class="img-responsive" style="width:350px;height:250px;" alt="Image"></div>
        <div class="panel-body">Central Park West & 79th St</div>
        <div class="panel-footer">New York, NY 10024</div>
      </div>
    </div>
    <div class="col-sm-4"> 
      <div class="panel panel-success">
        <div class="panel-heading">Washington, D.C.</div>
        <div class="panel-body"><img src="http://www.smwllc.com/wp-content/uploads/2016/04/Washington-DC-header-image-locations-page.jpg" class="img-responsive" style="width:350px;height:250px;" alt="Image"></div>
        <div class="panel-body">1600 Pennsylvania Ave NW</div>
        <div class="panel-footer">Washington, DC 20500</div>
      </div>
    </div>
  </div>
</div><br>

     <?php	           
         require_once('templates/footer.php');
     ?>


