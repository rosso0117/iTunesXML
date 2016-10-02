$(function() {
  $('.chart-button').click(function(e) {
    var index = ($(this).val());
    var review_jsons = JSON.parse($('#radarChartScript').attr('review-jsons'));
    var review_json = (review_jsons[index]);
    var artistic = review_json.artistic;
    var exciting = review_json.exciting;
    var pop = review_json.pop;
    var fun = review_json.fun;

    var config = {
        type: 'radar',
        data: {
            labels: ["芸術性", "エキサイティング", "ポップ", "楽しい"],
            datasets: [{
                label: "評価",
                backgroundColor: "rgba(255,99,132,0.2)",
                borderColor: "rgba(255,99,132,1)",
                pointBackgroundColor: "rgba(255,99,132,1)",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(255,99,132,1)",
                data: [artistic, exciting, pop, fun]
            }]
        },
        options: {
          scale: {
              ticks: {
                min: 0,
                max: 5,
                maxTicksLimit: 5,
                fixedStepSize: 1,
                stepSize: 1,
                suggestedMax: 5
              }
          }
        }
    };
    // window.onload = function() {
        var ctx = document.getElementById("radarChartCanvas").getContext("2d");
        window.myPie = new Chart(ctx, config);
    // };
  });
});
