<?php
  // Get data
	$id = $_POST['ID'];
  $customer = $_POST['customer'];
  $branch = $_POST['branch'];
  $itemNo = $_POST['ItemNo'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
	// Counter for the loop
	$countq = count(array_filter($quantity));
	$counti = count($itemNo);
	$i = 0;
  // Validate inputs
  if ( empty($id) || empty($branch) || empty($customer) || $countq<=0 ) {
    $error = "Invalid data. Check fields and try again.";
    include('error.php');
  } else {
    // If valid, add data to table "orders"
    require_once('database.php');
    $query = "INSERT INTO orders (OrderID, CustomerID, BranchNo, OrderDate)
							VALUES ($id, $customer, $branch, NOW() )
		";
    $db->exec($query);
		
    // If valid, add data to table "orderitems"
		$sql = "INSERT INTO orderitems (OrderID, ItemNo, Quantity, Price) 
						VALUES (:id, :itemNo, :quantity, :price)
		";
		$insert = $db->prepare($sql);

		while ($i < $counti) {
			if(!empty($quantity[$i])) {
			$insert->bindParam(':id', $id);
			$insert->bindParam(':itemNo', $itemNo[$i]);
			$insert->bindParam(':quantity', $quantity[$i]);
			$insert->bindParam(':price', $price[$i]);
			$insert->execute();
			}
			$i++;
		}
    // Close connection
		$insert->closeCursor();
 
    // Display index page
    include('index.php');
  }
?>
