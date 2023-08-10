<div class="content row">
    <div class="col-md-4">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Informasi Pegawai</h3>

                <div class="box-tools">
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group  ">
                    <label for="jenis_sertifikasi" class="col-md-4 control-label">NAMA</label>
                    <div class="col-sm-8">
                        <div class="box box-solid box-default no-margin">
                            <!-- /.box-header -->
                            <div class="box-body">
                                {{$form->getForm()->record->obj_employee->first_name}}
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <div class="form-group  ">
                    <label for="jenis_sertifikasi" class="col-md-4 control-label">NIP </label>
                    <div class="col-sm-8">
                        <div class="box box-solid box-default no-margin">
                            <!-- /.box-header -->
                            <div class="box-body">
                                {{$form->getForm()->record->obj_employee->nip_baru}}
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $form->title() }}</h3>

                <div class="box-tools">
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            {!! $form->open() !!}

            <div class="box-body">

                @if(!$tabObj->isEmpty())
                @include('admin::form.tab', compact('tabObj'))
                @else
                <div class="fields-group">

                    @if($form->hasRows())
                    @foreach($form->getRows() as $row)
                    {!! $row->render() !!}
                    @endforeach
                    @else
                    @foreach($layout->columns() as $column)
                    <div class="col-md-{{ $column->width() }}">
                        @foreach($column->fields() as $field)
                        {!! $field->render() !!}
                        <div class='form-group'>
                            <div class='col-sm-2'>

                            </div>
                            @if($field->getView()=='admin::form.file' && $field->variables()['id'] != 'dokumen_pendukung_usulan')
                            <a target='_blank' class='btn btn-danger' href="{{@session('old_data')[$field->variables()['id']]}}">File</a>
                            @elseif($field->getView()!='admin::form.hidden')
                            <div class='col-sm-10'>
                                <span class='label label-danger'>{{@session('old_data')[$field->variables()['id']]}}</span>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                    @endif
                </div>
                @endif

            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <div class="col-md-{{$width['label']}}"></div>

                <div class="col-md-{{$width['field']}}">
                    <input type="hidden" name="btn_action_">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @if($form->getForm()->able2verify)
                    <div class=" pull-left">
                        <button type="submit" name="btn_action" value="TOLAK" class="btn bg-danger btn-flat margin"> <i class='fa fa-remove'></i> TOLAK </button>

                    </div>
                    <div class=" pull-right">
                        <button type="submit" name="btn_action" value="TERIMA" class="btn bg-primary btn-flat margin"><i class='fa fa-check'></i> TERIMA </button>
                    </div>
                    @endif
                </div>
            </div>
            <script>
                (function(jQuery) {
                    $("[name=btn_action]").click(function() {
                        $("[name=btn_action_]").val($(this).val());
                    });
                })();
            </script>
            @foreach($form->getHiddenFields() as $field)
            {!! $field->render() !!}
            @endforeach

            <!-- /.box-footer -->
            {!! $form->close() !!}
        </div>
    </div>
</div>