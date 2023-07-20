<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Penghargaan</h3>

        <div class=" pull-right">
            <select class="form-control" aria-label="Default select example"  >
                <option selected  value="1">USULAN YANG AKAN MENDAPAT</option>
                <option value="2">YANG TELAH MENDAPAT</option>
            </select>
            <select class="form-control" aria-label="Default select example" >
                <option selected  value="1">SATYALANCANA KARYA SATYA X (PERUNGGU)</option>
                <option value="2">SATYALANCANA KARYA SATYA XX (PERAK)</option>
                <option value="3">SATYALANCANA KARYA SATYA XXX (EMAS)</option>
            </select>
            <a class='btn btn-primary'>Tampilkan</a>
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
                        <th>JABATAN</th>
                        <th>GOL. RUANG</th>
                        <th>UNIT KERJA</th>
                        <th>JENIS PENGHARGAAN</th>
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
                processing: true,
                serverSide: true,
                ordering: false,
                scrollX: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json',
                },
                ajax: "{{route('admin.penghargaan.dt')}}",
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
                        data: 'pangkat',
                        name: 'gol_ruang'
                    },
                    {
                        data: 'unit_kerja',
                        name: 'unit_kerja'
                    },
                    {
                        data: 'jenis_penghargaan',
                        name: 'jenis_penghargaan'
                    }
                ]
            });

        });
    </script>
    <!-- /.box-body -->
</div>