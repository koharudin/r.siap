<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Jabatan Tidak Ada Di ABK</h3>
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
                <div class="form-group" style="display:none;">
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
                <div class="form-group" style="display:none;">
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
        </br>
        <div class="table-responsive">
            <table class="table table-bordered datatable" style="width:100%">
                <thead>
                    <tr>
                        <th colspan="6">Petunjuk:<br/>
                            1. Gunakan tombol Cari dan pilih Unit Kerja untuk menemukan data.</br>
                            2. Jabatan yang muncul adalah jabatan yang tidak ada di ABK tetapi terisi oleh pegawai.</br>
                        </th>
                    </tr>
                    <tr>
                        <th>Unit Kerja</th>
                        <th>Nama Jabatan</th>
                        <th class="text-left" style="border-right:hidden;">Existing Pegawai</th>
                        <th style="border-left:hidden;"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th colspan="4">Total</th>
                        <th class="text-right totalexisting" style="border-right:hidden;"></th>
                        <th class="text-right" style="border-left:hidden;"></th>
                    </tr>
                </tfoot> -->
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
</div>                

    <script type="text/javascript">
        $(function() {
            var table = $('.datatable').DataTable({
                dom: '<"top">rt<"bottom"<"pull-left"li><"pull-right"p>><"clear">',
                processing: true,
                serverSide: true,
                ordering: false,
                scrollX: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json',
                },
                ajax2: "{{route('admin.jabatan_tidaksesuaiabk.dt')}}",
                "ajax": {
                    'type': 'GET',
                    'url': "{{route('admin.jabatan_tidaksesuaiabk.dt')}}",              
                    "data": function(d) {
                        d.extra_search = $('#form-search').serializeArray();
                    },
                },
                columns: [{
                        data: 'unit_kerja',
                        name: 'unit_kerja'
                    },
                    {
                        data: 'nama_jabatan',
                        name: 'nama_jabatan'
                    },
                    {
                        class : "text-center",
                        render : function(data,type, full){
                            var actions = [];
                            actions.push(full.existing_pegawai);
                            return actions.join('');
                        }
                    },
                    {
                        class : "text-center",
                        render : function(data,type, full){
                            var actions = [];
                            if(full.url_existing[0] == 0){
                                actions.push("Lihat Pegawai");
                            }
                            else{
                                actions.push("<a href='existing_pegawai?unit_id="+full.url_existing[0]+"&jabatan="+full.url_existing[1]+"' target='_blank' >Lihat Pegawai</a>");
                            }
                            return actions.join('');
                        }
                    } 
                ]
                // footerCallback : function(row, data, start, end, display){
                //     //Menghitung Baris Total
                //     getTotal();
                // }
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

        function getTotal(){
            $.ajax({
                type : 'GET',
                url : "{{route('admin.penempatan_pegawai.getTotal')}}",
                cache : false,
                dataType: "json",
                data :  $('#form-search').serializeArray(),
                success : function (result){  
                    const obj =  JSON.parse(JSON.stringify(result));
                    $(".totalexisting").html(obj['totalexisting']);
                }   
            });
        }

    </script>
    <!-- /.box-body -->
</div>