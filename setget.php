<?php
$socket = socket_create(AF_INET, SOCK_STREAM, 0);

if ($socket === false)
{
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    die("Socket creation failed: [$errorcode] $errormsg\n");

}
echo "socket created";
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);

$reuseAddrValue = socket_get_option($socket, SOL_SOCKET, SO_REUSEADDR);

if ($reuseAddrValue !== false) {
    echo "Value of SO_REUSEADDR: $reuseAddrValue\n";
} else {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    echo "Failed to get SO_REUSEADDR option: [$errorcode] $errormsg\n";
}

socket_close($socket);
?>