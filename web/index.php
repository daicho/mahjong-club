<?php
    require_once("FileReader.php");

    // ディレクトリパス定義
    $root_dir = "https://github.com/daicho/mahjong-club/raw/master/";
    $system_dir = urlencode("成績管理システム") . "/";
    $seiseki_dir = $system_dir . urlencode("成績") . "/";
    
    $fileReader = new FileReader($root_dir);
    $data = $fileReader->loadCSV($seiseki_dir . urlencode("ランキング") . ".csv")
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>成績管理システム</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>競技麻雀同好会 成績管理システム</h1>
    <h2>ランキング</h2>

    <!-- テーブル表示 -->
    <?php foreach ($data as $row) { ?>
        <tr>
            <?php foreach ($row as $cell) { ?>
                <td><?= $cell ?></td>
            <?php } ?>
        </tr>
    <?php } ?>
</body>
