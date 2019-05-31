var ctxD = document.getElementById("doughnutChart").getContext('2d');
var myLineChart = new Chart(ctxD, {
  type: 'doughnut',
  data: {
    labels: ["EUSTRESS, lo stress buono", "DISTRESS, lo stress cattivo"],
    datasets: [{
      data: [40,60],
      backgroundColor: ["#d35400", "#2c3e50"],
      hoverBackgroundColor: ["#e67e22", "#34495e"]
    }]
  },
  options: {
    responsive: true
  }
});

var ctxL = document.getElementById("lineChart").getContext('2d');
var myLinearChart = new Chart(ctxL, {
  type: 'line',
  data: {
    labels: [],
    datasets: [{
        label: "My answers",
        data: [0],
        backgroundColor: [
          'rgba(0, 216, 214, 0.5)',
        ],
        borderColor: [
          'rgba(236, 240, 241, 1.0)',
        ],
        borderWidth: 2
      }
    ]
  },
  options: {
    responsive: true
  }
});
