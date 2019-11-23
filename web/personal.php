<?php
    require_once("FileReader.php");

    // GET
    $name = $_GET["name"];

    // ディレクトリパス定義
    $root_dir = "https://github.com/daicho/mahjong-club/raw/master/";
    $system_dir = urlencode("成績管理システム") . "/";
    $seiseki_dir = $system_dir . urlencode("成績") . "/";
    
    $fileReader = new FileReader($root_dir);
    $data = $fileReader->loadCSV($seiseki_dir . urlencode($name) . ".csv");
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
    <h2><?= $name ?></h2>

    <h3>成績</h3>
    <table>
        <?php for ($i = 1; $i < 32; $i++) { ?>
            <tr>
                <?php for ($j = 0; $j < 3; $j++) { ?>
                    <td><?= $data[$i][$j] ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </table>
</body>
