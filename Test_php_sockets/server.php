<?php

if(!($sock = socket_create(AF_INET, SOCK_STREAM, 0))) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Couldn't create socket: [$errorcode] $errormsg \n");
}
 
echo "Socket created \n";
 
// Bind the source address
if(!socket_bind($sock, "127.0.0.1", 5000)) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
     
    die("Could not bind socket : [$errorcode] $errormsg \n");
}
 
echo "Socket bind OK \n";

//listen
socket_listen ($sock , 10);
 
echo "Waiting for incoming connections... \n";
 
//Accept incoming connection - This is a blocking call
$client = socket_accept($sock);
     
//display information about the client who is connected
if(socket_getpeername($client, $address, $port)) {
    echo "Client $address : $port is now connected to us.";
}
 
//read data from the incoming socket
$input = socket_read($client, 1024000);
 
$response = "OK .. $input";
 
// Display output  back to client
socket_write($client, $response);
socket_close($client);
