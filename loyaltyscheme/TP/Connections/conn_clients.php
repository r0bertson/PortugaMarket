<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn_clients = "localhost";
$database_conn_clients = "loyaltyscheme";
$username_conn_clients = "root";
$password_conn_clients = "";
$conn_clients = mysql_pconnect($hostname_conn_clients, $username_conn_clients, $password_conn_clients) or trigger_error(mysql_error(),E_USER_ERROR); 
?>