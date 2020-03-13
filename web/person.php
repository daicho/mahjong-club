<?php
    require_once("FileReader.php");

    session_start();

    // ログイン判定
    if (!isset($_SESSION["LOGIN"])) {
        header("Location: /login.php");
        exit();
    }

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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title><?= $name ?>の成績 - 成績管理システム | 競技麻雀同好会</title>
        <link rel="stylesheet" href="/css/common.css">
        <link rel="stylesheet" href="/css/person.css">
        <script src="/Chart.js/Chart.min.js"></script>
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

        <h1 class="name"><?= $name ?></h1>

        <div class="switch_btn">
            <div class="left_btn" onclick="leftClick()">
                <div class="left_btn_range"></div>
            </div>
            <h2 class="grade_type">成績</h2>
            <div class="right_btn" onclick="rightClick()">
                <div class="right_btn_range"></div>
            </div>
        </div>

        <!-- 「成績」のセクション -->
        <section class="grade" id="grade"> 
            <?php if ($name != "全体") { ?>
                <div class="figure" id="grade_figure">
                    <canvas id="score_graph"></canvas>
                </div>
            <?php } ?>

            <div class="item">
                <?php for ($i = 1; $i <= 31; $i++) { ?>
                    <?php if ($name == "全体" && $i >= 27 && $i <= 28) continue; ?>

                    <div class="each_item">
                        <p class="param1"><?= $data[$i][0] ?></p>
                        <p class="param2"></p>
                        <p class="param3"><?= $data[$i][1] ?></p>
                        <p class="param4"><?= ($i >= 23 && $i <= 28) ? "" : $data[$i][2] ?></p>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- 「役」のセクション -->
        <section class="grade" id="role"> 
            <div class="item">
                <?php for ($i = 1; $i < count($data) && $data[$i][4] != ""; $i++) { ?>
                    <div class="each_item">
                        <p class="param1"><?= $data[$i][5] ?></p>
                        <p class="param2"><?= $data[$i][6] ?></p>

                        <?php if (strlen($data[$i][7]) <= 6) { ?>
                            <p class="param3"><?= $data[$i][7] ?></p>
                        <?php } else { ?>
                            <p class="param3"><?= substr($data[$i][7], 0, 5) . "%" ?></p>
                        <?php } ?>

                        <p class="param4"><?= $data[$i][8] ?></p>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- 「アガリ翻数」のセクション -->
        <section class="grade" id="win"> 
            <?php if ($name != "全体") { ?>
                <div class="figure" id="win_figure">
                    <canvas id="fan_graph"></canvas>
                </div>
            <?php } ?>

            <div class="item">
                <?php for ($i = 34; $i <= 46; $i++) { ?>
                    <?php if ($name == "全体" && $i >= 42 && $i <= 43) continue; ?>

                    <div class="each_item">
                        <p class="param1"><?= $data[$i][0] ?></p>
                        <p class="param2"></p>
                        <p class="param3"><?= $data[$i][1] ?></p>
                        <p class="param4"><?= $data[$i][2] ?></p>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- 「局別収支」のセクション -->
        <section class="grade" id="kyokubetsu"> 
            <div class="figure" id="kyoku_figure">
                <canvas id="kyoku_graph"></canvas>
            </div>

            <div class="item">
                <?php for ($i = 1; $i <= 8; $i++) { ?>
                    <div class="each_item">
                        <p class="param1"><?= $data[$i][13] ?></p>
                        <p class="param2"></p>
                        <p class="param3"><?= $data[$i][14] ?></p>
                        <p class="param4"><?= $data[$i][15] ?></p>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- 「開始位置別スコア」のセクション -->
        <section class="grade" id="score"> 
            <div class="item">
                <?php for ($i = 11; $i <= 14; $i++) { ?>
                    <div class="each_item">
                        <p class="param1"><?= $data[$i][13] ?></p>
                        <p class="param2"></p>
                        <p class="param3"><?= $data[$i][14] ?></p>
                        <p class="param4"><?= $data[$i][15] ?></p>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- 「相性」のセクション -->
        <section class="grade" id="aisho"> 
            <div class="item">
                <?php for ($i = 17; $i < count($data) && $data[$i][13] != ""; $i++) { ?>
                    <div class="each_item">
                        <p class="param1"><?= $data[$i][13] ?></p>
                        <p class="param2"></p>
                        <p class="param3"><?= $data[$i][14] ?></p>
                        <p class="param4"><?= $data[$i][15] ?></p>
                    </div>
                <?php } ?>
            </div>
        </section>

        <div class="switch_btn">
            <div class="left_btn" onclick="leftClick()">
                <div class="left_btn_range"></div>
            </div>
            <h2 class="grade_type">成績</h2>
            <div class="right_btn" onclick="rightClick()">
                <div class="right_btn_range"></div>
            </div>
        </div>

        <footer>
            <p>&copy; 2020 長野高専競技麻雀同好会</p>
        </footer>

        <script>
            var ctxScore = document.getElementById("score_graph").getContext("2d");
            var chartScore = new Chart(ctxScore, {
                type: "line",
                data: {
                    labels: [
                        <?php
                        for ($i = 1; $i < count($data); $i++) {
                            if ($data[$i][10] == "") break;
                            echo "'" . $data[$i][10] . "', ";
                        }
                        ?>
                    ],
                    datasets: [{
                        label: "スコア",
                        data: [
                            <?php
                            for ($i = 1; $i < count($data); $i++) {
                                if ($data[$i][10] == "") break;
                                echo str_replace("±", "", $data[$i][11]) . ", ";
                            }
                            ?>
                        ],
                        borderColor: "rgba(255, 99, 132, 1)",
                        borderWidth: 4,
                        lineTension: 0,
                        fill: false,
                        pointBackgroundColor: "rgba(0, 0, 0, 0)",
                        pointBorderColor: "rgba(0, 0, 0, 0)"
                    }]
                }
            });

            let ctxFan = document.getElementById("fan_graph").getContext("2d");
            let chartFan  = new Chart(ctxFan, {
                type: "bar",
                data:{
                    labels: [
                        <?php
                        for ($i = 34; $i < count($data); $i++) {
                            if ($data[$i][0] == "") break;
                            echo "'" . $data[$i][0] . "', ";
                        }
                        ?>
                    ],
                    datasets: [{
                        label: "あがり翻数",
                        data: [
                            <?php
                            for ($i = 34; $i < count($data); $i++) {
                                if ($data[$i][0] == "") break;
                                echo str_replace("回", "", $data[$i][1]) . ", ";
                            }
                            ?>
                        ],
                        borderColor: "rgba(255, 99, 132, 1)",
                        backgroundColor:"rgba(255,99,132,0.3)",
                        borderWidth: 4,
                    }]

                }
            });
        
            let ctxKyoku = document.getElementById("kyoku_graph").getContext("2d");
            let chartKyoku  = new Chart(ctxKyoku, {
                type: "line",
                data:{
                    labels: [
                        <?php
                        for ($i = 1; $i < count($data); $i++) {
                            if ($data[$i][13] == "") break;
                            echo "'" . $data[$i][13] . "', ";
                        }
                        ?>
                    ],
                    datasets: [{
                        label: "局別スコア",
                        data: [
                            <?php
                            for ($i = 1; $i < count($data); $i++) {
                                if ($data[$i][13] == "") break;
                                echo str_replace("±", "", $data[$i][14]) . ", ";
                            }
                            ?>
                        ],
                        borderColor: "rgba(255, 99, 132, 1)",
                        borderWidth: 4,
                        lineTension: 0,
                        fill: false,
                        pointBackgroundColor: "rgba(0, 0, 0, 0)",
                        pointBorderColor: "rgba(0, 0, 0, 0)"
                    }]

                }
            });
        </script>

        <script type="text/javascript" src="/js/person.js"></script>
    </body>
</html>