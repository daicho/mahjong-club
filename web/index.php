<?php
    require_once("FileReader.php");

    // ディレクトリパス定義
    $root_dir = "https://github.com/daicho/mahjong-club/raw/master/";
    $system_dir = urlencode("成績管理システム") . "/";
    $seiseki_dir = $system_dir . urlencode("成績") . "/";
    
    $fileReader = new FileReader($root_dir);
    $data = $fileReader->loadCSV($seiseki_dir . urlencode("ランキング") . ".csv");
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
    <?php for($j = 1; $j < count($data[2]);$j +=2) { ?>
        <h3><?= $data[0][$j]?></h3>
        <table>
            <tr>
                <th>順位</th>
                <th>個人名</th>
            </tr>
            <?php for($i = 2;$i < count($data) - 2;$i++){ ?>
                <tr>
                    <td><?= $data[$i][0] ?></td>
                    <td><a href="personal.php?name=<?=$data[$i][$j]?>"><?= $data[$i][$j] ?></a></td>
                    <td><?= $data[$i][$j + 1] ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>

</body>