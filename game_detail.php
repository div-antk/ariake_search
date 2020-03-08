<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>有明亭ゲーム検索</title>
  </head>
<body>

<?php

try
{

  $dsn = 'mysql:dbname=gamelist;host=localhost;charset=utf8';
  $user = 'root';
  $password = '';
  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT title,min_player,max_player,min_time,max_time FROM gamelist WHERE 1';
  $stmt = $dbh->prepare($sql);
  $stmt->execute();

  $dbh = null;

  print '<br>ボードゲーム紹介<br>';

  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  
  print $rec['title'].' - ';
  print $rec['min_time'].'円';
  print '</a>';
  print '<br>';
}

catch (PDOException $e)
{
  print 'ただいま障害により大変ご迷惑をおかけしております。<br>' .$e->getMessage()."<br>";
  exit();
}

?>

</body>
</html>