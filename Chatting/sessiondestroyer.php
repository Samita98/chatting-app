<?php
session_start();
session_unset();
session_destroy();
$serverName="localhost";
header('location:http://'.$serverName.'/chatting/Login.php');
?>