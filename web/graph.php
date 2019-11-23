<?php
    require_once("FileReader.php");

    // GET
    $name = $_GET["name"];

    // ディレクトリパス定義
    $root_dir = "https://github.com/daicho/mahjong/raw/master/";
    $system_dir = urlencode("麻雀同好会3rd") . "/";
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
    <canvas id="myChart" width="100" height="100"></canvas>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type:'line',
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
            label: '# of Votes',
            data: [
                <?php
                for ($i = 1; $i < count($data); $i++) {
                    if ($data[$i][10] == "") break;
                    echo str_replace("±", "", $data[$i][11]) . ", ";
                }
                ?>
            ],
            backgroundColor: 'rgba(0, 0, 0, 0)',
            borderColor: 'rgba(255, 99, 132, 1)',
            lineTension: 0,
            borderWidth: 4
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
    <h1>競技麻雀同好会 成績管理システム</h1>
    <h2>ランキング</h2>

</body>
