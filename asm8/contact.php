<?php
  // Variables
  $receiver = 'bn@localhost';
  $thanks = 'thanks.php'; 
  $error = 'error.php';
  $rname = 'BN';
	// This pattern for testing local only
	$pattern = '/[a-zA-Z0-9]+@[a-zA-Z0-9]/';	
	// Get fields
  $fname = trimData($_POST['FirstName']);
  $lname = trimData($_POST['LastName']);
	$sender = trimData($_POST['email']);
	$message = trimData($_POST['comments']);
	$ematch = preg_match($pattern, $sender);
	// Check if fields empty or mail error
	if(empty($fname)||empty($lname)||empty($sender)||empty($message)||($ematch==0)) {
		$emptyFields = true;
	} else {
		$emptyFields = false;
	}
	//  Set fields
	$ssubject = "Message from $sender";
  $smessage = "<b>Client Name:</b>  $fname $lname<br><br>";
  $smessage .= "<b>Client  Email:</b> $sender<br><br>";
  $smessage .= "<b>Contents:</b><br><br>$message";
  $sheader = "From: $sender\r\n"; 
  $sheader .= "Reply-To: $sender\r\n"; 
  $sheader .= "MIME-Version: 1.0\r\n";
  $sheader .= "Content-type: text/html;  charset=iso-8859-1\r\n";	
	$rsubject = "Confirmation from $receiver";
  $rmessage = "<b>Client Name:</b> $rname<br><br>";
  $rmessage .= "<b>Client  Email:</b> $receiver<br><br>";
  $rmessage .= "<b>Contents:</b><br><br>";
	$rmessage .= "Thank you for contacting us. This is the confirmation that we have received your message with the content as follows:<br><br>";
	$rmessage .= $message;
  $rheader = "From: $receiver\r\n"; 
  $rheader .= "Reply-To:  $receiver\r\n"; 
  $rheader .= "MIME-Version: 1.0\r\n";
  $rheader .= "Content-type: text/html;  charset=iso-8859-1\r\n";	
	// Send mails if fields not empty
  if($emptyFields == false) {
		mail($receiver, $ssubject, $smessage, $sheader);
		mail($sender, $rsubject, $rmessage, $rheader);
		// Thank-you page if success
		header("Location: $thanks"); 
  } else {
    // Error page if fail
		header("Location: $error"); 
  }
  /* Trim and validate data */
	function trimData($value) {
		$value = htmlspecialchars(stripslashes(trim($value)));
		return $value;
	};
?>
