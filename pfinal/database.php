<?php
	// Require files
  require_once 'createDB.php';

	// Try & Catch
  try {
    // Create PDO object
    $db = new PDO($udsn, $user, $pass);
    // Set PDO exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
		// Display error if found
    $error = $e->getMessage();
    include('error.php');
    exit();
  }
?>
