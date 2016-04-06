<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn_core_clients = "localhost";
$database_conn_core_clients = "core_db";
$username_conn_core_clients = "root";
$password_conn_core_clients = "";
$conn_core_clients = mysql_pconnect($hostname_conn_core_clients, $username_conn_core_clients, $password_conn_core_clients) or trigger_error(mysql_error(),E_USER_ERROR); 
?>