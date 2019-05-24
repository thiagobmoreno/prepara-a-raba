<?php
$webmaster_email = "morenobthiago@gmail.com";

$feedback_page = "../index.html";
$error_page = "../error_message.html";
$thankyou_page = "../thank_page.html";

$email_address = $_REQUEST["E-MAIL"];
$phone_number = $_REQUEST["TELEFONE"];
$name = $_REQUEST["NOME"];

$msg =
"Nome: " . $name . "\r\n" . 
"E-mail: " . $email_address . "\r\n" .
"Telefone: " . $phone_number . "\r\n";

function isInjected($str) {
	$injections = array('(\n+)',
	'(\r+)',
	'(\t+)',
	'(%0A+)',
	'(%0D+)',
	'(%08+)',
	'(%09+)'
	);
	$inject = join('|', $injections);
	$inject = "/$inject/i";
	if(preg_match($inject,$str)) {
		return true;
	}
	else {
		return false;
	}
}

if (!isset($_REQUEST['email_address'])) {
header( "Location: feedback_page" );
} elseif (empty($name) || empty($email_address) || empty($phone_number))  {
header( "Location: $error_page" );
} elseif ( isInjected($email_address) || isInjected($name)  || isInjected($phone_number) ) {
header( "Location: $error_page" );
} else {

	mail( "$webmaster_email", "Novo Cadastro PrEP Injetável", $msg );

	header( "Location: $thankyou_page" );
}
?>