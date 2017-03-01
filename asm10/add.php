<?php
  // Get data
  $invoiceNumber = $_POST['invoiceNumber'];
  $customerName = $_POST['customerName'];
  $item = $_POST['item'];
  $description = $_POST['description'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
	$id = NULL;
 
  // Validate inputs
  if (empty($customerName) || empty($item) || empty($description) || empty($quantity) || empty($price) ) {
    $error = "Invalid data. Check fields and try again.";
    include('error.php');
  } else {
    // If valid, add data to table 1
    require_once('database.php');
    $query = "INSERT INTO invoiceheader (invoiceNumber, customerName)
							VALUES ($invoiceNumber, '$customerName')
		";
    $db->exec($query);
    // If valid, add data to table 2
		$sql = 'INSERT INTO invoicedetails (id, invoiceNumber, item, description, quantity, price) 
						VALUES (:id, :invoice, :item, :desc, :quant, :price)';
		$insert = $db->prepare($sql);

    // Counter for the loop
		$count = count(array_filter($item));
		$i = 0;

		while ($i < $count) {
			$insert->bindParam(':id', $id);
			$insert->bindParam(':invoice', $invoiceNumber);
			$insert->bindParam(':item', $item[$i]);
			$insert->bindParam(':desc', $description[$i]);
			$insert->bindParam(':quant', $quantity[$i]);
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
