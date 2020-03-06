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
  </head>
<body>
  <h1 class="col-xs-6 col-xs-offset-3">検索フォーム</h1>
  <div class="col-xs-6 col-xs-offset-3 well">

    <form method="get">
      <div class="form-group">
        <label for="InputTitle">タイトル</label>
        <input name="title" class="form-control" id="InputTitle" value="<?php print isset($_GET['title']) ? htmlspecialchars($_GET['title']) : '' ?>">
      </div>
      <div class="form-group">
        <label for="InputPlayer">人数</label>
        <select name="player" class="form-control" id="InputPlayer">
          <option value="0" <?php print isset($_GET['player']) ? 'selected' : '' ?>>選択しない</option>
          <option value="1" <?php print isset($_GET['player']) && $_GET['player'] == '1' ? 'selected' : '' ?>>1人</option>
          <option value="2" <?php print isset($_GET['player']) && $_GET['player'] == '2' ? 'selected' : '' ?>>2人</option>
          <option value="3" <?php print isset($_GET['player']) && $_GET['player'] == '3' ? 'selected' : '' ?>>3人</option>
          <option value="4" <?php print isset($_GET['player']) && $_GET['player'] == '4' ? 'selected' : '' ?>>4人</option>
          <option value="5" <?php print isset($_GET['player']) && $_GET['player'] == '5' ? 'selected' : '' ?>>5人以上</option>
        </select>
      </div>
      <div class="form-group">
        <label for="InputTime">時間</label>
        <select name="time" class="form-control" id="InputTime">
          <option value="0" <?php print isset($_GET['time']) ? 'selected' : '' ?>>選択しない</option>
          <option value="30" <?php print isset($_GET['time']) && $_GET['time'] == '1' ? 'selected' : '' ?>>30分以下</option>
          <option value="60" <?php print isset($_GET['time']) && $_GET['time'] == '2' ? 'selected' : '' ?>>30〜60分</option>
          <option value="90" <?php print isset($_GET['time']) && $_GET['time'] == '3' ? 'selected' : '' ?>>60〜90分</option>
          <option value="120" <?php print isset($_GET['time']) && $_GET['time'] == '4' ? 'selected' : '' ?>>90〜120分</option>
          <option value="121" <?php print isset($_GET['time']) && $_GET['time'] == '5' ? 'selected' : '' ?>>120分以上</option>
        </select>
      </div>
      <button type="submit" class="btn btn-default" name="search">検索</button>
    </form>
  </div>
  <div class="col-xs-6 col-xs-offset-3">
    <?php if(isset($gameData) && count($gameData)): ?>
      <p class="alert alert-success"><?php print count($gameData) ?>件見つかりました！</p>
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
            <td><?php print htmlspecialchars($row['title']) ?></td>
            <td><?php print htmlspecialchars($row['min_player']);
                      print '〜';
                      print htmlspecialchars($row['max_player']); ?>人</td>  
            <td><?php print htmlspecialchars($row['min_time']);
                      print '〜';
                      print htmlspecialchars($row['max_time']); ?>分</td>  
            </td>  
          </tr>
        <?php endforeach; ?>
      </tbody>
      </table>
      <?php else: ?>
        <p class="alert alert-danger">見つかりませんでした！</p>
      <?php endif; ?>
  </div>
  
  </body>
</html>