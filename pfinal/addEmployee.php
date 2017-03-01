<?php
	// Variables
	$stitle = 'Brandon Nguyen - CTS2857C';
	$header = 'CTS2857C - Final Exam';
	$ptitle = 'Add Employee';
	$footer = '2016 &copy; Brandon Nguyen';

	// Header
	include_once 'header.php';
?>
  <!-- Display Employee form -->
	<form action="employee.php" method="post" name="employee" id="employee">
			<fieldset>
				<legend>Employee Information</legend><br/>
				<div id="data"> 
					<label>First Name:</label>
					<input type="text" name="fname"><br><br>
					<label>Last Name:</label>
					<input type="text" name="lname"><br><br>
				</div>
			</fieldset>
			<div id="buttons">
				<label>&nbsp;</label>
				<input type="submit" name="submit" value="Add employee"><br>   
			</div>
	</form>
	<p><a href="index.php" id="home">HOME</a></p>	
<?php
	// Footer
	require_once 'footer.php';
?>
