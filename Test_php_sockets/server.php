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
