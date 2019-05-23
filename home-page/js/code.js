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
  },
  tooltip: {
    callback: {
      title: function(tooltipItem, chart) {
              return 'dsklfjjdklsfjj';
          }
    }
  }
});

var ctxL = document.getElementById("lineChart").getContext('2d');
var myLineChart1 = new Chart(ctxL, {
  type: 'line',
  data: {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [{
        label: "My First dataset",
        data: [65, 59, 80, 81, 56, 55, 40],
        backgroundColor: [
          'rgba(105, 0, 132, .2)',
        ],
        borderColor: [
          'rgba(200, 99, 132, .7)',
        ],
        borderWidth: 2
      },
      {
        label: "My Second dataset",
        data: [28, 48, 40, 19, 86, 27, 90],
        backgroundColor: [
          'rgba(0, 137, 132, .2)',
        ],
        borderColor: [
          'rgba(0, 10, 130, .7)',
        ],
        borderWidth: 2
      }
    ]
  },
  options: {
    responsive: true
  }
});
