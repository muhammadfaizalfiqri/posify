import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {

    const ctx = document.getElementById('salesChart');

    if (!ctx) return;

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: window.salesLabels,

            datasets: [{

                label: 'Penjualan',

                data: window.salesData,

                borderColor: '#2563eb',

                backgroundColor: 'rgba(37,99,235,.15)',

                fill: true,

                tension: .4

            }]

        }

    });

});