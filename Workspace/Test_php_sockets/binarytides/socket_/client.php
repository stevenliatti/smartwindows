<?php

// Tiré de cette page : http://www.binarytides.com/php-socket-programming-tutorial/

$ip_address = gethostbyname("echo.websocket.org");
echo $ip_address . "\n";

// Création du socket
$sock = socket_create(AF_INET, SOCK_STREAM, 0);

if(!($sock = socket_create(AF_INET, SOCK_STREAM, 0)))
{
	$errorcode = socket_last_error();
	$errormsg = socket_strerror($errorcode);
	
	die("Couldn't create socket: [$errorcode] $errormsg \n");
}

echo "Socket created \n";

if(!socket_connect($sock, $ip_address, 80))
{
	$errorcode = socket_last_error();
	$errormsg = socket_strerror($errorcode);
	
	die("Could not connect: [$errorcode] $errormsg \n");
}

echo "Connection established \n";

$message = "GET / HTTP/1.1\r\n\r\n";

//Send the message to the server
if(!socket_send($sock, $message, strlen($message), 0)) {
	$errorcode = socket_last_error();
	$errormsg = socket_strerror($errorcode);
	
	die("Could not send data: [$errorcode] $errormsg \n");
}

echo "Message send successfully \n";

//Now receive reply from server
if(socket_recv($sock, $buf, 2045, MSG_WAITALL) === false) {
	$errorcode = socket_last_error();
	$errormsg = socket_strerror($errorcode);
	
	die("Could not receive data: [$errorcode] $errormsg \n");
}

//print the received message
echo $buf . "\n------------- End of message -------------\n";

socket_close($sock);
