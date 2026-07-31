import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {

    const ctx = document.getElementById('salesChart');

    if (!ctx) return;

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: [
                'Sen',
                'Sel',
                'Rab',
                'Kam',
                'Jum',
                'Sab',
                'Min'
            ],

            datasets: [{

                label: 'Penjualan',

                data: [15,25,18,40,37,48,37],

                borderColor: '#2563eb',

                backgroundColor: 'rgba(37,99,235,.15)',

                fill: true,

                tension: .4

            }]

        }

    });

});