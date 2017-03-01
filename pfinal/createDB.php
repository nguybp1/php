<?php
	$host = 'localhost';
	$ruser = 'root';
	$rpass = '';
	$rdsn = "mysql:host=$host";
	$dbname = 'employees1';
	$user = 'employees1';
	$pass = 'employees1';
	$udsn = "mysql:host=$host;dbname=$dbname";

	// Try & Catch
	try {
    // Create PDO object
    $pdo = new PDO($rdsn, $ruser, $rpass);
    // Set PDO exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Create DB and user
    $sql = "CREATE USER IF NOT EXISTS '$user'@'localhost' IDENTIFIED BY '$pass';
			CREATE DATABASE IF NOT EXISTS `$dbname`;
			GRANT ALL PRIVILEGES ON `$dbname`.* TO '$user'@'localhost'; 
		";
		$sql = trim($sql);
    $pdo->exec($sql);
		// Open DB
    $sqlopen = "USE `$dbname`; ";
		$sqlopen = trim($sqlopen);
    $pdo->exec($sqlopen);		
		// Create tables and default data
		$tables = "CREATE TABLE IF NOT EXISTS employee (
					employeeID int(4) NOT NULL AUTO_INCREMENT,
					FirstName varchar(25) NOT NULL,
					LastName varchar(25) NOT NULL,
				PRIMARY KEY (employeeID)
			) ENGINE=InnoDB;
			CREATE TABLE IF NOT EXISTS dependent (
					dependentID int(4) NOT NULL AUTO_INCREMENT,
					employeeID int(4) DEFAULT NULL,
					FirstName varchar(25) NOT NULL,
					LastName varchar(25) NOT NULL,
					Picture varchar(50) NOT NULL,
				PRIMARY KEY (dependentID),
				INDEX (employeeID),
				FOREIGN KEY (employeeID) 
				REFERENCES employee (employeeID) 
				ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB;
		";
		$tables = trim($tables);
		$pdo->exec($tables);
	} catch(PDOException $ex) {
		// Display error if found
    $error = $ex->getMessage();
    include('error.php');
    exit();
	}
?> 