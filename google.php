<?php
$socket = socket_create(AF_INET, SOCK_STREAM, 0);

if ($socket === false) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Socket Error: $errorcode Message: $errormsg\n");
}
echo "/n";
echo "Socket created successfully\n";
socket_clear_error();

$socket_connect = socket_connect($socket, 'www.google.com', 8082);

if ($socket_connect === false) {
    $errorcode1 = socket_last_error($socket);
    $errormsg1 = socket_strerror($errorcode1);
    die("Socket Error: $errorcode1 Message: $errormsg1\n");
}

echo "Connection Established\n";
// clears the errors
socket_clear_error();

$message = "GET / HTTP/1.1\r\nHost: www.google.com\r\n\r\n";

$socket_send = socket_send($socket, $message, strlen($message), 0);

if ($socket_send === false)
{
    $errorcode2 = socket_last_error($socket);
    $errormsg2 = socket_strerror($errorcode2);
    die("Could not send data: [$errorcode2] $errormsg2\n");

}

echo "Send successfully\n";
$socket_recv = socket_recv($socket,$var,2045,MSG_WAITALL);
if($socket_recv ===FALSE)
{
    $errorcode2 = socket_last_error($socket);
    $errormsg2 = socket_strerror($errorcode2);
    die("Could not send data: [$errorcode2] $errormsg2\n");

}
print_r($var);
socket_close($socket);
?>
