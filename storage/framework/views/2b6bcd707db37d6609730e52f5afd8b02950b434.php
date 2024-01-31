<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Penempatan Pegawai ABK</h3>
        <div class=" pull-right">
        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <form id="form-search" action="" class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="unitkerja">Unit Kerja</label>
                    <select class="form-control" name="unitkerja" id="unitkerja">
                        <option value="">Pilih Unit Kerja</option>
			<option value="41">41 - Sekretaris Utama</option>
			<option value="44">44 - Deputi Bidang Pembinaan Kearsipan</option>
			<option value="39">39 - Deputi Bidang Konservasi Arsip</option>
			<option value="11">11 - Deputi Bidang Informasi dan Pengembangan Sistem Kearsipan</option>
                        <option value="1">1 - Biro Perencanaan dan Hubungan Masyarakat</option>
                        <option value="40">40 - Biro Umum</option>
                        <option value="46">46 - Biro Organisansi, Kepegawaian dan Hukum</option>
                        <option value="14">14 - Pusat Jasa Kearsipan</option>
                        <option value="114">114 - Kepala Sub Bagian Tata Usaha Pusat Jasa Kearsipan</option>
                        <option value="15">15 - Pusat Pendidikan dan Pelatihan Kearsipan</option>
                        <option value="16">16 - Kepala Sub Bagian Tata Usaha Pusat Pendidikan dan Pelatihan Kearsipan</option>
                        <option value="42">42 - Pusat Akreditasi Kearsipan</option>
                        <option value="87">87 - Kepala Sub Bagian Tata Usaha Pusat Akreditasi Kearsipan</option>
                        <option value="6">6 - Direktorat Kearsipan Pusat</option>
                        <option value="69">69 - Direktorat Kearsipan Daerah I</option>
                        <option value="80">80 - Direktorat Kearsipan Daerah II</option>
                        <option value="8">8 - Direktorat SDM Kearsipan dan Sertifikasi</option>
                        <option value="9">9 - Direktorat Akuisisi</option>
                        <option value="10">10 - Direktorat Pengolahan</option>
                        <option value="47">47 - Direktorat Preservasi</option>
                        <option value="49">49 - Direktorat Layanan dan Pemanfaatan</option>
                        <option value="118">118 - Balai Arsip Statis dan Tsunami Aceh</option>
                        <option value="101">101 - Kepala Sub Bagian Tata Usaha Balai Arsip Statis dan Tsunami Aceh</option>
                        <option value="12">12 - Pusat Sistem dan Jaringan Informasi Kearsipan Nasional</option>
                        <option value="45">45 - Pusat Data Dan Infromasi</option>
                        <option value="48">48 - Pusat Pengkajian dan Pengembangan Sistem Kearsipan</option>
                        <option value="43">43 - Inspektorat</option>
                        <option value="97">97 - Kepala Sub Bagian Tata Usaha Inspektorat</option>
                        <option value="135">135 - Pusat Studi Arsip Statis Kepresidenan</option>
                        <option value="136">136 - Kepala Sub Bagian Umum Pusat Studi Arsip Statis Kepresidenan</option>
			<option value="81">81 - Kepala Bagian Perlengkapan, Tata Usaha, Kearsipan, dan Protokol</option>
			<option value="102">102 - Kepala Sub Bagian Perlengkapan dan Rumah Tangga</option>
			<option value="88">88 - Kepala Sub Bagian Protokol dan Pengamanan</option>
			<option value="112">112 - Kepala Sub Bagian Tata Usaha Deputi Bidang Pembinaan Kearsipan</option>
			<option value="127">127 - Kepala Sub Bagian Tata Usaha Deputi Bidang Konservasi Arsip</option>
			<option value="134">134 - Kepala Sub Bagian Tata Usaha Deputi Bidang Informasi dan Pengembangan Sistem Kearsipan</option>
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
                        $year_start  = 2023;
                        $year_end = date('Y') + 2; 

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
            <table class="table table-bordered datatable" style="width:100%">
                <thead>
                    <tr>
                        <th colspan="9">Petunjuk:<br/>
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
                        <th class="text-left">Kebutuhan ABK</th>
                        <th class="text-left" style="border-right:hidden;">Existing Pegawai</th>
                        <th style="border-left:hidden;"></th>
                        <th class="text-left">Kelebihan</th>
                        <th class="text-left">Kekurangan</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total</th>
                        <th class="text-right totalkebutuhan"></th>
                        <th class="text-right totalexisting" style="border-right:hidden;"></th>
                        <th class="text-right" style="border-left:hidden;"></th>
                        <th class="text-right totalkelebihan"></th>
                        <th class="text-right totalkekurangan"></th>
                        <th class="text-right"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
