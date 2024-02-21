<div class="container mt-4">
    <div class="row">
        <!--<div class="col-md-6">
            <h4>Nilai Masa Kerja</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    Jumlah pegawai dengan nilai 40: {{-- $nilaiCounts['100'] --}} Pegawai
                </li>
                <li class="list-group-item">
                    Jumlah pegawai dengan nilai 140: {{-- $nilaiCounts['150'] --}} Pegawai
                </li>
                <li class="list-group-item">
                    Jumlah pegawai dengan nilai 225: {{-- $nilaiCounts['200'] --}} Pegawai
                </li>
                <li class="list-group-item">
                    Jumlah pegawai dengan nilai 295: {{-- $nilaiCounts['0'] --}} Pegawai
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <canvas id="doughnut" width="200" height="200"></canvas>
        </div>
        <div class="col-md-6">
            <h4>Nilai Unit Kerja</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    Jumlah pegawai dengan nilai 200: {{-- $nilaiCounts['200'] --}} Pegawai
                </li>
                <li class="list-group-item">
                    Jumlah pegawai dengan nilai 300: {{-- $nilaiCounts['300'] --}} Pegawai
                </li>
                <li class="list-group-item">
                    Jumlah pegawai dengan nilai 350: {{-- $nilaiCounts['350'] --}} Pegawai
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <canvas id="doughnut" width="200" height="200"></canvas>
        </div>-->
        <div class="col-md-6">
            <h4>Nilai Jabatan</h4>
            <ul class="list-group">
                <li class="list-group-item">
                    Jumlah pegawai dengan nilai 100: {{ $nilaiCounts['100'] }} Pegawai
                </li>
                <li class="list-group-item">
                    Jumlah pegawai dengan nilai 150: {{ $nilaiCounts['150'] }} Pegawai
                </li>
                <li class="list-group-item">
                    Jumlah pegawai dengan nilai 200: {{ $nilaiCounts['200'] }} Pegawai
                </li>
                <li class="list-group-item text-danger" data-toggle="tooltip" data-placement="top"
                    title="Segera Cek nilai yang Nol di Menu Nilai Jabatan Pegawai">
                    Jumlah pegawai dengan nilai 0: {{ $nilaiCounts['0'] }} Pegawai
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <canvas id="doughnut" width="200" height="200"></canvas>
        </div>
    </div>
</div>

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
