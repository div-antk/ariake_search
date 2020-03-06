<?php
function getGameData($params){
  include_once('config/db_access.php');

  $Mysqli = new mysqli($host, $username, $password, $dbname);
  if($Mysqli->connect_error){
    error_log($Mysqli->connect_error);
    exit;
  }

  $where = [];
  if(!empty($params['title'])){
    $where[] = "title LIKE '%{$params['title']}%'";
  }
  // if(!empty($params['min_player' && 'max_player'])){
  if(!empty($params['min_player'])){
    switch($_GET['player']) {
    case '1':
      $where[] = "min_player = 1";
      break;
    case 2:
      $where[] = 'min_player <= 3';
      break;
    }
    // $where[] = 'min_player <= ' . ((int)$params['player']);
    // $where[] = 'player <= ' . ((int)$params['player']) . ' AND player <= ' .(int)$params['player'];
  }
  if(!empty($params['time'])){
    $where[] = 'min_time <= ' . ((int)$params['time']);
    // $where[] = 'time <= ' . ((int)$params['time'] + 30) . ' AND time >= ' .(int)$params['time'];
  }
  if($where)
  {
    // implodeで配列に入れる
    $whereSql = implode('AND', $where);
    $sql = 'SELECT * FROM gamelist WHERE ' . $whereSql;
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
?>