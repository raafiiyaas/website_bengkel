const ctx = document.getElementById('grafikTransaksi').getContext('2d');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr'],
    datasets: [{
      label: 'Transaksi Bulanan',
      data: [12, 19, 3, 5],
      backgroundColor: 'rgba(75, 192, 192, 0.5)',
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
