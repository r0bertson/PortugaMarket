<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn_loyalty = "localhost";
$database_conn_loyalty = "loyaltyscheme";
$username_conn_loyalty = "root";
$password_conn_loyalty = "";
$conn_loyalty = mysql_pconnect($hostname_conn_loyalty, $username_conn_loyalty, $password_conn_loyalty) or trigger_error(mysql_error(),E_USER_ERROR); 
?>