<?php
	// Variables
	$stitle = 'Brandon Nguyen - CTS2857C';
	$header = 'CTS2857C - Final Exam';
	$ptitle = 'List of Dependent';
	$footer = '2016 &copy; Brandon Nguyen';
	// Require files
	require_once 'database.php'; 
	// Header
	include_once 'header.php';
  // Get IDs
  $search = $_POST['employeeID'];
	$search = trim($search);
	// Get items
	if($search == 'All') {
		$query = "SELECT * FROM employee, dependent
							WHERE employee.employeeID = dependent.employeeID
							ORDER BY employee.employeeID ASC,
											dependent.dependentID ASC
		";
	} else {
		$query = "SELECT * FROM employee, dependent
							WHERE employee.employeeID = dependent.employeeID
							AND employee.employeeID = $search;
		";
	}
	$items = $db->query($query);
	$current = '';
	
	echo 'Report for Dependent of Employee ID: '.$search;
?>
	<br><br>
	<!-- Display report table -->
	<table>
		<tr>
			<th class="smalcol">Employee ID</th>
			<th class="smalcol">Dependent ID</th>
			<th class="smalcol">First Name</th>
			<th class="smalcol">Last Name</th>
			<th class="smalcol">Picture</th>
		</tr>
		<?php foreach ($items as $item) : ?>
			<tr>
				<?php $new = $item['employeeID']; if($current != $new) { ?>
				<td><?php echo $item['employeeID']; ?></td>
				<?php $current = $new;  } else {  ?> <td></td> <?php } ?>
				<td><?php echo $item['dependentID']; ?></td>
				<td><?php echo $item['FirstName']; ?></td>
				<td><?php echo $item['LastName']; ?></td>
				<td><img src="<?php echo $item['Picture']; ?>" alt="<?php echo $item['Picture']; ?>"></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<br>
	<p><a href="index.php" id="home">HOME</a></p>
<?php
	// Footer
	require_once 'footer.php';
?>
