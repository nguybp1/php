<?php
	// Variables
	$stitle = 'CTS2857C';
	$header = 'CTS2857C - Team Project 4';
	$ptitle = 'Home Page';
	$footer = '2016 &copy; Bravo Team';
	$oid = '';
	// Require files
	require_once 'database.php'; 
	// Get all fields
	$query = "SELECT * FROM orders";
	$ids = $db->query($query);

	// Select if match
	function IsSelected($name,$value) {
		if(isset($name) && $name==$value) {
			echo 'selected';
		};
  };

	// Header
	include 'header.php';
?>

	<p><a href="addBranch.php" id="branch">Add Branch</a></p>
	<p><a href="addCustomer.php" id="customer">Add Customer</a></p>
	<p><a href="addItem.php" id="item">Add Items</a></p>
	<p><a href="addOrder.php" id="order">Place Order</a></p>
	<!-- List Order ID -->
	<form action="report.php" method="post" name="report" id="report">
		<select name="orderID">
			<option value="All">All</option>
				<?php foreach ($ids as $id) : ?>
					<option value="<?php echo $id['OrderID']; ?>" <?php IsSelected($oid,'<?php echo $id[\'OrderID\']; ?>');?>><?php echo $id['OrderID']; ?></option>
				<?php endforeach; ?>
		</select><br>
		<input type="submit" value="List Report">
	</form>
	
<?php
	// Footer
	require 'footer.php';
?>
