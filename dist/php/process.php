<?php

$errorMSG = "";

//Name Field
if (empty($_POST["name"])) {
	$errorMSG = "Name is required ";
} else {
	$name = $_POST["name"];
}

//Email Field
if (empty($_POST["email"])) {
	$errorMSG .= "Email is required ";
} else {
	$email = $_POST["email"];
}

//Inquiry Field
if (empty($_POST["inquiry"])) {
	$errorMSG .= "Inquiry is required ";
} else {
	$inquiry = $_POST["inquiry"];
}

//Phone, not required
$phone = $_POST["phone"];


$EmailTo = "theodore.moke@gmail.com";
$Subject = "Contact Form Inquiry";
//Your domain to avoid the host blocking what it thinks is spam
$EmailFrom = "web-support@tedrmoke.com";

// Creates template for email body
$Body = "";
$Body .= "Name: ";
$Body .= $name;
$Body .= "\n";

$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";

/*$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n";
$headers .= 'Content-Type: text/plain; charset=UTF-8' . "\r\n"; */

$Body .= "Phone: ";
$Body .= $phone;
$Body .= "\n";

$Body .= "Inquiry: ";
$Body .= $inquiry;
$Body .= "\n";

// Sends Email
$success = mail($EmailTo, $Subject, $Body, "From:".$EmailFrom);

// Confirms if the process was successful
if ($success && $errorMSG == ""){echo "success";}
else{ 
	if($errorMSG == ""){
		echo "Something went wrong";
	} else {
		echo $errorMSG;
	}
}
?>