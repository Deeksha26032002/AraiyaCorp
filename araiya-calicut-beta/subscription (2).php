<?php

## CONFIG ##
if(isset($_POST['subscribe'])) {
# LIST EMAIL ADDRESS
$recipient = "indu.d@edibbee.com";

# SUBJECT (Subscribe/Remove)
$subject = "Subscribe";

# RESULT PAGE
$location = "http://edibbee.com/projects/araiya-calicut/";

## FORM VALUES ##

# SENDER - WE ALSO USE THE RECIPIENT AS SENDER IN THIS SAMPLE
# DON'T INCLUDE UNFILTERED USER INPUT IN THE MAIL HEADER!
$sender = $recipient;

# MAIL BODY
$body .= "Email: ".$_POST['Email']." \n";

$body2 .= "Thank you for downloading";
# add more fields here if required

## SEND MESSGAE ##

$headers = 'From: '.$_POST['Email']."\r\n".
'Reply-To: '.$_POST['Email'];


$headers2 = 'From: '.$recipient."\r\n".
'Reply-To: '.$recipient;

mail( $recipient, $subject, $body, $headers ) or die ("Mail could not be sent.");
mail( $_POST['Email'], $subject, $body2, $headers2 ) or die ("Mail could not be sent.");


## SHOW RESULT PAGE ##

header('refresh:1;url=http://edibbee.com/projects/araiya-calicut/');
}
?>