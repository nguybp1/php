<?php
	// Variables
	$stitle = 'Brandon Nguyen - CTS2857C';
	$header = 'CTS2857C - Assignment 8';
	$ptitle = 'Customer Services';
	$footer = '2016 &copy; Brandon Nguyen';
	// Header
	include 'header.php';
?>
			<!-- Show form -->	
			<form action="contact.php"  method="POST">
				<p>*First Name: <input type="text"  name="FirstName" /></p>
				<p>*Last Name: <input type="text"  name="LastName" /></p>
				<p>*Email: <input type="text" name="email"  /><br>
				<i>Note:</i> No special character allow and local only.</p>
				<p>*Questions? Comments:</p>
				<p><textarea name="comments" cols="40" rows="10">
					Type comments here.</textarea></p>
				<input type="submit" name="submit"  value="Submit"/>
			</form>
<?php
	// Footer
	require 'footer.php';
?>
