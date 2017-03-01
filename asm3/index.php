<?php
	// Header
	include 'header.php';
	// Page Tile
	echo "<!-- Page Title -->
		<div class=\"title\"><h2>Assignment 3</h2></div>\n";
	// Constant
	define('BIRTHDAY','1965-11-02 15:22:00');
	// Variables
	$myBD = new DateTime(BIRTHDAY);
	$today = new DateTime();
	$age = $myBD->diff($today);
	$BD = $myBD->getTimeStamp();
	$myRetire = strtotime("+67 years",$BD); // retire when 67 yrs old
	$retire_age = date('Y-m-d', $myRetire);
	$retire_date = new DateTime($retire_age);
	$retire = $today->diff($retire_date);

	// Family members and relationships
	$myFamily = array(
		'Spouse' => array('Jerling Nguyen'),
		'Daughter' => array('Emily Nguyen'),
		'Son' => array('Alexander Nguyen'),
		'Parents' => array('Henry Nguyen','Hang Nguyen'),
		'In-laws' => array('Hing Lee','Shao He')
	);

	// Contents
	echo "		<div class=\"content\">\n";	
	// Display birthday and days to retire
	echo '			My birthday is ';
	echo date('m/d/Y H:i:s',$myBD->getTimeStamp());
	echo "<br>\n";
	echo '			Since I was born, now is ';
	echo $age->format('%yy %mm %dd %H:%I:%S');
	echo "<br>\n";
	echo '			I can retire in ';
	echo $retire->format('%a days on ');
	echo date('m/d/Y H:i:s',$retire_date->getTimeStamp());
	echo "<br><br>\n";
	// Display family relationships, numbers and names
	foreach ($myFamily as $relation => $member_relate) {
		echo "			My $relation is";
		echo "\n";
		echo "				<ul>";
		echo "\n";
		foreach ($member_relate as $member => $name) {
			echo "					<li>Name: $name</li>";
			echo "\n";
		}
		// Size of first dimension count($myFamily)
		// Size of second dimension count($member_relate)
		echo "					<li>Total, I have ".count($member_relate)." ".$relation."</li>";
		echo "\n";
		echo "				</ul>";
		echo "\n";
	}
	echo "\n";
	// End contents
	echo "		</div>\n";	

	// Footer
	require 'footer.php';
?>