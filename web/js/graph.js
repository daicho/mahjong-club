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
                fontSize: 14
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
                minor: {
                    display: false
                },
                major: {
                    display: false
                },
            }
        }]
    },
    chartArea: {
        backgroundColor: "rgb(17, 25, 38)"
    },
};

// フォント設定
Chart.defaults.global.defaultFontFamily = "a-otf-midashi-go-mb31-pr6n, sans-serif";

// 通算スコア
const viewScoreGraph = () => {
    // 軸の書式設定
    option.scales.yAxes[0].ticks.callback = (value, index, values) => {
        if (value == 0)
            return "±0 ";
        else if (value > 0)
            return "+" + value + " ";
        else
            return value + " ";
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
        options: option
    });
}

// アガリ翻数
const viewFanGraph = () => {
    // 軸の書式設定
    option.scales.yAxes[0].ticks.callback = (value, index, values) => {
        return value + " ";
    };

    let ctxFan = document.getElementById("fan_graph").getContext("2d");

    // グラデーション作成
    let height = document.getElementById("win_figure").clientHeight ;
    let gradientStrokes = new Array(13);
    maxFantimes = dataFan.reduce((a,b) => a > b ? a : b);
    for(let i = 0; i < gradientStrokes.length; i++){
        gradientStrokes[i] = ctxFan.createLinearGradient( 0, height, 0 , height - height * (dataFan[i] / maxFantimes));
        gradientStrokes[i].addColorStop(1, "rgb(226, 199, 85)");
        gradientStrokes[i].addColorStop(0, "rgba(0, 0, 0, 0)");
    }

    let chartFan = new Chart(ctxFan, {
        type: "bar",
        data:{
            labels: labelFan,
            datasets: [{
                label: "出現回数",
                data: dataFan,
                borderColor: "rgb(226, 199, 85)",
                backgroundColor: gradientStroke,
                borderWidth: 3,
                categoryPercentage: 1.2
            }]
        },
        options: option
    });
}

// 局別収支
const viewKyokuGraph = () => {
    // 軸の書式設定
    option.scales.yAxes[0].ticks.callback = (value, index, values) => {
        if (value == 0)
            return "±0 ";
        else if (value > 0)
            return "+" + value + " ";
        else
            return value + " ";
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
        options: option
    });
}
