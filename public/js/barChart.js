function createBarChart(labels, data, canvasId, title) {
  const ctx = document.getElementById(canvasId).getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [{
          data: data,
          backgroundColor: [
              'rgb(255, 99, 132)',
              'rgb(75, 192, 192)'
          ],
          borderWidth: 1
      }]
    },
    options: {
      indexAxis: 'y',
      scales: {
        y: {
          beginAtZero: true
        }
      },
      plugins: {
          legend: {
            display: false
          }
        }
    }
  });
}