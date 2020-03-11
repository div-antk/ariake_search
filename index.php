<?php

print "test";

include_once('model.php');
$gameData = getGameData($_GET);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>有明亭ゲーム検索</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
  </head>
<body>
  <h1 class="col-xs-6 col-xs-offset-3">有明亭ゲーム検索</h1>
  <div class="col-xs-6 col-xs-offset-3 well">
    <form method="GET">
      <div class="form-group">
        <label for="InputTitle">タイトル</label>
        <input type="text" placeholder="タイトルを入力してください" name="title" class="form-control" id="InputTitle" style="width:240px"
        value="<?php print isset($_GET['title']) ? htmlspecialchars($_GET['title']) : '' ?>">
      </div>
      <div class="form-group">
        <label for="InputPlayer">人数</label>
        <select name="player" class="form-control" id="InputPlayer" style="width:128px">
          <option value="0" <?php print empty($_GET['player']) ?>>選択しない</option>
          <option value="1" <?php print isset($_GET['player'])?>>1人でもできる</option>
          <option value="2" <?php print isset($_GET['player'])?>>2人でもできる</option>
          <option value="3" <?php print isset($_GET['player'])?>>3人でもできる</option>
          <option value="4" <?php print isset($_GET['player'])?>>4人でもできる</option>
          <option value="5" <?php print isset($_GET['player'])?>>5人以上でできる</option>
        </select>
      </div>
      <div class="form-group">
        <label for="InputMaxPlayer">ゲームの最大人数</label>
        <input type="text" input name="maxplayer" class="form-control" id="InputTitle" style="width:46px"
          value="<?php print isset($_GET['maxplayer']) ? htmlspecialchars($_GET['maxplayer']) : '' ?>">
        <!-- <select name="maxplayer" class="form-control" id="InputMaxPlayer">
          <option value="0" <?php print empty($_GET['maxplayer']) ?>>選択しない</option>
          <option value="1" <?php print isset($_GET['maxplayer'])?>>1人</option>
          <option value="2" <?php print isset($_GET['maxplayer'])?>>2人</option>
          <option value="3" <?php print isset($_GET['maxplayer'])?>>3人</option>
          <option value="4" <?php print isset($_GET['maxplayer'])?>>4人</option>
          <option value="5" <?php print isset($_GET['maxplayer'])?>>5人以上</option>
        </select> -->
      </div>
      <div class="form-group">
        <label for="InputTime">時間</label>
        <select name="time" class="form-control" id="InputTime" style="width:128px">
          <option value="0" <?php print empty($_GET['time']) ?>>選択しない</option>
          <option value="30" <?php print isset($_GET['time']) ?>>30分以下</option>
          <option value="60" <?php print isset($_GET['time']) ?>>30〜60分</option>
          <option value="90" <?php print isset($_GET['time']) ?>>60〜90分</option>
          <option value="120" <?php print isset($_GET['time']) ?>>90〜120分</option>
          <option value="121" <?php print isset($_GET['time']) ?>>120分以上</option>
        </select>
      </div>
      <button type="submit" class="btn btn-default" name="search">検索</button>
    </form>
  </div>
  <div class="col-xs-6 col-xs-offset-3">


    <?php if(isset($gameData) && count($gameData)): ?>
      <p class="alert alert-success"><?php print count($gameData) ;?>件見つかりました！</p>
      <table class="table">
        <thead>
          <tr>
            <th>タイトル</th>
            <th>人数</th>
            <th>時間</th>
          </tr>
      </thead>
      <tbody>
        <?php foreach($gameData as $row): ?>
          <tr>
            <td><a href="game_detail.php"><?php print htmlspecialchars($row['title']) ;?></a></td>
            <td><?php if($row['min_player'] != $row['max_player'] && $row['skip'] == TRUE){
                        print htmlspecialchars($row['min_player']);
                        print 'か';
                        print htmlspecialchars($row['max_player']); 
                      } elseif($row['min_player'] != $row['max_player']) {
                        print htmlspecialchars($row['min_player']);
                        print '〜';
                        print htmlspecialchars($row['max_player']);
                      } else {
                        print htmlspecialchars($row['max_player']);
                      };
                      ?>人</td>  
            <td><?php if($row['min_time'] != $row['max_time']){
                        print htmlspecialchars($row['min_time']);
                        print '〜';
                        print htmlspecialchars($row['max_time']); 
                      } else {
                        print htmlspecialchars($row['max_time']);
                      };
                      ?>分</td>  
          </tr>
        <?php endforeach; ?>
      </tbody>
      </table>
      <?php else :?>
        <p class="alert alert-danger">見つかりませんでした！</p>
      <?php endif; ?>
  </div>
  
  </body>
</html>