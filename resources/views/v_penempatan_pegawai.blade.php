<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Penempatan Pegawai ABK</h3>
        <div class=" pull-right">
        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <form id="form-search" action="" class="row">
            {{ csrf_field() }}
            <div class="col-md-6">
                <div class="form-group">
                    <label for="unitkerja">Unit Kerja</label>
                    <select class="form-control" name="unitkerja" id="unitkerja">
                        <option value="">Pilih Unit Kerja</option>
                        <option value="1">1 - Biro Perencanaan dan Hubungan Masyarakat</option>
                        <option value="40">40 - Biro Umum</option>
                        <option value="46">46 - Biro Organisansi, Kepegawaian dan Hukum</option>
                        <option value="14">14 - Pusat Jasa Kearsipan</option>
                        <option value="15">15 - Pusat Pendidikan dan Pelatihan Kearsipan</option>
                        <option value="42">42 - Pusat Akreditasi Kearsipan</option>
                        <option value="6">6 - Direktorat Kearsipan Pusat</option>
                        <option value="69">69 - Direktorat Kearsipan Daerah I</option>
                        <option value="80">80 - Direktorat Kearsipan Daerah II</option>
                        <option value="8">8 - Direktorat SDM Kearsipan dan Sertifikasi</option>
                        <option value="9">9 - Direktorat Akuisisi</option>
                        <option value="10">10 - Direktorat Pengolahan</option>
                        <option value="47">47 - Direktorat Preservasi</option>
                        <option value="49">49 - Direktorat Layanan dan Pemanfaatan</option>
                        <option value="118">118 - Balai Arsip Statis dan Tsunami Aceh</option>
                        <option value="12">12 - Pusat Sistem dan Jaringan Informasi Kearsipan Nasional</option>
                        <option value="45">45 - Pusat Data Dan Infromasi</option>
                        <option value="48">48 - Pusat Pengkajian dan Pengembangan Sistem Kearsipan</option>
                        <option value="43">43 - Inspektorat</option>
                        <option value="135">135 - Pusat Studi Arsip Statis Kepresidenan</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="bulan">Bulan</label>
                    <select class="form-control" name="bulan"  id="bulan">
                        <option value="">Pilih Bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">OKtober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="tahun">Tahun</label>
                    <select class="form-control" name="tahun" id="tahun">
                    <option value="">Pilih Tahun</option>
                    <?php 
                        $year_start  = 2020;
                        $year_end = date('Y') + 5; 

                        for ($i_year = $year_start; $i_year <= $year_end; $i_year++) {

                            echo '<option value="'.$i_year.'">'.$i_year.'</option>'."\n";
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Cari</button>            
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered yajra-datatable" style="width:100%">
                <thead>
                    <tr>
                        <th colspan="7">Petunjuk:<br/>
                            1. Gunakan tombol Cari terlebih dahulu untuk menemukan data.</br>
                            2. Gunakan tombol Sinkron Data untuk menghitung/meng-update Existing Pegawai dan Kelebihan/Kekurangan.</br>
                            3. Bulan Tahun adalah Periode ABK yang diinput ke dalam sistem.
                        </th>
                        <th style="text-align:right;"><button type="submit" class="btn btn-primary" name="sinkron" id="sinkron" onclick="SinkronData()">Sinkron Data</button><br></th>
                    </tr>
                    <tr>
                        <th>Unit Kerja</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Kode - Nama Jabatan</th>
                        <th>Kebutuhan Sesuai ABK</th>
                        <th>Existing Pegawai</th>
                        <th>Kelebihan/Kekurangan</th>
                        <th>Aksi</th>
                    </tr>

                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
</div>                

    <script type="text/javascript">
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                dom: '<"top">r<t><"bottom" <"pull-left"i><"pull-right"p>><"clear">',
                processing: true,
                serverSide: true,
                ordering: false,
                scrollX: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json',
                },
                ajax2: "{{route('admin.penempatan_pegawai.dt')}}",
                "ajax": {
                    'type': 'GET',
                    'url': "{{route('admin.penempatan_pegawai.dt')}}",
                    "data": function(d) {
                        d.extra_search = $('#form-search').serializeArray();
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [{
                        data: 'nama_unitkerja',
                        name: 'nama_unitkerja',
                    },
                    {
                        data: 'bulan',
                        name: 'bulan'
                    },
                    {
                        data: 'tahun',
                        name: 'tahun'
                    },
                    {
                        data: 'nama_jabatan',
                        name: 'nama_jabatan'
                    },
                    {
                        class: "text-center",
                        data: 'kebutuhan',
                        name: 'kebutuhan'
                    },
                    {
                        class : "text-center",
                        render : function(data,type, full){
                            var actions = [];
                            actions.push(full.existing_pegawai[0] + "&nbsp;&nbsp;&nbsp;(<a href='existing_pegawai?unit_id="+full.existing_pegawai[1]+"&jabatan="+full.existing_pegawai[2]+"' target='_blank' >Lihat Pegawai</a>)");
                            return actions.join('');
                        }
                    },
                    {
                        render : function(data,type, full){
                            var actions = [];
                            if(full.kelebihan_kekurangan[0] === 'lebih'){
                                actions.push("<b style='color:red;'>"+full.kelebihan_kekurangan[1]+"</b>");
                            }
                            else if(full.kelebihan_kekurangan[0] === 'kurang'){
                                actions.push("<b style='color:green;'>"+full.kelebihan_kekurangan[1]+"</b>");
                            }
                            else{
                                actions.push("<b>"+full.kelebihan_kekurangan[1]+"</b>");
                            }
                            return actions.join('');
                        }
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    }
                ]
            });

        });

        //Set value to Dropdown Select
        const queryString = window.location.search;
        if(queryString === ""){
            const unit_kerja = document.getElementById('unitkerja');
            unit_kerja.value = "";
            const bln = document.getElementById('bulan');
            const thn = document.getElementById('tahun');
        }
        else{
            const urlParams = new URLSearchParams(queryString);

            const param_unitkerja = urlParams.get('unitkerja')
            document.getElementById("unitkerja").value=param_unitkerja;
            const param_bulan = urlParams.get('bulan')
            document.getElementById("bulan").value=param_bulan;
            const param_tahun = urlParams.get('tahun')
            document.getElementById("tahun").value=param_tahun;
        }

        function SinkronData(){

            $.ajax({
                type : 'GET',
                url : "{{route('admin.penempatan_pegawai.sinkrondata')}}",
                cache : false,
                data : $('#form-search').serializeArray(),
                success : function (data){  
                    location.reload();
                }
            });
        }

    </script>
    <!-- /.box-body -->
</div>