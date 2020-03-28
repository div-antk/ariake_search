<?php

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
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  </head>
<body>

<div class="container">

  <div class="blog-header">
    <h1 class="blog-title">有明亭ゲーム検索</h1>
    <p class="lead blog-description">ver.1.2</p>
  </div>

    <!-- <div class="col-xs-offset-1 col-xs-10 well"> -->
    <div class="col-xs-12 col-sm-4 well">
      <form method="GET">
        <div class="form-group">
          <label for="InputTitle"><i class="fas fa-dice"></i> タイトル</label>
          <input type="text" placeholder="タイトルを入力" name="title" class="form-control" id="InputTitle" style="width:160px"
          value="<?php print isset($_GET['title']) ? htmlspecialchars($_GET['title']) : '' ?>">
        </div>
        <div class="form-group">
          <label for="InputPlayer"><i class="fas fa-user"></i> 人数</label>
          <select name="player" class="form-control" id="InputPlayer" style="width:150px">
            <option value="0" <?php print empty($_GET['player']) ?>>選択しない</option>
            <option value="1" <?php print isset($_GET['player'])?>>1人でもできる</option>
            <option value="2" <?php print isset($_GET['player'])?>>2人でもできる</option>
            <option value="3" <?php print isset($_GET['player'])?>>3人でもできる</option>
            <option value="4" <?php print isset($_GET['player'])?>>4人でもできる</option>
            <option value="5" <?php print isset($_GET['player'])?>>5人以上でできる</option>
          </select>
        </div>
        <div class="form-group">
          <label for="InputMaxPlayer"><i class="fas fa-users"></i> ゲームの最大人数</label>
          <!-- 数字以外は入力することができない。また、コピペでフォームに入力させない。 -->
            <input type="text" name="maxplayer" class="form-control" id="InputTitle" style="width:46px" pattern="\d*" oncopy="return false" onpaste="return false" style="ime-mode:disabled"
              value="<?php print isset($_GET['maxplayer']) ? htmlspecialchars($_GET['maxplayer']) : '' ?>">
        </div>
        <div class="form-group">
          <label for="InputTime"><i class="fas fa-hourglass-half"></i> 時間</label>
          <select name="time" class="form-control" id="InputTime" style="width:128px">
            <option value="0" <?php print empty($_GET['time']) ?>>選択しない</option>
            <option value="30" <?php print isset($_GET['time']) ?>>30分以下</option>
            <option value="60" <?php print isset($_GET['time']) ?>>30〜60分</option>
            <option value="90" <?php print isset($_GET['time']) ?>>60〜90分</option>
            <option value="120" <?php print isset($_GET['time']) ?>>90〜120分</option>
            <option value="121" <?php print isset($_GET['time']) ?>>120分以上</option>
          </select>
        </div>
        <br>
        <br>
        <button type="submit" class="btn btn-default" name="search">検索</button>
      </form>
    </div>

    <div class="col-xs-12 col-sm-8">
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
              <td style="width:360px"><?php print htmlspecialchars($row['title']) ;?></td>
              <td style="width:128px"><?php if($row['min_player'] != $row['max_player'] && $row['skip'] == TRUE){
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
  </div>
</div>

  </body>
</html>