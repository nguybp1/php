<?php
	// Variables
	$stitle = 'Brandon Nguyen - CTS2857C';
	$header = 'CTS2857C - Assignment 10';
	$ptitle = 'Invoice List';
	$footer = '2016 &copy; Brandon Nguyen';
	// Require files
	require_once 'database.php'; 
	// Get items
	$query = "SELECT * FROM invoiceheader, invoicedetails
						WHERE invoiceheader.invoiceNumber = invoicedetails.invoiceNumber;
	";
	$query = trim($query);
	$items = $db->query($query);
	// Header
	include 'header.php';
?>
	<!-- Display table of items -->
	<table>
		<tr>
			<th class="smalcol">Invoice</th>
			<th class="medcol">Customer Name</th>
			<th class="bigcol">Item</th>
			<th class="bigcol">Description</th>
			<th class="smalcol">Quantity</th>
			<th class="smalcol">Price</th>
		</tr>
		<?php foreach ($items as $item) : ?>
		<tr>
			<td class="right"><?php echo $item['invoiceNumber']; ?></td>
			<td><?php echo $item['customerName']; ?></td>
			<td><?php echo $item['item']; ?></td>
			<td><?php echo $item['description']; ?></td>
			<td class="right"><?php echo $item['quantity']; ?></td>
			<td class="right"><?php echo '$'.$item['price']; ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<br>
	<!-- Display search form -->
	<form action="search.php" method="post" name="search" id="search">
		<input type="text" name="invoiceNumber">
		<input type="submit" value="Search Invoice">
	</form>
<?php
	// Footer
	require 'footer.php';
?>
