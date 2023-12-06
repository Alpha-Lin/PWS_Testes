var dataDiv = document.querySelector('.js-graph-params');
const data = JSON.parse(dataDiv.dataset.val);
//https://www.youtube.com/watch?v=dQw4w9WgXcQ
  new Chart(
    document.getElementById('graph'),
    {
      type: 'bar',
      data: {
        labels: data.map(row => row.crit), 
        datasets: [
          {
            label: 'Résultats',
            data: data.map(row => row.val)
          },
        ]
      }
    }
  );
