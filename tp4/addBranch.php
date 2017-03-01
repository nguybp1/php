<?php
	// Variables
	$stitle = 'CTS2857C';
	$header = 'CTS2857C - Team Project 4';
	$ptitle = 'Add Branch';
	$footer = '2016 &copy; Bravo Team';

	// Header
	include 'header.php';
?>
  <!-- Display Branch form -->
	<form action="branch.php" method="post" name="branch" id="branch">
			<fieldset>
				<legend>Branch Information</legend><br/>
				<div id="data"> 
					<label>Branch No:</label> 
					<input type="text" name="branchNo"><br><br>
					<label>Address:</label>
					<input type="text" name="address"><br><br>
					<label>City:</label>
					<input type="text" name="city"><br><br>
					<label>State:</label>
					<input type="text" name="state"><br><br>
					<label>Zip:</label>
					<input type="text" name="zip"><br><br>
				</div>
			</fieldset>
			<div id="buttons">
				<label>&nbsp;</label>
				<input type="submit" name="submit" value="Add Branch"><br>   
			</div>
	</form>
	<p><a href="index.php" id="home">HOME</a></p>	
<?php
	// Footer
	require 'footer.php';
?>
