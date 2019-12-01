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
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>成績管理システム</title>
    <link rel="stylesheet" href="/css/ranking.css">
</head>
<body>
    <h1>競技麻雀同好会 成績管理システム</h1>
    <h2>ランキング</h2>
    
    <!-- テーブル表示 -->
    <div class='ranking-container'>
        <?php for ($j = 1; $j < count($data[2]);$j +=2) { ?>
            <div class='ranking-table'>
                <h3><?= $data[0][$j] ?></h3>
                <table>
                    <tr>
                        <th>順位</th>
                        <th>個人名</th>
                    </tr>
                    <?php 
                    $rank = 1;
                    $disprank = 1;
                    ?>
                    <?php for ($i = 2; $i < count($data); $i++) { ?>
                        <tr>
                            <?php if($data[$i][$j + 1] != $data[$i - 1][$j + 1]){ 
                                $disprank = $rank;
                            }
                            if("全体" != $data[$i][$j]){
                                $rank++;
                            ?>
                                <td><?=  $disprank . "位"?></td>
                            <?php }else {?>
                                <td></td>
                            <?php } ?>
                            <td><a href="/personal/<?= $data[$i][$j] ?>"><?= $data[$i][$j] ?></a></td>
                            <td><?= $data[$i][$j + 1] ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        <?php } ?>
    </div>

</body>
