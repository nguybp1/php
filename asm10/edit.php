<?php
  // Get data
  $id = $_POST['id'];
  $invoiceNumber = $_POST['invoiceNumber'];
  $customerName = $_POST['customerName'];
  $item = $_POST['item'];
  $description = $_POST['description'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price']; 
	$count = count($item);
	
  // Validate inputs
  if (empty($customerName) || empty($item) || empty($description) || empty($quantity) || empty($price) ) {
    $error = "Invalid data. Check fields and try again.";
    include('error.php');
  } else {
    // If valid, add data to table 1
    require_once('database.php');
    $query = "UPDATE invoiceheader
							SET customerName = '$customerName'
							WHERE invoiceNumber = $invoiceNumber
		";
    $db->exec($query);
    // If valid, add data to table 2
		$sql = "UPDATE invoicedetails 
						SET id = :id,
								invoiceNumber = :invoice,
								item = :item,
								description = :desc,
								quantity = :quant,
								price = :price
						WHERE id = :id
		";
		$update = $db->prepare($sql);

		for ($i=0;$i<$count;$i++) {
			$update->bindParam(':id', $id[$i]);
			$update->bindParam(':invoice', $invoiceNumber);
			$update->bindParam(':item', $item[$i]);
			$update->bindParam(':desc', $description[$i]);
			$update->bindParam(':quant', $quantity[$i]);
			$update->bindParam(':price', $price[$i]);
			$update->execute();
		}
		$update->closeCursor();

    // Display index page
    include('index.php');
  }
?>
