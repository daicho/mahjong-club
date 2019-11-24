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
        <?php
        for ($i = 1; $i <= 31; $i++) {
            echo "<tr>";
            for ($j = 0; $j <= 2; $j++) {
                echo "<td>";
                if ($j != 2 || $i < 23 || 28 < $i)
                    echo $data[$i][$j];
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <h3>役</h3>
    <table>
        <?php
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i][4] == "") break;

            echo "<tr>";
            for ($j = 5; $j <= 8; $j++) {
                echo $i == 0 ? "<th>" : "<td>";
                echo $data[$i][$j];
                echo $i == 0 ? "</th>" : "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <h3>アガリ翻数</h3>
    <table>
        <?php
        for ($i = 33; $i <= 46; $i++) {
            echo "<tr>";
            for ($j = 0; $j <= 2; $j++) {
                echo $i == 33 ? "<th>" : "<td>";
                echo $data[$i][$j];
                echo $i == 33 ? "</th>" : "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <h3>局別収支</h3>
    <table>
        <?php
        for ($i = 0; $i <= 8; $i++) {
            echo "<tr>";
            for ($j = 13; $j <= 15; $j++) {
                echo $i == 0 ? "<th>" : "<td>";
                echo $data[$i][$j];
                echo $i == 0 ? "</th>" : "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <h3>開始位置別スコア</h3>
    <table>
        <?php
        for ($i = 10; $i <= 14; $i++) {
            echo "<tr>";
            for ($j = 13; $j <= 15; $j++) {
                echo $i == 10 ? "<th>" : "<td>";
                echo $data[$i][$j];
                echo $i == 10 ? "</th>" : "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>

    <h3>相性</h3>
    <table>
        <?php
        for ($i = 16; $i <= count($data); $i++) {
            if ($data[$i][13] == "") break;

            echo "<tr>";
            for ($j = 13; $j <= 15; $j++) {
                echo $i == 16 ? "<th>" : "<td>";
                echo $data[$i][$j];
                echo $i == 16 ? "</th>" : "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
