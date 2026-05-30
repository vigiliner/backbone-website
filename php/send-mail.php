<?php
// phpcs:ignoreFile
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Variables
$name = trim($_POST['nombre']);
$email = trim($_POST['Correo']);
$company = trim($_POST['empresa']);
$phone = trim($_POST['Telefono']);
$state = trim($_POST['MunicipioEstado']);
$message = trim($_POST['message']);
$to = "alejandrogomez2339@gmail.com"; // Change with your email address

// Email address validation - works with php 5.2+
function is_email_valid($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}


if( isset($name) && isset($email) && isset($company) && isset($phone) && isset($message) && is_email_valid($email) ) {

	// Avoid Email Injection and Mail Form Script Hijacking
	$pattern = "/(content-type|bcc:|cc:|to:)/i";
	if( preg_match($pattern, $name) || preg_match($pattern, $email) || preg_match($pattern, $company) || preg_match($pattern, $message) ) {
		exit;
	}

	// Email will be send

	// HTML Elements for Email Body
	$body = <<<EOD
	<strong>Name:</strong> $name <br>
	<strong>Email:</strong> <a href="mailto:"$email">$email</a> <br> 
	<strong>company:</strong> $company <br><br><br>
	
	<strong>Message:</strong> <br> $message 
EOD;
//Must end on first column
	
	$headers = "From: $name <$email>\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8 ' . "\r\n";

	// PHP email sender
	mail($to, $company, $body, $headers);
}

}
