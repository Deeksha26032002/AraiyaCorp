<?php
if(isset($_POST['submit'])) {    
	// EDIT THE 2 LINES BELOW AS REQUIRED    
	$email_to = "reservations.palampur@araiyahotels.com";    
	$email_subject = "Download Araiya Palampur Brochure";     
	      
	// validation expected data exists    
	if(!isset($_POST['Name']) || !isset($_POST['Email'])) {        
		died('We are sorry, but there appears to be a problem with the form you submitted.');           
	}           
	$Name = $_POST['Name']; // required     
	$email_from = $_POST['Email']; // required    
	$Phone = $_POST['Phone']; // not required      
	$error_message = "";    
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';   
	if(!preg_match($email_exp,$email_from)) {    
		$error_message .= 'The Email Address you entered does not appear to be valid.<br />';  
	}     
	$string_exp = "/^[A-Za-z .'-]+$/";   
	if(!preg_match($string_exp,$Name)) {    
		$error_message .= 'The Name you entered does not appear to be valid.<br />';  
	}   
	// if(!preg_match($string_exp,$Country)) {  //   $error_message .= 'The Country you entered does not appear to be valid.<br />';  // }            
	$email_message = "";           
	$email_message .= "Name: ".clean_string($Name)."\n";    
	$email_message .= "Email: ".clean_string($email_from)."\n";    
	$email_message .= "Phone: ".clean_string($Phone)."\n";      
	// create email headers
	$headers = 'From: '.$email_from."\r\n".'Reply-To: '.$email_from;
	$tmpmail = mail($email_to, $email_subject, $email_message, $headers) or die ("Mail could not be sent.");
	header('refresh:1;url=https://araiyahotels.com/araiya-palampur/images/araiya-palampur-brochure.pdf');
}
function died($error) {        
// your error code can go here        
	echo "We are very sorry, but there were error(s) found with the form you submitted. ";        
	echo "These errors appear below.<br /><br />";        
	echo $error."<br /><br />";        
	echo "Please go back and fix these errors.<br /><br />";        
	die();    
}
function clean_string($string) {      
	$bad = array("content-type","bcc:","to:","cc:","href");      
	return str_replace($bad,"",$string);    
}
?>