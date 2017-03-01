<?php
  // Get IDs
  $delete = $_POST['invoiceNumber'];
 
  // Delete item from database
  require_once('database.php');
  $query = "DELETE FROM invoiceheader
						WHERE invoiceNumber = '$delete'
	";
  $db->exec($query);
 
  // Display index page
  include('index.php');
?>
