
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">MASA PERSIAPAN PENSIUN</h3>

        <div class=" pull-right">

        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered yajra-datatable" style="width:100%">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>NAMA</th>
                        <th>JENIS KELAMIN</th>
                        <th>JABATAN</th>
                        <th>TMT JABATAN</th>
                        <th>GOL. RUANG</th>
                        <th>UNIT KERJA</th>
                        <th>TANGGAL PENSIUN</th>
                        <th>USIA</th>
                        <th>SISA MASA KERJA</th>
                        <th>#</th>
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
            var table = $('.yajra-datatable').DataTable({
                dom: '<"top">r<t><"bottom" <"pull-left"i><"pull-right"p>><"clear">',
                processing: true,
                serverSide: true,
                ordering: false,
                scrollX: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json',
                },
                ajax: "<?php echo e(route('admin.pensiun.mpp.dt'), false); ?>",
                columns: [{
                        data: 'nip_baru',
                        name: 'nip_baru'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'sex',
                        name: 'sex'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'tmt_jabatan',
                        name: 'tmt_jabatan'
                    },
                    {
                        data: 'pangkat',
                        name: 'gol_ruang'
                    },
                    {
                        data: 'unit_kerja',
                        name: 'unit_kerja'
                    },
                    {
                        data: 'tgl_pensiun',
                        name: 'tgl_pensiun'
                    },
                    {
                        data: 'usia',
                        name: 'usia'
                    },
                    {
                        data: 'sisa_masa_kerja',
                        name: 'sisa_masa_kerja'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });

        });
    </script>
    <!-- /.box-body -->
</div><?php /**PATH /home/webapps/anri.siap/resources/views/pensiun/mpp.blade.php ENDPATH**/ ?>