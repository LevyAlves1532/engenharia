$(function() {
  const path = window.location.href.replace(BASE_URL, '');

  if (path === 'admin/' || path === 'admin') {
    const ctx = document.getElementById('myChart');

    $.ajax({
      url: BASE_URL + 'admin/home/values',
      dataType: 'json',
      success: (json) => {
        new Chart(ctx, {
          type: 'line',
          data: {
            labels: json.months,
            datasets: [{
              label: 'Total em Vendas',
              data: json.profits,
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      },
    });
  }
});
