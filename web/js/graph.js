// グラフ統一の設定
let options = {
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
                fontSize: 14
            },
            scaleLabel: {
                display: true,
                labelString: "",
                fontColor: "rgb(227, 211, 198)",
                fontSize: 14,
                padding: 2
            }
        }],
        yAxes: [{
            gridLines: {
                display: true,
                drawBorder: false,
                color: "rgb(227, 211, 198)",
                zeroLineWidth: 3,
                zeroLineColor: "rgb(227, 211, 198)"
            },
            ticks: {
                display: true,
                beginAtZero: true,
                fontColor: "rgb(227, 211, 198)",
                fontSize: 14,
                precision: 0,
                padding: 10
            },
            scaleLabel: {
                display: true,
                labelString: "",
                fontColor: "rgb(227, 211, 198)",
                fontSize: 14,
                padding: 2
            }
        }]
    },
    chartArea: {
        backgroundColor: "rgb(17, 25, 38)"
    },
    layout: {
        padding: {
            left: 5,
            right: 20,
            top: 20,
            bottom: 5
        }
    }
};

// フォント設定
Chart.defaults.global.defaultFontFamily = "a-otf-midashi-go-mb31-pr6n, sans-serif";

// 通算スコア
const viewScoreGraph = () => {
    // 軸の設定
    options.scales.xAxes[0].scaleLabel.display = true;
    options.scales.xAxes[0].scaleLabel.labelString = "対戦数 (回)";
    options.scales.yAxes[0].scaleLabel.labelString = "スコア (pt)";

    options.scales.yAxes[0].ticks.callback = (value, index, values) => {
        if (value == 0)
            return "±0";
        else if (value > 0)
            return "+" + value;
        else
            return value;
    };

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
        options: options
    });
}

// アガリ翻数
const viewFanGraph = () => {
    // 軸の設定
    options.scales.xAxes[0].scaleLabel.display = true;
    options.scales.xAxes[0].scaleLabel.labelString = "翻数 (翻)";
    options.scales.yAxes[0].scaleLabel.labelString = "回数 (回)";

    options.scales.yAxes[0].ticks.callback = (value, index, values) => {
        return value;
    };

    let ctxFan = document.getElementById("fan_graph").getContext("2d");

    // グラデーション作成
    let height = document.getElementById("win_figure").clientHeight;
    let gradientStroke = ctxFan.createLinearGradient(0, 0, 0 , height);
    gradientStroke.addColorStop(0, "rgba(226, 199, 85, 0.8)");
    gradientStroke.addColorStop(1, "rgba(226, 199, 85, 0.2)");

    let chartFan = new Chart(ctxFan, {
        type: "bar",
        data:{
            labels: labelFan,
            datasets: [{
                label: "回数",
                data: dataFan,
                borderColor: "rgb(226, 199, 85)",
                backgroundColor: gradientStroke,
                borderWidth: 3,
                categoryPercentage: 1.2
            }]
        },
        options: options
    });
}

// 局別収支
const viewKyokuGraph = () => {
    // 軸の設定
    options.scales.xAxes[0].scaleLabel.display = false;
    options.scales.yAxes[0].scaleLabel.labelString = "収支 (点)";

    options.scales.yAxes[0].ticks.callback = (value, index, values) => {
        if (value == 0)
            return "±0";
        else if (value > 0)
            return "+" + value;
        else
            return value;
    };

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
        options: options
    });
}
