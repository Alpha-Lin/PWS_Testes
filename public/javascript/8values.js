var dataDiv = document.querySelector('.js-graph-params');
const data = JSON.parse(dataDiv.dataset.val);
console.log();

const options = {
  responsive: true,
  maintainAspectRatio: false,
  indexAxis: 'y',
  scales: {
      x: {
          type: 'linear',
          position: 'bottom',
          beginAtZero: true,
          min: -data[Object.keys(data).length-1]["borne"],
          max: data[Object.keys(data).length-1]["borne"],
          ticks: {
              stepSize: 5
          }
      },
      y: {
        type: 'category', // Use 'category' type for y-axis
        position: 'right',
        labels: data.map(row => row.crit2), // Assign labels directly to y-axis
        grid: {
          display: false
        }
      }
  }
};

new Chart(document.getElementById('graph'), {
  type: 'bar',
  options: options,
  data: {
      labels: data.map(row => row.crit1),
      datasets: [
          {
              label: "Résultats",
              data: data.map(row => row.val),
              backgroundColor:  data.map(row => ((row.val) >= 0) ? row.coul2 : row.coul1), //il lèche le sapin
              borderWidth: 1,
              yAxisID: 'y-axis-1'
          }
      ]
  }
});
