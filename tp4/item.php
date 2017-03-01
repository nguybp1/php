<?php
  // Get data
  $itemNo = $_POST['itemNo'];
  $description = $_POST['description'];
  $price = $_POST['price'];
	$counti = count(array_filter($itemNo));
	$countd = count(array_filter($description));
	$countp = count(array_filter($price));
	$i = 0;
 
  // Validate inputs
  if ( $counti<=0 || $countd<=0 || $countp<=0 ) {
    $error = "Invalid data. Check fields and try again.";
    include('error.php');
  } else {
    // If valid, add data to table "items"
    require_once('database.php');
		$sql = 'INSERT INTO items (ItemNo, Description, Price) 
						VALUES (:itemNo, :desc, :price)';
		$insert = $db->prepare($sql);

		while ($i < $counti) {
			$insert->bindParam(':itemNo', $itemNo[$i]);
			$insert->bindParam(':desc', $description[$i]);
			$insert->bindParam(':price', $price[$i]);
			$insert->execute();
			$i++;
		}
    // Close connection
		$insert->closeCursor();
    // Display index page
    include('index.php');
  }
?>
