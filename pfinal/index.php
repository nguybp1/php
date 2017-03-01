<?php
	// Variables
	$stitle = 'Employee Records - Brandon Nguyen';
	$header = 'EMPLOYEE RECORDS';
	$ptitle = 'Home Page';
	$footer = '2016 &copy; Brandon Nguyen';
	$oid = '';
	// Require files
	require_once 'database.php'; 
	// Header
	include_once 'header.php';

	// Get all fields
	$query = "SELECT * FROM employee";
	$employees = $db->query($query);
	$ids = $db->query($query);
	$edits = $db->query($query);

	// Select if match
	function IsSelected($name,$value) {
		if(isset($name) && $name==$value) {
			echo 'selected';
		};
  };
?>
	<!-- Display table of employee -->
	<table>
		<tr>
			<th class="smalcol">Employee ID</th>
			<th class="bigcol">First Name</th>
			<th class="bigcol">Last Name</th>
		</tr>
		<?php foreach ($employees as $employee) : ?>
		<tr>
			<td class="right"><?php echo $employee['employeeID']; ?></td>
			<td><?php echo $employee['FirstName']; ?></td>
			<td><?php echo $employee['LastName']; ?></td>
		</tr>
		<?php endforeach; ?>
	</table>
	<br>
	<p><a href="addEmployee.php" id="employee">Add Employee</a></p>
	<p><a href="addDependent.php" id="dependent">Add Dependent</a></p>
	<!-- List employeeID for edit-->
	<form action="editDependent.php" method="post" name="edit" id="edit">
		<select name="employeeID">
			<option value="">Select ID</option>
				<?php foreach ($edits as $edit) : ?>
					<option value="<?php echo $edit['employeeID']; ?>" <?php IsSelected($oid,'<?php echo $edit[\'employeeID\']; ?>');?>><?php echo $edit['employeeID']; ?></option>
				<?php endforeach; ?>
		</select><br>
		<input type="submit" value="Edit Employee Dependent">
	</form>
	<!-- List employeeID for report-->
	<form action="report.php" method="post" name="report" id="report">
		<select name="employeeID">
			<option value="All">All</option>
				<?php foreach ($ids as $id) : ?>
					<option value="<?php echo $id['employeeID']; ?>" <?php IsSelected($oid,'<?php echo $id[\'employeeID\']; ?>');?>><?php echo $id['employeeID']; ?></option>
				<?php endforeach; ?>
		</select><br>
		<input type="submit" value="List Employee Dependent">
	</form>
	
<?php
	// Footer
	require_once 'footer.php';
?>
