var dataDiv = document.querySelector('.js-graph-params');
const data = JSON.parse(dataDiv.dataset.val);


const options = {
  responsive: true,
  maintainAspectRatio: false,
  indexAxis: 'y',
  scales: {
      x: {
          type: 'linear',
          position: 'bottom',
          beginAtZero: true,
          min: -data[0]["borne"],
          max: data[0]["borne"],
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
              backgroundColor: 'rgba(54, 162, 235, 0.5)', //il lèche le sapin
              borderColor: 'rgba(54, 162, 235, 1)',
              borderWidth: 1,
              yAxisID: 'y-axis-1'
          }
      ]
  }
});
