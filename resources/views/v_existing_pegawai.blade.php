<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Daftar Existing Pegawai</h3>
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
                        <th>Nama</th>
                        <th>Unit Kerja</th>
                        <th>Jabatan</th>
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
                "ajax": {
                    'type': 'GET',
                    'url': "{{route('admin.existing_pegawai.dt')}}",
                    "data": function(d) {
                        d._token = "{{ csrf_token() }}";
                        d.unit_id = "{{$_GET['unit_id']}}";
                        d.jabatan = "{{$_GET['jabatan']}}";
                    },
                },
                columns: [{
                        data: 'nip',
                        name: 'nip',
                    },
                    {
                        data: 'nama_pegawai',
                        name: 'nama_pegawai'
                    },
                    {
                        data: 'nama_unit',
                        name: 'nama_unit'
                    },
                    {
                        data: 'nama_jabatan',
                        name: 'nama_jabatan'
                    }
                ]
            });

        });

    </script>
    <!-- /.box-body -->
</div>