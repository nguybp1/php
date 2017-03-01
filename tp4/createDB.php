<?php
	// Variables
	$host = 'localhost';
	$ruser = 'root';
	$rpass = '';
	$rdsn = "mysql:host=$host";
	$dbname = 'cts2857c_tp4';
	$user = 'cts2857c_tp4';
	$pass = 'cts2857c_tp4';
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
		// Create tables
		$table1 = "CREATE TABLE IF NOT EXISTS branch(
				BranchNo INT(4) NOT NULL,
				Address VARCHAR(25) NOT NULL,
				City VARCHAR(25) NOT NULL,
				State VARCHAR(2) NOT NULL,
				Zip INT(5) NOT NULL,
			PRIMARY KEY (BranchNo)
		) ENGINE=InnoDB;
		";
		$table1 = trim($table1);
    $pdo->exec($table1);
		$table2 = "CREATE TABLE IF NOT EXISTS customer(
				CustomerID INT(4) NOT NULL,
				Name VARCHAR(25) NOT NULL,
				Phone VARCHAR(12) NOT NULL,
				Email VARCHAR(25) NOT NULL,
			PRIMARY KEY (CustomerID)
		) ENGINE=InnoDB;
		";
		$table2 = trim($table2);
    $pdo->exec($table2);
		$table3 = "CREATE TABLE IF NOT EXISTS items(
				ItemNo INT(4) NOT NULL,
				Description VARCHAR(25) NOT NULL,
				Price DECIMAL(4,2) NOT NULL,
			PRIMARY KEY (ItemNo)
		) ENGINE=InnoDB;
		";
		$table3 = trim($table3);
    $pdo->exec($table3);
		$table4 = "CREATE TABLE IF NOT EXISTS orders(
				OrderID INT(4) NOT NULL,
				CustomerID INT(4) NOT NULL,
				BranchNo INT(4) NOT NULL,
				OrderDate DATE NOT NULL,
			PRIMARY KEY (OrderID),
			INDEX (CustomerID, BranchNo),
			FOREIGN KEY (CustomerID)
			REFERENCES customer(CustomerID)
			ON DELETE CASCADE ON UPDATE CASCADE,
			FOREIGN KEY (BranchNo)
			REFERENCES branch (BranchNo) 
			ON DELETE CASCADE ON UPDATE CASCADE
		) ENGINE=InnoDB;
		";
		$table4 = trim($table4);
    $pdo->exec($table4);
		$table5 = "CREATE TABLE IF NOT EXISTS orderitems(
				OrderID INT(4) NOT NULL,
				ItemNo INT(4) NOT NULL,
				Quantity INT(4) NOT NULL,
				Price DECIMAL(4,2) NOT NULL,
			PRIMARY KEY (OrderID, ItemNo),
			INDEX (OrderID, ItemNo),
			FOREIGN KEY (OrderID)
			REFERENCES orders(OrderID)
			ON DELETE CASCADE ON UPDATE CASCADE,
			FOREIGN KEY (ItemNo)
			REFERENCES items(ItemNo) 
			ON DELETE CASCADE ON UPDATE CASCADE
		) ENGINE=InnoDB;
		";
		$table5 = trim($table5);
		$pdo->exec($table5);
	} catch(PDOException $e) {
		// Display error if found
    $error = $e->getMessage();
    include('error.php');
    exit();
	}
?> 