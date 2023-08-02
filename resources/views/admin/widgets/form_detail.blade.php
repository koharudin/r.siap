<form {!! $attributes !!}>
    <div class="box-body fields-group">
        @foreach($fields as $field)
        {!! $field->readonly()->render() !!}
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