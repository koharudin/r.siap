<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">Penghargaan</h3>

        <div class=" pull-right">


        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <form id="form-search">
            <div class="form-group">
                <label for="exampleFormControlSelect1">KRITERIA</label>
                <select class="form-control" name="kriteria">
                    <option>USULAN</option>
                    <option>SUDAH MENDAPAT</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Jenis Penghargaan</label>
                <select class="form-control" name="jenis">
                    <option>SATYALANCANA KARYA SATYA PERAK</option>
                    <option>SATYALANCANA KARYA SATYA PERUNGGU</option>
                    <option>SATYALANCANA KARYA SATYA EMAS</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">CARI</button>
        </form>
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
                dom: '<"top">r<t><"bottom" <"pull-left"i><"pull-right"p>><"clear">',
                processing: true,
                serverSide: true,
                ordering: false,
                scrollX: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json',
                },
                ajax2: "{{route('admin.penghargaan.dt')}}",
                "ajax": {
                    'type': 'POST',
                    'url': "{{route('admin.penghargaan.dt')}}",
                    "data": function(d) {
                        d.extra_search = $('#form-search').serializeArray();
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