<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conn_payment = "localhost";
$database_conn_payment = "payment_db";
$username_conn_payment = "root";
$password_conn_payment = "";
$conn_payment = mysql_pconnect($hostname_conn_payment, $username_conn_payment, $password_conn_payment) or trigger_error(mysql_error(),E_USER_ERROR); 
?>