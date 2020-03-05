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
    $where[] = "title like '%.{params['title']}.%'";
  }
  if(!empty($params['player'])){
    $where[] = 'player <= ' . ((int)$params['player']);
    // $where[] = 'player <= ' . ((int)$params['player']) . ' AND player <= ' .(int)$params['player'];
  }
  if(!empty($params['time'])){
    $where[] = 'time <= ' . ((int)$params['time'] + 30) . ' AND time >= ' .(int)$params['time'];
  }
  if($where)
  {
    $whereSql = implode(' AND ', $where);
    $sql = 'select * from gamelist where ' . $whereSql;
    // $sql = 'SELECT * FROM gamelist WHERE time BETWEEN 2 AND 3 ' . $whereSql;
  } else {
    $sql = 'select * from gamelist';
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