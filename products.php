<?php
	 require_once('classes/Database.php');
	 require_once('classes/debug.php');  
     require_once('classes/Request.php');
     require_once('templates/header.php');
?>

<?php
	$req = New Request();
	$items = $req->get_all_products();
	
	print_r(array_values($items));
	//test code for dsiplaying database. Not Final

	
	//test code for dsiplaying database. Not Final



?>



<?php

	require_once('templates/footer.php');
?>
