<?php
  // Get data
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
 
  // Validate inputs
  if ( empty($fname) || empty($lname) ) {
    $error = "Invalid data. Check fields and try again.";
    include_once 'error.php';
  } else {
    // If valid, add data to table
    require_once 'database.php';
    $employee = "INSERT INTO employee ( FirstName, LastName )
							VALUES ( '$fname', '$lname' )
		";
    $db->exec($employee);
    // Display index page
    include_once 'index.php';
  }
?>
