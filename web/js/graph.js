// グラフ統一の設定
let option = {
    responsive: true,
    chartArea: {
        backgroundColor: "rgb(17, 25, 38)"
    },
    legend: {
        display: false
    },
    scales: {
        xAxes: [{
            gridLines:{
                display: false,
            },
            ticks: {
                display: true,
                fontColor: "rgb(227, 211, 198)",
                fontSize: 18
            },
        }],
        yAxes: [{
            gridLines: {
                display: true,
                drawBorder: false,
                color: "rgb(227, 211, 198)",
                zeroLineWidth: 1,
                zeroLineColor: "rgb(227, 211, 198)"
            },
            ticks: {
                display: true,
                fontColor: "rgb(227, 211, 198)",
                fontSize: 18,
                precision: 0
            }
        }]
    },
    chartArea: {
        backgroundColor: "rgb(17, 25, 38)"
    },
};

// 軸の書式設定
optionScore = JSON.parse(JSON.stringify(option));
optionScore.scales.yAxes[0].ticks.callback = (value, index, values) => {
    if (value == 0)
        return "±0";
    else if (value > 0)
        return "+" + value;
    else
        return value;
};

// 通算スコア
const viewScoreGraph = () => {
    let ctxScore = document.getElementById("score_graph").getContext("2d");
    let chartScore = new Chart(ctxScore, {
        type: "scatter",
        data: {
            datasets: [{
                label: "スコア",
                data: dataScore,
                showLine: true,
                borderColor: "rgb(226, 199, 85)",
                borderWidth: 4,
                lineTension: 0,
                fill: false,
                pointRadius: 0,
            }]
        },
        options: optionScore
    });
}

// アガリ翻数
const viewFanGraph = () => {
    let ctxFan = document.getElementById("fan_graph").getContext("2d");

    // グラデーション作成
    let height = window.innerHeight || document.body.clientHeight;
    let gradientStroke = ctxFan.createLinearGradient(0, 0, 0, height);
    gradientStroke.addColorStop(0, "rgb(226, 199, 85)");
    gradientStroke.addColorStop(0.5, "rgba(0, 0, 0, 0)");

    let chartFan = new Chart(ctxFan, {
        type: "bar",
        data:{
            labels: labelFan,
            datasets: [{
                label: "出現回数",
                data: dataFan,
                borderColor: "rgb(226, 199, 85)",
                backgroundColor: gradientStroke,
                borderWidth: 2,
                categoryPercentage: 1.2
            }]
        },
        options: option
    });
}

// 局別収支
const viewKyokuGraph = () => {
    // 軸の書式設定
    let ctxKyoku = document.getElementById("kyoku_graph").getContext("2d");
    let chartKyoku = new Chart(ctxKyoku, {
        type: "line",
        data: {
            labels: labelKyoku,
            datasets: [{
                label: "収支",
                data: dataKyoku,
                borderColor: "rgb(226, 199, 85)",
                borderWidth: 4,
                lineTension: 0,
                fill: false,
                pointRadius: 4,
                pointBackgroundColor: "rgb(226, 199, 85)",
                pointBorderWidth: 0
            }]
        },
        options: optionScore
    });
}
