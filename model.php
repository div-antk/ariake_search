<?php


try {


function getGameData($params){

  $filename = './isDevelopment.txt';

  // gitignoreにisDevelopment.txtを載せているため
  // isDevelopment.txtがある場合はローカル環境に切り替わる

  if (!file_exists($filename)){
  include_once('config/db_access.php');

  $Mysqli = new mysqli($server, $username, $password, $dbname);
  $Mysqli->set_charset('utf8');

  } else {
  include_once('config/db_access_local.php'); //ローカル環境用
  $Mysqli = new mysqli($host, $username, $password, $dbname); //ローカル環境用
  }

  if($Mysqli->connect_error){
    error_log($Mysqli->connect_error);
    exit;
  }

  $where = [];
  if(!empty($params['title'])){
    $where[] = "title LIKE '%{$params['title']}%'";
  }
  if(!empty($params['player'])){
    switch($_GET['player']) {
    case 1:
      $where[] = 'min_player = 1';
      break;
    case 2:
      $where[] = 'min_player <= 2 AND max_player != 1';
      break;
    case 3:
      // if($params['skip'] == TRUE){
      // $where[] = false;
      // } else {
      // $where[] = 'min_player <= 3 AND max_player > 2 ';
      // }
      // break;
      $where[] = 'min_player <= 3 AND max_player > 2';
      break;
    case 4:
      $where[] = 'min_player <= 4 AND max_player > 3';
      break;
    case 5:
      $where[] = 'min_player <= 5 AND max_player > 4';
      break;
    }
  }
  if(!empty($params['maxplayer'])){
    $where[] = "max_player = ${params['maxplayer']}";
  }
  if(!empty($params['time'])){
    switch($_GET['time']) {
    case 30:
      $where[] = 'max_time <= 30';
      break;
    case 60:
      $where[] = 'min_time >= 30 AND max_time <= 60';
      break;
    case 90:
      $where[] = 'min_time >= 60 AND max_time <= 90';
      break;
    case 120:
      $where[] = 'min_time >= 90 AND max_time <= 120';
      break;
    case 121:
      $where[] = 'max_time > 120';
      break;
    }
  }
  if($where){
    // implodeで配列に入れる
    $whereSql = implode(' AND ', $where);
    $sql = 'SELECT * FROM gamelist WHERE ' . $whereSql ;
  } else {
    $sql = 'SELECT * FROM gamelist';
    // $sql = print '';
  }
  
  $GameDataSet = $Mysqli->query($sql);  
  
  $result = [];
  while($row = $GameDataSet->fetch_assoc()){
    $result[] = $row;
  }
  return $result;
}
}

catch (PDOException $e)
{
  print 'ただいま障害により大変ご迷惑をおかけしております。<br>' .$e->getMessage()."<br>";
  exit();
}

?>