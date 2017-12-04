<?php
	 require_once('classes/Database.php');
	 require_once('classes/debug.php');  
     require_once('classes/Request.php');
     require_once('templates/header.php');
?>

<?php
	$req = New Request();
	$items = $req->get_all_products();
	
	$itemChunks = array_chunk($items,3);
	
	foreach($itemChunks as $chunk)
	{
		echo '<div class="row">';
			foreach($chunk as $product)
			{
				
				echo '<div class="col-sm-4">';
				echo '<div class="panel panel-primary">';
				echo '<div class="panel-heading">' .$product['item_name']. '</div>';
				echo '<div class="panel-body"> <img src="' .$product['image_link']. '" class="img-responsive" style="width:350px;height:250px;" alt="Image"></div>';
				echo '<div class="panel-body">' .$product['item_description']. '</div>';
				echo '<div class="panel-footer">' .$product['price'].'</div>';
				echo '<div class ="panel-footer"> <input type="hidden" name="'.$product['item_name'].'" value="'.$product['item_name'].'"></div>'; 
				echo '</div></div>';
			}
		echo '</div></div></div></br>';
	}
?>



<?php

	require_once('templates/footer.php');
?>
