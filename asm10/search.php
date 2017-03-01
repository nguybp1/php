<?php
	// Variables
	$stitle = 'Brandon Nguyen - CTS2857C';
	$header = 'CTS2857C - Assignment 10';
	$ptitle = 'Search Result';
	$footer = '2016 &copy; Brandon Nguyen';
	// Require files
	require_once 'database.php'; 
  // Get IDs
  $search = $_POST['invoiceNumber'];
	$search = trim($search);
	// Get items
	$query = "SELECT * FROM invoiceheader, invoicedetails
						WHERE invoiceheader.invoiceNumber = $search
						AND invoiceheader.invoiceNumber = invoicedetails.invoiceNumber;
	";
	$edits = $db->query($query);
	$items = $db->query($query);
	$row_count = $items->rowCount();
	$row = 0;
	// Header
	include 'header.php';
	if($row_count <= 0) {
		echo "Result not found. Do you want to add this invoice $search?";
		echo "<br>\n";
?>
	<br>
	<!-- Display add form -->
	<form action="add.php" method="post" name="add" id="add">
		<!-- Display add table -->
		<table>
			<tr>
				<th class="smalcol">Invoice</th>
				<th class="medcol">Customer Name</th>
				<th class="bigcol">Item</th>
				<th class="bigcol">Description</th>
				<th class="smalcol">Quantity</th>
				<th class="smalcol">Price</th>
			</tr>
			<tr>
				<td><input type="hidden" name="invoiceNumber" value="<?php echo $search; ?>"><?php echo $search; ?></td>
				<td><input type="text" size="20" maxlength="30" name="customerName"></td>
				<td><input type="text" size="20" maxlength="30" name="item[]"></td>
				<td><input type="text" size="20" maxlength="30" name="description[]"></td>
				<td><input type="text" size="4" maxlength="4" name="quantity[]"></td>
				<td><input type="text" size="4" maxlength="4" name="price[]"></td>
			</tr>
			<?php for ($i = 0; $i < 3; $i++) { ?>
			<tr>
				<td></td>
				<td></td>
				<td><input type="text" size="20" maxlength="30" name="item[]"></td>
				<td><input type="text" size="20" maxlength="30" name="description[]"></td>
				<td><input type="text" size="4" maxlength="4" name="quantity[]"></td>
				<td><input type="text" size="4" maxlength="4" name="price[]"></td>
			</tr>
			<?php } ?>
		</table>
		<br>
		<input type="submit" value="Add Invoice">
	</form>
<?php
	} else {
?>
	<!-- Display search result -->
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
	<!-- Display delete form -->
	<form action="delete.php" method="post" name="delete" id="delete">
		<input type="hidden" name="invoiceNumber" value="<?php echo $search; ?>">
		<input type="submit" value="Delete Invoice">
	</form>
	<br>
	<!-- Display edit form -->
	<form action="edit.php" method="post" name="edit" id="edit">
		<!-- Display edit table -->
		<table>
			<tr>
				<th class="smalcol">Invoice</th>
				<th class="medcol">Customer Name</th>
				<th class="bigcol">Item</th>
				<th class="bigcol">Description</th>
				<th class="smalcol">Quantity</th>
				<th class="smalcol">Price</th>
			</tr>
			<?php foreach ($edits as $edit) : ?>
				<tr>
					<?php if($row==0) { ?>
						<td class="right">
							<input type="hidden" name="invoiceNumber" value="<?php echo $edit['invoiceNumber']; ?>"><?php echo $edit['invoiceNumber']; ?>
						</td>
						<td><input type="text" size="20" maxlength="30" name="customerName" value="<?php echo $edit['customerName']; ?>"></td>
					<?php $row++; } else {  ?> <td></td><td></td> <?php } ?>
					<td>
						<input type="hidden" name="id[]" value="<?php echo $edit['id']; ?>">
						<input type="text" size="20" maxlength="30" name="item[]" value="<?php echo $edit['item']; ?>">
					</td>
					<td><input type="text" size="20" maxlength="30" name="description[]" value="<?php echo $edit['description']; ?>"></td>
					<td class="right"><input type="text" size="4" maxlength="4" name="quantity[]" value="<?php echo $edit['quantity']; ?>"></td>
					<td class="right"><input type="text" size="4" maxlength="4" name="price[]" value="<?php echo $edit['price']; ?>"></td>			
				</tr>
			<?php endforeach; ?>
		</table>
		<br>
		<input type="submit" value="Edit Invoice">
	</form>
<?php
	}
	// Footer
	require 'footer.php';
?>
