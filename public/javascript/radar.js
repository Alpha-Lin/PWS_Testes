var dataDiv = document.querySelector('.js-graph-params');
const data = JSON.parse(dataDiv.dataset.val);

new Chart(document.getElementById('graph'), {
    type: 'radar',
    data: {
        labels: data.map(row => row.crit),
        datasets: [
          {
            label: 'Résultats',
            data: data.map(row => row.val),
            fillColor: data.map(row => row.coul),
          },
        ]
      },
    options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Chart.js Radar Chart'
          }
        }
    },
});