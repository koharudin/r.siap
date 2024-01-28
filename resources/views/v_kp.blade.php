<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Kenaikan Pangkat Reguler</h3>

        <div class=" pull-right">


        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <form id="form-search-kp" class="form-horizontal">

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
                            <div class="form-group  ">

                                <label for="tmt_eselon" class="col-sm-2  control-label">Periode KP</label>

                                <div class="col-sm-8">


                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>

                                        <input type="text" id="periode_kp" name="periode_kp" value="<?php

                                                                                                    use Carbon\Carbon;

                                                                                                    echo Carbon::now()->format('Y/m/d'); ?>" class="form-control" placeholder="Masukan Periode KP">



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
                                <button type="button" class="btn btn-primary btn-sm" style="display: none;" name="btn-cetak-riwayat-hukuman"><i class='fa fa-print'></i> Cetak</button>
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
                        <th>JABATAN</th>
                        <th>PANGKAT TERAKHIR</th>
                        <th>RENTANG WAKTU</th>
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
            $('#periode_kp').datetimepicker({
                "allowInputToggle": true,
                "showClose": true,
                "showClear": true,
                "showTodayButton": true,
                "format": "YYYY/MM/DD",
            });
            $("[name=btn-cetak-kp]").click(function() {
                var base_url = "<?php echo $url_cetak; ?>";
                window.open(base_url + "?" + $("#form-search-kp").serialize(), '_blank');
            });
            $("#form-search-kp").submit((function(e) {
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
                    'url': "{{route('admin.kp.dt')}}",
                    "data": function(d) {
                        d.extra_search = $('#form-search-kp').serializeArray();
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
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'pangkat_terakhir',
                        name: 'pangkat_terakhir'
                    },
                    {
                        data: 'rentang_waktu',
                        name: 'rentang_waktu',
                        html: true
                    }
                ]
            });

        });
    </script>
    <!-- /.box-body -->
</div>