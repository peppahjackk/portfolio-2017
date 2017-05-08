<?php

$errorMSG = "";
$secret = '6Ld8Xx4UAAAAAGlEJ9Cy6GHf1LSleVi_DiG45WJZ';

$data = array(
       'secret' => $secret,
       'response' => $_POST['g_recaptcha'],
       'remoteip' => $_SERVER['REMOTE_ADDR']
    );

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = json_decode(curl_exec($curl));
curl_close($curl);

if (!$result->success) {
	$errorMSG .= "Please complete reCAPTCHA ";
} 

//Name Field
if (empty($_POST["name"])) {
	$errorMSG .= "Name is required ";
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
$EmailFrom = "web-support@tedmoke.com";

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

$Headers = 'From: '.$EmailFrom."\r\n".
'Reply-To: '.$email."\r\n" .
'X-Mailer: PHP/' . phpversion();

// Sends Email
if ($errorMSG == "") {$success = mail($EmailTo, $Subject, $Body, $Headers);}

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