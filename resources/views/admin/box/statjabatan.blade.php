<div class='container'>
    <div class='row'>
        <div class='col-md-12'>
            <h4>Statistik Nilai Jabatan</h4>
            <ul class='list-group'>
                <li class='list-group-item'>
                    Jumlah pegawai dengan nilai 100: {{ $nilaiCounts['100'] }} Pegawai
                </li>
                <li class='list-group-item'>
                    Jumlah pegawai dengan nilai 150: {{ $nilaiCounts['150'] }} Pegawai
                </li>
                <li class='list-group-item'>
                    Jumlah pegawai dengan nilai 200: {{ $nilaiCounts['200'] }} Pegawai
                </li>
                <li class='list-group-item'>
                    Jumlah pegawai dengan nilai 0: {{ $nilaiCounts['0'] }} Pegawai
                </li>
            </ul>
        </div>
    </div>
</div>
