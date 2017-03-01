<?php
  $Fname=$Lname=$comment=$gender=$info=$major=$course='';
	$FnameErr=$LnameErr=$commentErr=$genderErr=$infoErr=$majorErr=$courseErr='';
	$Error = '<span class="Error">* This field is required</span>';
	$countField = 0;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Fname = trimData($_POST['Fname']);
    $Lname = trimData($_POST['Lname']);
    $comment = trimData($_POST['Comments']);
    $major = trimData($_POST['Major']);

    if(isset($_POST['Gender'])) {
			$gender = trimData($_POST['Gender']);
		};
    if(isset($_POST['Info'])) {
			$info = $_POST['Info'];
		};
    if(isset($_POST['Course'])) {
			$course = $_POST['Course'];
		};
		if(empty($Fname)) {
			$FnameErr = $Error;
		} else {
			$countField += 1;
		};
		if(empty($Lname)) {
			$LnameErr = $Error;
		} else {
			$countField += 1;
		};
		if(empty($comment)) {
			$commentErr = $Error;
		} else {
			$countField += 1;
		};
		if(empty($gender)) {
			$genderErr = $Error;
		} else {
			$countField += 1;
		};
		if(empty($info)) {
			$infoErr = $Error;
		} else {
			$countField += 1;
		};
		if(empty($major)) {
			$majorErr = $Error;
		} else {
			$countField += 1;
		};
		if(empty($course)) {
			$courseErr = $Error;
		} else {
			$countField += 1;
		};
	};
	function trimData($value) {
		$value = htmlspecialchars(stripslashes(trim($value)));
		return $value;
	};
	function IsRadioChecked($name,$value) {
		if(isset($name) && $name==$value) {
			echo 'checked';
		};
  };
	function IsChecked($name,$value) {
		if(is_array($name) && isset($name)) {
			for($i=0; $i<count($name); $i++) {
				if($name[$i]==$value) {
					echo 'checked';
				};
			};
		};
	};
	function IsSelected($name,$value) {
		if(isset($name) && $name==$value) {
			echo 'selected';
		};
  };
	function IsMultiSelected($name,$value) {
		if(is_array($name) && isset($name)) {
			for($j=0; $j<count($name); $j++) {
				if($name[$j]==$value) {
					echo 'selected';
				};
			};
		};
	};
	// Variables
	$stitle = 'Brandon Nguyen - CTS2857C';
	$header = 'CTS2857C - Assignment 10';
	$ptitle = 'Invoice List';
	$footer = '2016 &copy; Brandon Nguyen';
	// Header
	include_once 'header.php';
?>
			<!-- Form with Self-Post -->
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <!-- Text box --> 
			*First Name: <input type="text" name="Fname" value="<?php echo $Fname; ?>"> <?php echo $FnameErr; ?><br>
			*Last Name: <input type="text" name="Lname" value="<?php echo $Lname; ?>"> <?php echo $LnameErr; ?><br>
      <!-- Textarea --> 
      *Comments: <textarea name="Comments"><?php echo $comment;?></textarea> <?php echo $commentErr;?><br>
      <!-- Radio button --> 
      *Gender <input type="radio" name="Gender" value="Male" <?php IsRadioChecked($gender,'Male');?>> Male <input type="radio" name="Gender" value="Female" <?php IsRadioChecked($gender,'Female');?>> Female <input type="radio" name="Gender" value="Private" <?php IsRadioChecked($gender,'Private');?>> Private <?php echo $genderErr;?><br>
      <!-- Checkboxes -->
      *Check box that interested: <?php echo $infoErr;?><br>
			<input type="checkbox" value="Tutor help" name="Info[]" <?php IsChecked($info,'Tutor help');?>>Tutor help<br>
			<input type="checkbox" value="Study oversea" name="Info[]" <?php IsChecked($info,'Study oversea');?>>Study oversea<br>
			<input type="checkbox" value="Career help" name="Info[]" <?php IsChecked($info,'Career help');?>>Career help<br>
			<input type="checkbox" value="Internship" name="Info[]" <?php IsChecked($info,'Internship');?>>Internship<br>
      <!-- Single selection -->
      *Major: 
			<select name="Major">
        <option value="">Select Major</option>
        <option value="Computer Science" <?php IsSelected($major,'Computer Science');?>>Computer Science</option>
				<option value="Computer Engineer" <?php IsSelected($major,'Computer Engineer');?>>Computer Engineer</option>
				<option value="Web Developer" <?php IsSelected($major,'Web Developer');?>>Web Developer</option>
			</select> <?php echo $majorErr;?><br>
      <!-- Multiple selection -->
      *Courses taken: (Shift + Left Click to multi select)<br>
			<select name="Course[]" size="4" multiple>
				<option value="C++" <?php IsMultiSelected($course,'C++');?>>C++</option>
				<option value="Java" <?php IsMultiSelected($course,'Java');?>>Java</option>
				<option value="JavaScript" <?php IsMultiSelected($course,'JavaScript');?>>JavaScript</option>
				<option value="PHP" <?php IsMultiSelected($course,'PHP');?>>PHP</option>
			</select> <?php echo $courseErr;?><br>
			<input type="submit" value="Submit"><br>
		</form>
			<?php
				/* Begin display information */
				if($countField>6) {
					echo "<div class=\"title\"><h2>Display Information</h2></div>";
					echo "\n";
					echo '				First Name: '.$Fname;
					echo "<br>\n";
					echo '				Last Name: '.$Lname;
					echo "<br>\n";
					echo '				Comments: '.$comment;
					echo "<br>\n";
					echo '				Gender: '.$gender;
					echo "<br>\n";
					echo '				Interested in: ';
					echo "<br>\n";
					echo "				<ul>\n";
/*			
					Use foreach loop
					foreach ($courses as $course => $value) {
						echo $course. ' = ' . $value . '<br />'; 
					}
*/
					/* Use for loop */
					for($i=0; $i<count($info); $i++) {
						$listInfo = trimData($info[$i]);
						echo "					<li>".$listInfo."</li>\n"; 
					}
					echo "				</ul>\n";
					echo '				Major: '.$major;
					echo "<br>\n";
					echo '				Courses taken: ';
					echo "<br>\n";
					echo "				<ul>\n";
					/* Use while loop */
					while(list($name, $value) = each($course)) {
						$listCourse = trimData($value);
						echo "					<li>".$listCourse."</li>\n"; 
					}
					echo "				</ul>\n";
				}
				/* End display information */
	// Footer
	require_once 'footer.php';
			?>
