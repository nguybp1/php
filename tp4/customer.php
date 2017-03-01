<?php
  // Get data
  $customerID = $_POST['customerID'];
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
 
  // Validate inputs
  if ( empty($customerID) || empty($name) || empty($phone) || empty($email) ) {
    $error = "Invalid data. Check fields and try again.";
    include('error.php');
  } else {
    // If valid, add data to table "customer"
    require_once('database.php');
    $customer = "INSERT INTO customer (CustomerID, Name, Phone, Email)
								VALUES ($customerID, '$name', '$phone', '$email')
		";
    $db->exec($customer);
    // Display index page
    include('index.php');
  }
?>
