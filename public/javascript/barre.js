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
        datasets: [
          {
            label: data.map(row => row.crit1),
            data: data.map(row => row.val),
            backgroundColor: data.map(row => row.coul1),
          },
          {
            label: data.map(row => row.crit2),
            data: data.map(row => row.val),
            backgroundColor: data.map(row => row.coul2),
          }
        ]
      }
    }
  );
