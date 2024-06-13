<div class="box box-default">
    <div class="box-header with-border">
        <!-- <h3 class="box-title">Hukuman Disiplin</h3> -->

        <div class=" pull-right">


        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <form id="form-search-riwayat-hukuman" class="form-horizontal">

            <div class="row">
                <div class="col-md-12">
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> NAMA</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-addon">
                                            <i class="fa fa-pencil"></i>
                                        </div>

                                        <input type="text" class="form-control name" placeholder="NAMA Pegawai" name="nama" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> NIP</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-addon">
                                            <i class="fa fa-pencil"></i>
                                        </div>

                                        <input type="text" class="form-control nip" placeholder="NIP Pegawai" name="nip" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> TAHUN</label>
                                <div class="col-sm-8">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-addon">
                                            <i class="fa fa-pencil"></i>
                                        </div>
                                        <input type="text" class="form-control tahun" id="tahun" placeholder="Tahun" name="tahun" pattern="\d{4}" title="Masukkan tahun yang benar (YYYY)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="btn-group pull-left">
                                <button class="btn btn-info submit btn-sm"><i class="fa fa-search"></i>&nbsp;&nbsp;Cari</button>
                                <button type="button" class="btn btn-primary btn-sm" name="btn-cetak-riwayat-hukuman"><i class='fa fa-print'></i> Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        <div class="table-responsive">
            <table class="table table-bordered yajra-datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>NAMA</th>
                        <th>TGL SK</th>
                        <th>NAMA HUKUMAN</th>
                        <th>PELANGGARAN</th>
                        <th>PEJABAT PENETAP</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <script type="text/javascript">
        $(function() {
            $("[name=btn-cetak-riwayat-hukuman]").click(function() {
                var base_url = "<?php echo $url_cetak; ?>";
                window.open(base_url + "?" + $("#form-search-riwayat-hukuman").serialize(), '_blank');
            });
            $("#form-search-riwayat-hukuman").submit((function(e) {
                table.ajax.reload();
                e.preventDefault();
            }));
            var table = $('.yajra-datatable').DataTable({
                dom: '<"top">r<t><"bottom" <"pull-left"i><"pull-right"p>><"clear">',
                processing: true,
                serverSide: true,
                ordering: false,
                scrollX: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json',
                },
                "ajax": {
                    'type': 'POST',
                    'url': "{{route('admin.riwayat-hukuman.dt')}}",
                    "data": function(d) {
                        d.extra_search = $('#form-search-riwayat-hukuman').serializeArray();
                        d._token = "{{ csrf_token() }}";
                    },
                },
                columns: [{
                        data: 'nip_baru',
                        name: 'nip_baru'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'tgl_sk',
                        name: 'tgl_sk'
                    },
                    {
                        data: 'nama_hukuman',
                        name: 'nama_hukuman'
                    },
                    {
                        data: 'pelanggaran',
                        name: 'pelanggaran'
                    },
                    {
                        data: 'pejabat_penetap',
                        name: 'pejabat_penetap'
                    }
                ]
            });

        });
    </script>
    <!-- /.box-body -->
</div>