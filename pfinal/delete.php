<?php
  // Get courseIDs
  $delete = $_POST['dependentID'];
 
  // Delete courseName from database
  require_once('database.php');
  $query = "DELETE FROM dependent
						WHERE dependentID = '$delete'
	";
  $db->exec($query);
 
  // Display index page
  include_once 'index.php';
?>
