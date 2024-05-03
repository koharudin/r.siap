<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Penghargaan</h3>

        <div class=" pull-right">


        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <form id="form-search-penghargaan">
            <div class="form-group" style="display:none">
                <label for="exampleFormControlSelect1">KRITERIA</label>
                <select class="form-control" name="kriteria">
                    <option value=-1>USULAN</option>
                    <option value=1 selected>SUDAH MENDAPAT</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Jenis Penghargaan</label>
                <select class="form-control" name="jenis">
                    <option value=38>SATYALANCANA KARYA SATYA PERAK</option>
                    <option value=39>SATYALANCANA KARYA SATYA PERUNGGU</option>
                    <option value=40>SATYALANCANA KARYA SATYA EMAS</option>
                    <option value=56>SATYALANCANA WIRA KARYA</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm"><i class='fa fa-search'></i> Cari</button>
            <button type="button" class="btn btn-primary btn-sm" name="btn-cetak-penghargaan"><i class='fa fa-print'></i> Cetak</button>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered yajra-datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>PENGHARGAAN</th>
                        <th>NIP</th>
                        <th>NAMA</th>
                        <th>JABATAN</th>
                        <th>GOL. RUANG</th>
                        <th>UNIT KERJA</th>
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
            $("[name=btn-cetak-penghargaan]").click(function() {
                var base_url = "<?php echo $url_cetak; ?>";
                window.open(base_url + "?" + $("#form-search-penghargaan").serialize(), '_blank');
            });
            $("#form-search-penghargaan").submit((function(e) {
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
                ajax2: "<?php echo e(route('admin.penghargaan.dt'), false); ?>",
                "ajax": {
                    'type': 'POST',
                    'url': "<?php echo e(route('admin.penghargaan.dt'), false); ?>",
                    "data": function(d) {
                        d.extra_search = $('#form-search-penghargaan').serializeArray();
                        d._token = "<?php echo e(csrf_token(), false); ?>";
                    },
                },
                columns: [{
                        data: 'penghargaan',
                        name: 'penghargaan'
                    },
                    {
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
                        data: 'pangkat',
                        name: 'gol_ruang'
                    },
                    {
                        data: 'unit_kerja',
                        name: 'unit_kerja'
                    },

                ]
            });

        });
    </script>
    <!-- /.box-body -->
</div><?php /**PATH /home/webapps/anri.siap/resources/views/v_penghargaan.blade.php ENDPATH**/ ?>