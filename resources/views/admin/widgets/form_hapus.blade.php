<form {!! $attributes !!}>
    <div class="box-body fields-group">
        @foreach($fields as $field)
        {!! $field->render() !!}
        <div class='form-group'>
            <div class='col-sm-2'>

            </div>
            @if($field->getView()!='admin::form.hidden')
            <div class='col-sm-10'>
                <span class='label label-danger'>{{@$oldData[$field->variables()['id']]}}</span>
            </div>
            @endif
        </div>
        @endforeach

    </div>

    @if ($method != 'GET')
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    @endif

    <!-- /.box-body -->
    <div class="box-footer">
        <div class="col-md-{{$width['label']}}"></div>

        <div class="col-md-{{$width['field']}}">
            @if(in_array('reset', $buttons))
            <div class="btn-group pull-left">
                <button type="reset" class="btn btn-warning pull-right">{{ trans('admin.reset') }}</button>
            </div>
            @endif
            <input type="hidden" name="btn_action_">
            @if($able2verify)
            <div class=" pull-left">
                <button type="submit" name="btn_action" value="TOLAK" class="btn bg-danger btn-flat margin"> <i class='fa fa-remove'></i> BATAL </button>

            </div>
            <div class=" pull-right">
                <button type="submit" name="btn_action" value="TERIMA" class="btn bg-primary btn-flat margin"><i class='fa fa-check'></i> HAPUS </button>
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
</form>