<?php
	// Variables
	$stitle = 'Brandon Nguyen - CTS2857C';
	$header = 'CTS2857C - Final Exam';
	$ptitle = 'Add Dependent';
	$footer = '2016 &copy; Brandon Nguyen';

	// Require files
	require_once 'database.php'; 
	// Header
	include_once 'header.php';	
	// Counter
	$counter = 10;
	$oid = '';
	// Get all fields
	$query = "SELECT * FROM employee";
	$ids = $db->query($query);

	// Select if match
	function IsSelected($name,$value) {
		if(isset($name) && $name==$value) {
			echo 'selected';
		};
  };

?>	
	<!-- Display dependent form -->
	<form action="dependent.php" method="post" name="dependent" id="dependent" enctype="multipart/form-data">
		<!-- Display selection of Employee ID -->
		<select name="employeeID">
			<option value="">Select Employee ID</option>
				<?php foreach ($ids as $id) : ?>
					<option value="<?php echo $id['employeeID']; ?>" <?php IsSelected($oid,'<?php echo $id[\'employeeID\']; ?>');?>><?php echo $id['employeeID']; ?></option>
				<?php endforeach; ?>
		</select><br>
		<!-- Display add dependents table -->
		<table>
			<tr>
				<th class="bigcol">First Name</th>
				<th class="bigcol">Last Name</th>
				<th class="bigcol">Load Picture</th>
			</tr>
			<?php for ($i = 0; $i < $counter; $i++) { ?>
			<tr>
				<td><input type="text" size="20" maxlength="30" name="FirstName[]"></td>
				<td><input type="text" size="20" maxlength="30" name="LastName[]"></td>
				<td><input type="file" name="Picture[]"></td>
			</tr>
			<?php } ?>
		</table>
		<br>
		<input type="submit" value="Add dependents">
	</form>
	<p><a href="index.php" id="home">HOME</a></p>

<?php
	// Footer
	require_once 'footer.php';
?>
