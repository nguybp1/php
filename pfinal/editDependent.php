<?php
	// Variables
	$stitle = 'Brandon Nguyen - CTS2857C';
	$header = 'CTS2857C - Final Exam';
	$ptitle = 'Edit Dependent';
	$footer = '2016 &copy; Brandon Nguyen';

	// Require files
	require_once 'database.php'; 
	// Header
	include_once 'header.php';
	
  // Get IDs
		$search = trim($_POST['employeeID']);
	// Get items
	if($search == '') {
    $error = "Invalid data. Check fields and try again.";
    include_once 'error.php';
	} else {
		$query = "SELECT * FROM dependent
							WHERE employeeID = $search;
		";
	$results = $db->query($query);
	$edits = $db->query($query);
	$currentd = $currente = '';
	echo 'Delete Dependent for Employee ID: '.$search;
?>
	<br>
	<!-- Display delete form -->
	<form action="delete.php" method="post" name="delete" id="delete">
	<table>
		<tr>
			<th class="smalcol">Employee ID</th>
			<th class="smalcol">Dependent ID</th>
			<th class="smalcol">First Name</th>
			<th class="smalcol">Last Name</th>
			<th class="smalcol">Picture</th>
			<th class="smalcol">Delete</th>
		</tr>
		<?php foreach ($results as $result) : ?>
			<tr>
				<?php $new = $result['employeeID']; if($currentd != $new) { ?>
				<td><?php echo $result['employeeID']; ?></td>
				<?php $currentd = $new;  } else {  ?> <td></td> <?php } ?>
				<td><?php echo $result['dependentID']; ?></td>
				<td><?php echo $result['FirstName']; ?></td>
				<td><?php echo $result['LastName']; ?></td>
				<td><img src="<?php echo $result['Picture']; ?>" alt="<?php echo $result['Picture']; ?>"></td>
				<td><input type="hidden" name="dependentID" value="<?php echo $result['dependentID']; ?>"><input type="submit" value="Delete Dependent"></td>
		</tr>
		<?php endforeach; ?>
	</table>
	</form>
	<br>
<?php	
	echo 'Edit Dependent for Employee ID: '.$search;
?>	
	<!-- Display edit form -->
	<form action="edit.php" method="post" name="edit" id="edit" enctype="multipart/form-data">
		<!-- Display edit table -->
		<table>
			<tr>
			<th class="smalcol">Employee ID</th>
			<th class="smalcol">Dependent ID</th>
			<th class="smalcol">First Name</th>
			<th class="smalcol">Last Name</th>
			<th class="smalcol">Picture</th>
			</tr>
			<!-- Using foreach loop -->
			<?php foreach ($edits as $edit) : ?>
				<tr>
				<?php $new = $edit['employeeID']; if($currente != $new) { ?>
					<td>
						<input type="hidden" name="employeeID[]" value="<?php echo $edit['employeeID']; ?>"><?php echo $edit['employeeID']; ?>
					</td>
				<?php $currente = $new;  } else {  ?> <td></td> <?php } ?>
					<td>
						<input type="hidden" name="dependentID[]" value="<?php echo $edit['dependentID']; ?>"><?php echo $edit['dependentID']; ?>
					</td>
					<td>
						<input type="text" size="20" maxlength="30" name="FirstName[]" value="<?php echo $edit['FirstName']; ?>">
					</td>
					<td>
						<input type="text" size="20" maxlength="30" name="LastName[]" value="<?php echo $edit['LastName']; ?>">
					</td>
					<td>
						<input type="hidden" name="Pic[]" value="<?php echo $edit['Picture']; ?>">
						<img src="<?php echo $edit['Picture']; ?>" alt="<?php echo $edit['Picture']; ?>"><br><input type="file" name="Picture[]">
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
		<br>
		<input type="submit" value="Edit Dependent">
	</form>
	<p><a href="index.php" id="home">HOME</a></p>

<?php
	}
	// Footer
	require_once 'footer.php';
?>
