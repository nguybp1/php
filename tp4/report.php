<?php
	// Variables
	$stitle = 'CTS2857C';
	$header = 'CTS2857C - Team Project 4';
	$ptitle = 'Order Report';
	$footer = '2016 &copy; Bravo Team';
	// Require files
	require_once 'database.php'; 
  // Get IDs
  $search = $_POST['orderID'];
	$search = trim($search);
	// Get items
	if($search == 'All') {
		$query = "SELECT * FROM items, orders, orderitems
							WHERE items.ItemNo = orderitems.ItemNo
							AND orders.OrderID = orderitems.OrderID
							ORDER BY orders.OrderID ASC
		";
	} else {
		$query = "SELECT * FROM items, orders, orderitems
							WHERE items.ItemNo = orderitems.ItemNo
							AND orders.OrderID = orderitems.OrderID
							AND orders.OrderID = $search;
		";
	}
	$items = $db->query($query);
	$current = '';
	// Header
	include 'header.php';
	
	echo 'Report for Order ID: '.$search;
?>
	<br><br>
	<!-- Display report table -->
	<table>
		<tr>
			<th class="smalcol">Order ID</th>
			<th class="smalcol">From Branch</th>
			<th class="smalcol">From Customer</th>
			<th class="medcol">Date</th>
			<th class="smalcol">Item No</th>
			<th class="bigcol">Description</th>
			<th class="smalcol">Quantity</th>
			<th class="smalcol">Price</th>
		</tr>
		<?php foreach ($items as $item) : ?>
			<tr>
				<?php $new = $item['OrderID']; if($current != $new) { ?>
				<td class="right"><?php echo $item['OrderID']; ?></td>
				<td><?php echo $item['BranchNo']; ?></td>
				<td><?php echo $item['CustomerID']; ?></td>
				<td><?php $date=strtotime($item['OrderDate']); echo date('m/d/Y',$date); ?></td>
				<?php $current = $new;  } else {  ?> <td></td><td></td><td></td><td></td> <?php } ?>
				<td><?php echo $item['ItemNo']; ?></td>
				<td><?php echo $item['Description']; ?></td>
				<td class="right"><?php echo $item['Quantity']; ?></td>
				<td class="right"><?php echo '$'.$item['Price']; ?></td>			
			</tr>
		<?php endforeach; ?>
	</table>
	<br>
	<p><a href="index.php" id="home">HOME</a></p>
<?php
	// Footer
	require 'footer.php';
?>