</div>                

    <script type="text/javascript">
        $(function() {
            var table = $('.datatable').DataTable({
                dom: '<"top">r<t><"bottom" <"pull-left"i><"pull-right"p>><"clear">',
                processing: true,
                serverSide: true,
                ordering: false,
                scrollX: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json',
                },
                ajax2: "<?php echo e(route('admin.penempatan_pegawai.dt'), false); ?>",
                "ajax": {
                    'type': 'GET',
                    'url': "<?php echo e(route('admin.penempatan_pegawai.dt'), false); ?>",
                    "data": function(d) {
                        d.extra_search = $('#form-search').serializeArray();
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
                        class: "text-right",
                        data: 'kebutuhan',
                        name: 'kebutuhan'
                    },
                    {
                        class: "text-right",
                        data: 'existing_pegawai',
                        name: 'existing_pegawai'
                    },
                    {
                        class : "text-center",
                        render : function(data,type, full){
                            var actions = [];
                            if(full.url_existing[0] == 0){
                                actions.push("Lihat Pegawai");
                            }
                            else{
                                actions.push("<a href='existing_pegawai?unit_id="+full.url_existing[1]+"&jabatan="+full.url_existing[2]+"' target='_blank' >Lihat Pegawai</a>");
                            }
                            return actions.join('');
                        }
                    },
                    { 
                        name: 'kelebihan',
                        class : "text-right",
                        render : function(data,type, full){
                            var actions = [];
                            actions.push(full.kelebihan);
                            return actions.join('');
                        }
                    },
                    { 
                        name: 'kekurangan',
                        class : "text-right",
                        render : function(data,type, full){
                            var actions = [];
                            actions.push(full.kekurangan);
                            return actions.join('');
                        }
                    },
                    {

			name: 'aksi',
                        render : function(data,type, full){
                            var actions = [];
                            if(full.aksi[0] > full.aksi[1]){
                                actions.push("<span class='badge badge-pill' style='background-color:#ffc107;padding:5px;'>Kurang dari ABK</span>");              
                            }
                            else if(full.aksi[0] < full.aksi[1])
                            {
                                actions.push("<span class='badge badge-pill' style='background-color:#dc3545;padding:5px;'>Lebih dari ABK</span>");              
                            }
                            else{
                                actions.push("<span class='badge badge-pill' style='background-color:#28a745;padding:5px;'>Sesuai ABK</span>");              
                            }
                            return actions.join('');
                        }

                    }
                ],
                footerCallback : function(row, data, start, end, display){
                    //Menghitung Baris Total
                    getTotal();
                }
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
            var x = 0;
            if(document.getElementById('bulan').selectedIndex == 0){
                x += 1;
            }

            if(document.getElementById('tahun').selectedIndex == 0){
                x += 1;
            }

            if(x == 0){ 
                $.ajax({
                    type : 'GET',
                    url : "<?php echo e(route('admin.penempatan_pegawai.sinkrondata'), false); ?>",
                    cache : false,
                    data : $('#form-search').serializeArray(),
                    success : function (data){  
                        location.reload();
                    }
                });
            }
            else{
                //Bulan Tahun harus diisi agar sinkronisasi hanya untuk ABK periode tertentu saja. Tidak berlaku surut untuk semua data.
                alert("Bulan dan Tahun harus dipilih.");
            }
        }

        function getTotal(){
            $.ajax({
                type : 'GET',
                url : "<?php echo e(route('admin.penempatan_pegawai.getTotal'), false); ?>",
                cache : false,
                dataType: "json",
                data :  $('#form-search').serializeArray(),
                success : function (result){  
                    const obj =  JSON.parse(JSON.stringify(result));
                    $(".totalkebutuhan").html(obj['totalkebutuhan']);
                    $(".totalexisting").html(obj['totalexisting']);
                    $(".totalkelebihan").html(obj['totalkelebihan']);
                    $(".totalkekurangan").html(obj['totalkekurangan']);
                }   
            });
        }

    </script>
    <!-- /.box-body -->
</div><?php /**PATH /home/webapps/anri.siap/resources/views/v_penempatan_pegawai.blade.php ENDPATH**/ ?>