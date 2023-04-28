<?php
$host     = 'localhost';
$db       = 'cw55120_chfood';
$user     = 'cw55120_chfood';
$password = 'zxJK8yiU';
$port     = 3306;
$charset  = 'utf8mb4';


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$db = new mysqli($host, $user, $password, $db, $port);
$db->set_charset($charset);
$db->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, 1);
