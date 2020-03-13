<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$charset = "utf8";
$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$dbname = substr($url["path"], 1);

?>