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
    <script src="Chart.js/Chart.min.js"></script>
</head>
<body>
    <div style="width:50%;">
        <h1>スコア</h1>
        <canvas id="score" ></canvas>
    </div>
    <div style="width:50%;">
        <h1>局別スコア</h1>
        <canvas id="byStationScore"></canvas>
    </div>
    <div style="width:50%;">
        <h1>あがり翻数</h1>
        <canvas id="fanScore"></canvas>
    </div>
    <script>
        var ctx = document.getElementById("score").getContext("2d");
        var myScore = new Chart(ctx, {
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
    
        let ctxByStation = document.getElementById('byStationScore').getContext('2d');
        let myScoreByStation  = new Chart(ctxByStation, {
            type: 'line',
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


        let ctxfan = document.getElementById('fanScore').getContext('2d');
        let myFanScore  = new Chart(ctxfan, {
            type: 'bar',
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
    </script>
</body>
