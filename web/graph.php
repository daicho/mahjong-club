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
    <canvas id="score" width="400" height="400"></canvas>
    <script>
        var ctx = document.getElementById("score").getContext("2d");
        var myChart = new Chart(ctx, {
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
    </script>
</body>
