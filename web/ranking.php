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
    <title>成績管理システム | 競技麻雀同好会</title>
    <link rel="stylesheet" href="/css/ranking.css">
</head>
<body>
    <header class="header_block">
        <a href="">
        <img src="/design/svg/logo.svg" class="logo"alt="競技麻雀同好会のロゴ">
        </a>
    </header>

    <div class="switch">
        <div class="line"></div>

        <div class="rank" onclick="rank_click()">
            <img id="rank_img" src="/design/svg/rank_fill.svg" alt="">
            <p>ランキング</p>
        </div>

        <div class="man" onclick="man_click()">
            <img id="man_img" src="/design/svg/man_frame.svg" alt="">
            <p>参加者</p>
        </div>
    </div>
    <!-- ランキング -->
    <?php for ($j = 1; $j < count($data[2]);$j +=2) { ?>
        <section id="rank_block">
            <input id="check<?= $j?>" class="check_flag"type="checkbox">
            <label class="rank_type" for="check<?=$j?>">
                <p class=""><?= $data[0][$j] ?></p>
                <img src="/design/svg/under_arrow.svg" alt="">
            </label>
            <div class="ranking">
                    <?php 
                    $rank = 1;
                    $disprank = 1;
                    ?>
                    <?php for ($i = 2; $i < count($data); $i++) { ?>
                        <a class="name_block" href="/personal/<?= $data[$i][$j] ?>">
                            <?php if($data[$i][$j + 1] != $data[$i - 1][$j + 1]){ 
                                $disprank = $rank;
                            }
                            if("全体" != $data[$i][$j]){
                                $rank++;
                            ?>
                                <p class="rank_num"><?= $disprank ?></p>
                            <?php }else {?>
                                <p class="rank_num"></p>
                            <?php } ?>
                            <p class="name"><?= $data[$i][$j]?></p>
                            <p class="score"><?= $data[$i][$j + 1]?></p>
                            <img class="arrow" src="/design/svg/arrow_trans.svg" alt="">
                        </a>
                    <?php } ?>

            </div>
        </section>
    <?php } ?>
    <script type="text/javascript" src="/design/JS/test.js"></script>
</body>
