<?php
error_reporting(E_ALL); // or E_STRICT
ini_set("display_errors",1);

function connection()
{
$conn = @mysqli_connect('localhost','root','','xoxo');
mysqli_set_charset($conn, "utf8");
ini_alter('date.timezone','Asia/Tehran');
date_default_timezone_set('Asia/Tehran');
return $conn;
}
// on each request check time and update expire dates
if (!connection()){
$conn=connection();
mysqli_error();
die();	
exit(0);
}


?>