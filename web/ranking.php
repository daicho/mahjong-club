<?php
    define('MJHAI_NUM', 34);

    require_once("FileReader.php");

    // ハッシュ関数
    function iconhash($string, $range) {
        return hexdec(substr(md5($string), 0, 4)) % $range;
    }

    session_start();

    // ログイン判定
    if (!isset($_SESSION["LOGIN"])) {
        header("Location: /login.php");
        exit();
    }

    // ディレクトリパス定義
    $root_dir = "https://github.com/daicho/mahjong-club/raw/master/";
    $system_dir = urlencode("成績管理システム") . "/";
    $seiseki_dir = $system_dir . urlencode("成績") . "/";

    $fileReader = new FileReader($root_dir);
    $data = $fileReader->loadCSV($seiseki_dir . urlencode("ランキング") . ".csv");
    $players = $fileReader->loadLines($seiseki_dir . "Players.txt");
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>ランキング - 成績管理システム | 競技麻雀同好会</title>
        <link rel="stylesheet" href="/css/common.css">
        <link rel="stylesheet" href="/css/ranking.css">
        <script>
            (function(d) {
                var config = {
                kitId: 'evc7hwv',
                scriptTimeout: 3000,
                async: true
                },
                h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
            })(document);
        </script>
    </head>

    <body>
        <header class="header_block">
            <a href="/">
                <img class="logo" src="/svg/logo.svg" alt="競技麻雀同好会のロゴ">
            </a>
        </header>

        <div class="switch">
            <div class="line"></div>

            <div class="rank" onclick="rankClick()">
                <img id="rank_img" src="/svg/rank_fill.svg" alt="">
                <p>ランキング</p>
            </div>

            <div class="man" onclick="manClick()">
                <img id="man_img" src="/svg/man_frame.svg" alt="">
                <p>会員</p>
            </div>
        </div>

        <!-- ランキング -->
        <section id="rank_block">
            <?php $index = 1; ?>
            <?php for ($i = 1; $i < count($data[2]); $i += 2) { ?>
                <input id="check<?= $index ?>" class="check_flag" type="checkbox">
                <label class="rank_type" for="check<?= $index ?>">
                    <p class=""><?= $data[0][$i] ?></p>
                    <img src="/svg/under_arrow.svg" alt="">
                </label>

                <div class="ranking">
                    <?php $rank = 1; $disprank = 1; ?>
                    <?php for ($j = 2; $j < count($data); $j++) { ?>
                        <a class="name_block" href="/personal/<?= $data[$j][$i] ?>">
                            <?php if($data[$j][$i + 1] != $data[$j - 1][$i + 1]) { 
                                $disprank = $rank;
                            }
                            ?>
                            <div class="indent"></div>
                            <?php
                            if("全体" != $data[$j][$i]) {
                                $rank++;
                            ?>
                                <p class="rank_num"><?= $disprank ?></p>
                            <?php } else {?>
                                <p class="rank_totally"></p>
                            <?php } ?>
                            <p class="name"><?= $data[$j][$i] ?></p>
                            <p class="score"><?= $data[$j][$i + 1] ?></p>
                            <img class="arrow" src="/svg/arrow_trans.svg" alt="">
                        </a>
                    <?php } ?>

                    <label class="close" for="check<?= $index ?>">
                        <img class="close_btn" src="/svg/close.svg" alt="">
                        <p>閉じる</p>
                    </label>
                </div>

                <?php $index++; ?>
            <?php } ?>
        </section>

        <!-- 会員 -->
        <section id="member_block">
            <?php for ($i = 0; $i < count($players); $i++) { ?>
                <a class="name_block" href="/personal/<?= $players[$i] ?>">
                    <img class="mjhai" src="/svg/mjhai/<?= iconhash($players[$i], MJHAI_NUM) ?>.svg" alt="">
                    <p class="name"><?= $players[$i] ?></p>
                    <img class="arrow" src="/svg/arrow_trans.svg" alt="">
                </a>
            <?php } ?>
        </section>

        <footer>
            <p>&copy; 2020 長野高専競技麻雀同好会</p>
        </footer>

        <script type="text/javascript" src="/js/ranking.js"></script>
    </body>
</html>
