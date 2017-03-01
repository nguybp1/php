<?php
	// Variables
	$stitle = 'CTS2857C';
	$header = 'CTS2857C - Team Project 4';
	$ptitle = 'Add Item';
	$footer = '2016 &copy; Bravo Team';

	// Header
	include 'header.php';
	
	// Counter
	$counter = 10;
?>	
	<!-- Display Item form -->
	<form action="item.php" method="post" name="item" id="item">
		<!-- Display add items table -->
		<table>
			<tr>
				<th class="smalcol">Item No</th>
				<th class="bigcol">Description</th>
				<th class="smalcol">Price</th>
			</tr>
			<?php for ($i = 0; $i < $counter; $i++) { ?>
			<tr>
				<td><input type="text" size="4" maxlength="4" name="itemNo[]"></td>
				<td><input type="text" size="20" maxlength="30" name="description[]"></td>
				<td><input type="text" size="4" maxlength="4" name="price[]"></td>
			</tr>
			<?php } ?>
		</table>
		<br>
		<input type="submit" value="Add Items">
	</form>
	<p><a href="index.php" id="home">HOME</a></p>

<?php
	// Footer
	require 'footer.php';
?>
