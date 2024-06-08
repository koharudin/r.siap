<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Statistik Kepegawaian</h3>


    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <canvas id="chart_asn"></canvas>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
		<canvas id="chart_pegawai_by_usia"></canvas>
            </div>
 	    <div class="col-md-4 col-sm-6 col-xs-12">
		<canvas id="chart_pegawai_by_generasi"></canvas>
            </div>
        </div>
        <br><br><br>
        <div class="row">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <canvas id="chart_pegawai_by_pangkat"></canvas>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
</div>


<script>
    var url_api  ='https://kepegawaian.anri.go.id/integrasi_siap/index.php/api/';
	

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    var randomcolor = [getRandomColor(), getRandomColor(), getRandomColor(), getRandomColor()];

    $(document).ready(function () {

        //Chart : ASN ANRI
        $.ajax({
            url: url_api + 'rekap_asn',
            method: "GET",
            success: function (data) {

		var persen_pns_laki = (data.data.pns_laki / data.data.asn_total) * 100;
                var persen_pns_perempuan = (data.data.pns_perempuan / data.data.asn_total) * 100;
                var persen_pppk_laki = (data.data.pppk_laki / data.data.asn_total) * 100;
                var persen_pppk_perempuan = (data.data.pppk_perempuan / data.data.asn_total) * 100;

                var xValues = ["PNS Laki-Laki ("+ persen_pns_laki.toFixed(2) +"%)", "PNS Perempuan ("+ persen_pns_perempuan.toFixed(2) +"%)", "PPPK Laki-Laki ("+ persen_pppk_laki.toFixed(2) +"%)", "PPPK Perempuan ("+ persen_pppk_perempuan.toFixed(2) +"%)"];
                var yValues = [data.data.pns_laki, data.data.pns_perempuan, data.data.pppk_laki, data.data.pppk_perempuan];

                var barColors = [
                    "#3594cc",
                    "#8cc5e3",
                    "#ea801c",
                    "#f0b077"
                ];

                new Chart("chart_asn", {
                    type: "doughnut",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Jumlah ASN ANRI'
                        },
                        legend: {
                            position: 'bottom',
                        }
                    }
                });
            }
        });

	//Pegawai Berdasarkan Usia
        $.ajax({
            url: url_api + 'pegawaiusia',
            method: "GET",
            success: function (data) {
                var label = ['<30', '31-40', '41-50', '>=51'];
                var value = [data.data.kurang_30, data.data.sampai41, data.data.sampai50, data.data.lebih_50];
                var ctx = document.getElementById('chart_pegawai_by_usia').getContext('2d');

                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Usia Pegawai'],
                        datasets: [{
                            label: '<30',
                            backgroundColor: "#259fa8",
                            data: [data.data.kurang_30]
                        },
                        {
                            label: '31-40',
                            backgroundColor: "#679c76",
                            data: [data.data.sampai41]
                        },
                        {
                            label: '41-50',
                            backgroundColor: "#9e905f",
                            data: [data.data.sampai50]
                        },
                        {
                            label: '>= 51',
                            backgroundColor: "#bc8375",
                            data: [data.data.lebih_50]
                        }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                        title: {
                            display: true,
                            text: 'Pegawai Berdasarkan Usia'
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                        }
                    }
                });
            }
        });

	 //Pegawai Berdasarkan Generasi
	$.ajax({
            url: url_api + 'rekap_generasi',
            method: "GET",
            success: function (data) {
                var total = data.data.boomer + data.data.genx + data.data.millenial + data.data.genz;

                var persenBoomer = (data.data.boomer / total) * 100;
                var persenGenx = (data.data.genx / total) * 100;
                var persenMillenial = (data.data.millenial / total) * 100;
                var persenGenz = (data.data.genz / total) * 100;

                var label = ["Generasi"];
                var ctx = document.getElementById('chart_pegawai_by_generasi').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: label,
                        datasets: [{
                            label: 'Boomer II ( ' + persenBoomer.toFixed(2) + " %)",
                            backgroundColor: "#dfba27",
                            borderColor: "#dfba27",
                            data: [data.data.boomer]
                        },
                        {
                            label: 'Gen X ( ' + persenGenx.toFixed(2) + " %)",
                            backgroundColor: "#00a5c5",
                            borderColor: "#00a5c5",
                            data: [data.data.genx]
                        },
                        {
                            label: 'Millenial ( ' + persenMillenial.toFixed(2) + " %)",
                            backgroundColor: "#8a97cb",
                            borderColor: "#8a97cb",
                            data: [data.data.millenial]
                        },
                        {
                            label: 'Gen Z ( ' + persenGenz.toFixed(2) + " %)",
                            backgroundColor: "#bc8da6",
                            borderColor: "#bc8da6",
                            data: [data.data.genz]
                        },
                        ]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Pegawai Berdasarkan Generasi'
                        },
                        responsive: true,
                        legend: {
                            position: 'bottom'
                        },
                    }
                });
            }
        });

	$.ajax({
        url: url_api + 'rekap_pangkat',
        method: "GET",
        success: function (data) {
            var label = ['I', 'II', 'III', 'IV', 'VII', 'IX', 'X'];
            var value = [data.gol_1, data.gol_2, data.gol_3, data.gol_4, data.gol_7, data.gol_9, data.gol_10];
            var ctx = document.getElementById('chart_pegawai_by_pangkat').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: label,
                    datasets: [{
                        label: 'Jumlah Pegawai',
                        data: value,
                        fill: false,
                        borderColor: '#3594cc',
                        tension: 0.1
                    }]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Pegawai Berdasarkan Pangkat'
                    },
                    legend: {
                        display: false,
                    }
                }
            });
        }
    });

    });

   </script>