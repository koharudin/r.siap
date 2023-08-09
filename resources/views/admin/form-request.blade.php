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
                    @if($field->getView()=='admin::form.file')
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
            <div class=" pull-left">
                @if(@$form->getForm()->able2draft)
                <button type="submit" name="btn_action" value="DRAFT" class="btn bg-default btn-flat margin"> <i class='fa fa-save'></i> DRAFT </button>
                @endif 
            </div>
            <div class=" pull-right">

                @if(@$form->getForm()->able2send)
                <button type="submit" name="btn_action" value="KIRIM" class="btn bg-primary btn-flat margin"><i class='fa fa-arrow-right'></i> KIRIM </button>
                @endif
            </div>
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