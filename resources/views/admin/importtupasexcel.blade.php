<div class="col-md-4">
    <div class="text-right">
        <form action="{{ admin_url('tupas/importtupasexcel') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input class="form-control" type="file" name="excel_file" accept=".xlsx, .xls">
            <button class="btn btn-primary" type="submit">Import Excel</button>
        </form>
    </div>
</div>
