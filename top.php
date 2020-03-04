<?php
try
{

// $post = sanitize($_POST);
// $staff_name = $post['name'];
// $staff_pass = $post['pass'];

// データベースに接続
$dsn = 'mysql:dbname=gamelist;host=localhost;charset=utf8';
$user = 'root';
$password = '';
$dbh = new PDO($dsn, $user, $password);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// SQL文を使ってレコードを追加
$sql = 'SELECT * FROM gamelist(title) VALUES (?)';
$stmt = $dbh->prepare($sql);
// $stmt->execute($data);

// データベースから切断
// $dbh = null;

}
catch (Exception $e)
{
  print 'ただいま障害により大変ご迷惑をおかけしております。';
  exit(); // 強制終了
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>有明亭検索</title>
  </head>
<body>

<form action="top.php" method="post">
  <input type="text" name="title">
  <input type="submit" name="submit" value="送信">
  </form>
    <table>
        <tr><th>title</th></tr>
        <?php foreach ($stmt as $row): ?>
            <tr><td><?php echo $row[0]?></td><td>
              <?php echo $row[1]?></td></tr>
        <?php endforeach; ?>
    </table>
</body>
</html>