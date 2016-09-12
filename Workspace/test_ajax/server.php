<?php

$request = array();
$response = array();

$request[0] = htmlspecialchars($_GET["mode"]);
$request[1] = htmlspecialchars($_GET["windowState"]);
$blindState = htmlspecialchars($_GET["blindState"]);
$request[2] = $blindState == "10" ? "t" : $blindState;

// if ($request[1] == "open") {
// 	$response[0] = "close";
// 	$response[1] = "La fenêtre est ouverte";
// }
// else {
// 	$response[0] = "open";
// 	$response[1] = "La fenêtre est fermée";
// }

//$response[2] = $request[1];

$host = "127.0.0.1";
$port = 2001;

$output = $request[0] . ":" . $request[1] . ":" . $request[2];

$socket1 = socket_create(AF_INET, SOCK_STREAM,0) or die("Could not create socket\n");

socket_connect($socket1, $host, $port);

socket_write($socket1, $output, strlen($output)) or die("Could not write output\n");

socket_close($socket1);

echo json_encode($request);