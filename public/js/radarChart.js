var config = {
    type: 'radar',
    data: {
        labels: ["Play Count", "Drinking", "休日", "Designing", "Coding", "Cycling", "Running"],
        datasets: [{
            label: "My Second dataset",
            backgroundColor: "rgba(255,99,132,0.2)",
            borderColor: "rgba(255,99,132,1)",
            pointBackgroundColor: "rgba(255,99,132,1)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgba(255,99,132,1)",
            data: [1, 1, 1, 1, 1, 1, 1]
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
window.onload = function() {
    var ctx = document.getElementById("radarChartCanvas").getContext("2d");
    window.myPie = new Chart(ctx, config);
};
