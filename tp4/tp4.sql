# Create user and db "cts2857c_tp4"
CREATE USER IF NOT EXISTS 'cts2857c_tp4'@'localhost' IDENTIFIED BY 'cts2857c_tp4';
CREATE DATABASE IF NOT EXISTS `cts2857c_tp4`;
GRANT ALL PRIVILEGES ON `cts2857c_tp4`.* TO 'cts2857c_tp4'@'localhost';

# Open db "cts2857c_tp4"
USE `cts2857c_tp4` ;

# Create table "branch"
CREATE TABLE IF NOT EXISTS branch(
		BranchNo INT(4) NOT NULL,
		Address VARCHAR(25) NOT NULL,
		City VARCHAR(25) NOT NULL,
		State VARCHAR(2) NOT NULL,
		Zip INT(5) NOT NULL,
	PRIMARY KEY (BranchNo)
) ENGINE=InnoDB;

# Create table "customer"
CREATE TABLE IF NOT EXISTS customer(
		CustomerID INT(4) NOT NULL,
		Name VARCHAR(25) NOT NULL,
		Phone VARCHAR(12) NOT NULL,
		Email VARCHAR(25) NOT NULL,
	PRIMARY KEY (CustomerID)
) ENGINE=InnoDB;

# Create table "items"
CREATE TABLE IF NOT EXISTS items(
		ItemNo INT(4) NOT NULL,
		Description VARCHAR(25) NOT NULL,
		Price DECIMAL(4,2) NOT NULL,
	PRIMARY KEY (ItemNo)
) ENGINE=InnoDB;

# Create table "orders"
CREATE TABLE IF NOT EXISTS orders(
		OrderID INT(4) NOT NULL,
		CustomerID INT(4) NOT NULL,
		BranchNo INT(4) NOT NULL,
		OrderDate DATE NOT NULL,
	PRIMARY KEY (OrderID),
	INDEX (CustomerID, BranchNo),
	FOREIGN KEY (CustomerID)
	REFERENCES customer (CustomerID)
	ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (BranchNo)
	REFERENCES branch (BranchNo) 
	ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

# Create table "orderItems"
CREATE TABLE IF NOT EXISTS orderitems(
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
