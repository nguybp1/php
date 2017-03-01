<?php
  // Get data
  $employeeID = $_POST['employeeID'];
  $FirstName = $_POST['FirstName'];
  $LastName = $_POST['LastName'];
	$countf = count(array_filter($FirstName));
	$countl = count(array_filter($LastName));
	$i = 0;
  $path = 'dependentpictures';
 
  // Validate inputs
  if ( empty($employeeID) || $countf<=0 || $countl<=0 ) {
    $error = "Invalid data. Check fields and try again.";
    include_once 'error.php';
  } else {
    // If valid, add data to table
    require_once 'database.php';
		$sql = 'INSERT INTO dependent (employeeID, FirstName, LastName, Picture) 
						VALUES (:employeeID, :FirstName, :LastName, :Picture)';
		$insert = $db->prepare($sql);

		while ($i < $countf) {
			$tmp_name = $_FILES['Picture']['tmp_name'][$i];
			$picName = $path . '/' . $_FILES['Picture']['name'][$i];
			move_uploaded_file($tmp_name, $picName);
			$insert->bindParam(':employeeID', $employeeID);
			$insert->bindParam(':FirstName', $FirstName[$i]);
			$insert->bindParam(':LastName', $LastName[$i]);
			$insert->bindParam(':Picture', $picName);
			$insert->execute();
			$i++;
		}
    // Close connection
		$insert->closeCursor();
    // Display index page
    include_once 'index.php';
  }
?>
