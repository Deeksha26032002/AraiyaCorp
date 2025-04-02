<?php
if(isset($_POST['submit'])) {    
// EDIT THE 2 LINES BELOW AS REQUIRED    
	$email_to = "indu.d@edibbee.com, reservations.palampur@araiyahotels.com";    
	$email_subject = "Reserve a Table - Araiya Palampur";     
	      
	// validation expected data exists    
	if(!isset($_POST['name']) || !isset($_POST['email'])) {        
		died('We are sorry, but there appears to be a problem with the form you submitted.');
	}           
	$name = $_POST['name']; // required     
	$email = $_POST['email']; // required    
	$phone = $_POST['phone']; // not required	
	$date = $_POST['date']; // not required	
	$guest = $_POST['guest']; // not required	 
	$Nature_of_Booking = $_POST['Nature_of_Booking']; // required //	$time = $_POST['time']; // not required	//$vape = $_POST['vape'];      
	$error_message = "";    
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';   
	if(!preg_match($email_exp,$email)) {    
		$error_message .= 'The Email Address you entered does not appear to be valid.<br />'; 
	}     
	$string_exp = "/^[A-Za-z .'-]+$/";   
	if(!preg_match($string_exp,$name)) {    
		$error_message .= 'The Name you entered does not appear to be valid.<br />';  
	}     
	if(!preg_match($string_exp,$phone)) {    
		$error_message .= 'The Phone you entered does not appear to be valid.<br />';  
	}    
	if(!preg_match($string_exp,$guest)) {    
		$error_message .= 'The Guests you entered does not appear to be valid.<br />';  
	}    	  
	$date_exp = "dd-mm-yyyy";   
	if(!preg_match($date_exp,$date)) {    
		$error_message .= 'Select the Date<br />';  
	}        
	$time_exp = "hh:mm:ss";    
	(!preg_match($time_exp,$time)) {   
	 	$error_message .= 'Select the Time<br />'; 
	}     	// if(!preg_match($string_exp,$vape)) {    //$error_message .= 'Click Vape<br />';  //} 	   // if(!preg_match($string_exp,$Country)) {  //   $error_message .= 'The Country you entered does not appear to be valid.<br />';  // }            
	function clean_string($string) {      
		$bad = array("content-type","bcc:","to:","cc:","href");      
		return str_replace($bad,"",$string);    
	}
	$email_message = '';           
	$email_message .= "Name: ".clean_string($name)."\n";    
	$email_message .= "Email: ".clean_string($email)."\n";    
	$email_message .= "Phone: ".clean_string($phone)."\n";	
	$email_message .= "Date: ".clean_string($date)."\n";	
	$email_message .= "Time: ".clean_string($time)."\n";	
	$email_message .= "Guests: ".clean_string($guest)."\n";	$email_message .= "Nature of Booking: ".clean_string($Nature_of_Booking)."\n";     	    
	// create email headers
	$headers = 'From: '.$email."\r\n".'Reply-To: '.$email;
	$tmpmail = mail($email_to, $email_subject, $email_message, $headers) or die ("Mail could not be sent.");
	if($tmpmail) {
		header('refresh:1;url=https://araiyahotels.com/araiya-palampur/thank-you.html');
	}
	else {
		echo "Something went wrong";
	}
}
?>
	