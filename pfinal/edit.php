<?php
  // Get data
  $employeeID = $_POST['employeeID'];
  $dependentID = $_POST['dependentID'];
  $FirstName = $_POST['FirstName'];
  $LastName = $_POST['LastName'];
  $Picture = $_POST['Pic'];
	$countf = count(array_filter($FirstName));
	$countl = count(array_filter($LastName));
	$count = count(array_filter($dependentID));
  $path = 'dependentpictures';
	$current = '';
	
  // Validate inputs
  if ( empty($employeeID) || $countf<=0 || $countl<=0 ) {
    $error = "Invalid data. Check fields and try again.";
    include_once 'error.php';
  } else {
    // If valid, add data to table
    require_once 'database.php';
		$sql = "UPDATE dependent 
						SET dependentID = :dependentID,
								FirstName = :FirstName,
								LastName = :LastName,
								Picture = :Picture
						WHERE dependentID = :dependentID
		";
		$update = $db->prepare($sql);
		// Using for loop
		for ($i=0;$i<$count;$i++) {
			$tmp_name = $_FILES['Picture']['tmp_name'][$i];
			$picName = $path . '/' . $_FILES['Picture']['name'][$i];
			move_uploaded_file($tmp_name, $picName);
			$update->bindParam(':dependentID', $dependentID[$i]);
			$update->bindParam(':FirstName', $FirstName[$i]);
			$update->bindParam(':LastName', $LastName[$i]);
			if($_FILES['Picture']['name'][$i]!='') {
				$update->bindParam(':Picture', $picName);
			} else {
				$update->bindParam(':Picture', $Picture[$i]);
			}
			$update->execute();
		}
		$update->closeCursor();

    // Display index page
    include_once 'index.php';
  }
?>
