<?php
  // Get data
//	$id = NULL;
  $branchNo = $_POST['branchNo'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zip = $_POST['zip'];
 
  // Validate inputs
  if ( empty($branchNo) || empty($address) || empty($city) || empty($state) || empty($zip) ) {
    $error = "Invalid data. Check fields and try again.";
    include('error.php');
  } else {
    // If valid, add data to table "branch"
    require_once('database.php');
    $branch = "INSERT INTO branch (BranchNo, Address, City, State, Zip)
							VALUES ($branchNo, '$address', '$city', '$state', $zip)
		";
    $db->exec($branch);
    // Display index page
    include('index.php');
  }
?>
