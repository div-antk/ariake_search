<?php

// $host = "us-cdbr-iron-east-04.cleardb.net";
// $username = "b4ba67588307c0";
// $password = "5aed9396";
// $dbname = "gamelist";

$url = parse_url(getenv("mysql://b4ba67588307c0:5aed9396@us-cdbr-iron-east-04.cleardb.net/heroku_5ce85d9671bf98b?reconnect=true"));
$server = $url["CLEARDB_DATABASE_URL"];
$username = $url["b4ba67588307c0"];
$password = $url["5aed9396"];
$dbname = substr($url["mysql://b4ba67588307c0:5aed9396@us-cdbr-iron-east-04.cleardb.net/heroku_5ce85d9671bf98b?reconnect=true"], 1);
// $conn = new mysqli($server, $username, $password, $db);


// function dbConnect(){
//   $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
//   $db['gamelist'] = ltrim($db['mysql://b4ba67588307c0:5aed9396@us-cdbr-iron-east-04.cleardb.net/heroku_5ce85d9671bf98b?reconnect=true'], '/');
//   $dsn = "mysql:host={$db['us-cdbr-iron-east-04.cleardb.net']};dbname={$db['gamelist']};charset=utf8";
//   $user = $db['b4ba67588307c0'];
//   $password = $db['5aed9396'];
//   $options = array(
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//     PDO::MYSQL_ATTR_USE_BUFFERED_QUERY =>true,
//   );
//   $dbh = new PDO($dsn,$user,$password,$options);
//   return $dbh;
// }

?>