<?php
	$host = 'localhost';
	$ruser = 'root';
	$rpass = '';
	$rdsn = "mysql:host=$host";
	$dbname = 'bn_asm10';
	$user = 'bn_asm10';
	$pass = 'bn_asm10';
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
		$tables = "CREATE TABLE IF NOT EXISTS invoiceheader (
					invoiceNumber int(4) NOT NULL,
					customerName varchar(25) NOT NULL,
				PRIMARY KEY (invoiceNumber)
			) ENGINE=InnoDB;
			CREATE TABLE IF NOT EXISTS invoicedetails (
					id int(4) NOT NULL AUTO_INCREMENT,
					invoiceNumber int(4) NOT NULL,
					item varchar(25) NOT NULL,
					description varchar(25) NOT NULL,
					quantity int(4) NOT NULL,
					price decimal(4,2) NOT NULL,
				PRIMARY KEY (id),
				INDEX (invoiceNumber),
				FOREIGN KEY (invoiceNumber) 
				REFERENCES invoiceheader (invoiceNumber) 
				ON DELETE CASCADE ON UPDATE CASCADE
			) ENGINE=InnoDB;
			INSERT INTO invoiceheader (invoiceNumber, customerName)
				VALUES
					(1111, 'Jane Doe'),
					(2222, 'John Doe'),
					(3333, 'Jane Smith'),
					(4444, 'John Smith');
			INSERT INTO invoicedetails (id, invoiceNumber, item, description, quantity, price)
				VALUES
					(NULL, 1111, 'Jane Doe 1', 'Jane Doe 1', 1, 1.11),
					(NULL, 1111, 'Jane Doe 2', 'Jane Doe 2', 2, 1.22),
					(NULL, 2222, 'John Doe 1', 'John Doe', 2, 2.22),
					(NULL, 3333, 'Jane Smith 1', 'Jane Smith', 3, 3.33),
					(NULL, 4444, 'John Smith 1', 'John Smith 1', 4, 4.11),
					(NULL, 4444, 'John Smith 2', 'John Smith 2', 2, 4.22);
		";
		$tables = trim($tables);
		$pdo->exec($tables);
	} catch(PDOException $e) {
		// Display error if found
    $error = $e->getMessage();
    include('error.php');
    exit();
	}
?> 