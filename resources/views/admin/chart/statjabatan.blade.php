<canvas id="doughnut" width="200" height="200"></canvas>
<script>
    $(function() {
        var config = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        {{ $nilaiCounts['100'] }},
                        {{ $nilaiCounts['150'] }},
                        {{ $nilaiCounts['200'] }},
                        {{ $nilaiCounts['0'] }},
                    ],
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                        'rgb(75, 192, 192)',
                        'rgb(255, 159, 64)',
                    ]
                }],
                labels: [
                    'Nilai 100',
                    'Nilai 150',
                    'Nilai 200',
                    'Nilai 0',
                ]
            },
            options: {
                maintainAspectRatio: false
            }
        };

        var ctx = document.getElementById('doughnut').getContext('2d');
        new Chart(ctx, config);
    });
</script>
