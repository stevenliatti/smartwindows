<?php

$auto_checked = $_POST['mode'] == "0" ? "a" : "m";
$open_checked = $_POST['window'] == "1" ? "o" : "c";
$blind_value = $_POST['slide'] == "10" ? "t" : $_POST['slide'];

$host = "127.0.0.1";
$port = 2001;

$output = $auto_checked . ":" . $open_checked . ":" . $blind_value;

$socket = socket_create(AF_INET, SOCK_STREAM,0) or die("Could not create socket\n");
socket_connect($socket, $host, $port);
socket_write($socket, $output, strlen($output)) or die("Could not write output\n");
socket_close($socket);
echo "Envoi socket terminé";
