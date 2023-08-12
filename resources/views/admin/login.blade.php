<!doctype html>
<html lang="en">

<head>
  <title>{{config('admin.title')}} | {{ trans('admin.login') }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="{{ admin_asset("login/css/style.css")}}">
  @if(!is_null($favicon = Admin::favicon()))
  <link rel="shortcut icon" href="{{$favicon}}">
  @endif
</head>

<body>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
          <h2 class="heading-section">{{config('admin.name')}}</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="wrap d-md-flex">
            <div class="img" style="background-image: url({{env('CLIENT_BACKGROUND')}});background-size:cover">
            </div>
            <div class="login-wrap p-4 p-md-5">
              <div class="d-flex">
                <div class="w-100">
                  <h3 class="mb-4">&nbsp;</h3>
                </div>
                <div class="w-100">
                  <p class="social-media d-flex justify-content-end">

                  </p>
                </div>
              </div>
              <form action="{{ admin_url('auth/login') }}" method="post" class="signin-form">
                @if($errors->has('username'))
                @foreach($errors->get('username') as $message)
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
                @endforeach
                @endif
                <div class="form-group mb-3">
                  <label class="label" for="jenis">Jenis</label>
                  <select class="form-control  select2" name='jenis' data-value="{{ old('jenis') }}">

                    <option value=2 @if(old('jenis')==2) SELECTED @endif>USERNAME/NIP</option>
                    <option value=1 @if(old('jenis')==1) SELECTED @endif>PIN ABSEN</option>
                    <option value=3 @if(old('jenis')==3) SELECTED @endif>EMAIL DINAS</option>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label class="label" for="username">Username</label>
                  <input type="text" class="form-control" name="username" placeholder="{{ trans('admin.username') }}" value="{{ old('username') }}" required>
                </div>
                @if($errors->has('password'))
                @foreach($errors->get('password') as $message)
                <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
                @endforeach
                @endif
                <div class="form-group mb-3">
                  <label class="label" for="password">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="{{ trans('admin.password') }}" required>
                </div>
                <div class="form-group">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <button type="submit" class="form-control btn btn-primary rounded submit px-3">{{ trans('admin.login') }}</button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="{{ admin_asset("login/js/jquery.min.js")}}"></script>
  <script src="{{ admin_asset("login/js/popper.js")}}"></script>
  <script src="{{ admin_asset("login/js/bootstrap.min.js")}}"></script>
  <script src="{{ admin_asset("login/js/main.js")}}"></script>

</body>

</html>