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
    <title>成績管理システム</title>
    <link rel="stylesheet" href="style.css">
	<script src="Chart.js/Chart.min.js"></script>
</head>
<body>
	<canvas id="myChart" width="400" height="400"></canvas>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
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
    
    <!-- テーブル表示 -->
    <?php for($j = 1; $j < count($data[2]);$j +=2) { ?>
        <h3><?= $data[0][$j]?></h3>
        <table>
            <tr>
                <th>順位</th>
                <th>個人名</th>
            </tr>
            <?php for($i = 2;$i < count($data) - 2;$i++){ ?>
                <tr>
                    <td><?= $data[$i][0] ?></td>
                    <td><a href="personal.php?name=<?=$data[$i][$j]?>"><?= $data[$i][$j] ?></a></td>
                    <td><?= $data[$i][$j + 1] ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>

</body>
