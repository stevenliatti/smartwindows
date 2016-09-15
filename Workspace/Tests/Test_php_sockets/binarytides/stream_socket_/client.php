<?php

$fp = stream_socket_client("127.0.0.1:4444", $errno, $errstr, 30);

if (!$fp) {
	echo "$errstr ($errno)<br />n";
}
else {
	$out = "GET / HTTP/1.1\r\n\r\n";
	///Send data
	fwrite($fp, $out);
	
	///Receive data - in small chunks :)
	while (!feof($fp)) {
		echo fgets($fp, 128);
	}
	
	fclose($fp);
}
