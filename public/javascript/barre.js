var dataDiv = document.querySelector('.js-graph-params');
const data = JSON.parse(dataDiv.dataset.val);
//https://www.youtube.com/watch?v=dQw4w9WgXcQ
  new Chart(
    document.getElementById('graph'),
    {
      type: 'bar',
      options: {
        responsive: true,
      },
      data: {
        labels: data.map(row => row.crit),
        datasets: [
          {
            label: data.map(row => row.crit),
            data: data.map(row => row.val),
            backgroundColor: data.map(row => row.coul),
          },
        ]
      }
    }
  );
