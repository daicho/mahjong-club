<?php
    require_once("FileReader.php");

    //GET
	$name = $_GET["name"];

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
	<script src="Chart.js/Chart.min.js"></script>
</head>
<body>
	<canvas id="myChart" width="400" height="400"></canvas>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type:'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3, 5],
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
