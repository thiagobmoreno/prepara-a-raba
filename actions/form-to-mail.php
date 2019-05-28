<?php
$para = "morenobthiago@gmail.com";

$email = $_POST["EMAIL"];
$phone = $_POST["TELEFONE"];
$name = $_POST["NOME"];

$msg =
"Nome: " . $name . "\r\n" . 
"E-mail: " . $email . "\r\n" .
"Telefone: " . $phone. "\r\n";

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

if (!isset($_POST['email'])) {
header( "Location: feedback_page" );
} elseif (empty($name) || empty($email) || empty($phone))  {
header( "Location: $error_page" );
} elseif ( isInjected($email) || isInjected($name)  || isInjected($phone) ) {
header( "Location: $error_page" );
} else {

	mail( $para, "Novo Cadastro PrEP Injetável", $msg );

	header( "Location: $thankyou_page" );
}
?>
