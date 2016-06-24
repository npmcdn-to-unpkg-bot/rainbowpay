<?php
$db_hostname='localhost';
$db_database='rainbow';
$db_username='root';
$db_password='';

$db_server = mysql_connect($db_hostname, $db_username, $db_password);//connectinh

mysql_select_db($db_database);//selecting db
?>