<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle" src="{{$e->showPhoto()}}" alt="User profile picture">
                <h3 class="profile-username text-center">{{$e->first_name}}</h3>
                <p class="text-muted text-center">{{$e->nip_baru}}</p>
                <ul class="list-group list-group-unbordered">
                    @foreach($links as $k=>$v)
                    <a class="btn btn-default btn-block" href="{{url('/admin/profile',[request('profile_id'),$v])}}">
                        <i class=""></i> {{$k}}
                    </a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        {!! $g !!}
    </div>
</div>