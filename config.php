<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'root');
   define('DB_DATABASE', 'regcu');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   mysqli_select_db($db,"regcu");
   if(!$db) {
   	echo "unable to connect to database";
   }
   $host = "localhost";
   $username = "root";
   $password = "root";
   $dbname = "regcu";
   $dsn = "mysql:host = $host; dbname = $dbname; charset=utf8";
   $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
   
?>