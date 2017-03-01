<?php
	// Variables
	$stitle = 'CTS2857C';
	$header = 'CTS2857C - Team Project 4';
	$ptitle = 'Add Customer';
	$footer = '2016 &copy; Bravo Team';

	// Header
	include 'header.php';
?>
  <!-- Display Customer form -->
  <form action="customer.php" method="post" name="customer" id="customer">
			<fieldset>
				<legend>Customer Information</legend><br/>
				<div id="data">
					<label>CustomerID:</label>
					<input type="text" name="customerID"><br><br>
					<label>Name:</label>
					<input type="text" name="name"><br><br>
					<label>Phone:</label>
					<input type="text" name="phone"> (format 888-888-8888)<br><br>
					<label>Email:</label>
					<input type="text" name="email"><br><br>
				</div>
			</fieldset>
			<div id="buttons">
				<label>&nbsp;</label>
				<input type="submit" value="Add Customer"><br> 
			</div>
	</form>
<p><a href="index.php" id="home">HOME</a></p>
<?php
	// Footer
	require 'footer.php';
?>
