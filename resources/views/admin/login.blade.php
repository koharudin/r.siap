<!doctype html>
<html lang="en">

<head>
  <title>{{ config('admin.title') }} | {{ trans('admin.login') }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ admin_asset("login/css/style.css") }}">
  @if(!is_null($favicon = Admin::favicon()))
    <link rel="shortcut icon" href="{{ $favicon }}">
  @endif

  <style>
    #loadingIndicator {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(219, 215, 210, 0.95);
      padding: 100%;
      border-radius: 10px;
      text-align: center;
      z-index: 9999;
    }
    .loader {
      display: inline-block;
      width: 30px;
      height: 30px;
      border: 3px solid rgba(0, 0, 0, 0.3);
      border-radius: 50%;
      border-top-color: #007bff;
      animation: spin 1s ease-in-out infinite;
      /* margin-right: 10px; */
      margin-bottom: 5px;
      vertical-align: middle;
    }
    .loading-text {
      display: inline-block;
      font-size: 20px;
      color: black;
    }
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>

<body onload="actionLoginSso()">
  <div id="loadingIndicator">
    <div class="loader"></div>
    <p class="loading-text">Login SSO</p>
  </div>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-3">
          <h2 class="heading-section">APLIKASI SIAP-ANRI</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="wrap d-md-flex">
            <div class="img" style="background-image: url({{ env('CLIENT_BACKGROUND') }}); background-size: contain">
            </div>
            <div class="login-wrap p-4 p-md-5">
              <!-- <div class="d-flex">
                <div class="w-100">
                  <h3 class="mb-4">SELAMAT DATANG DI APLIKASI SIAP-ANRI</h3>
                </div>
                <div class="w-100">
                  <p class="social-media d-flex justify-content-end">

                  </p>
                </div>
              </div> -->
              <form action="{{ admin_url('auth/login') }}" method="post" class="signin-form">
                @if($errors->has('username'))
                  @foreach($errors->get('username') as $message)
                    <div class="alert alert-danger">{{ $message }}</div>
                  @endforeach
                @endif
                @if(env('USE_CAPTCHA'))
                  @error('g-recaptcha-response')
                    <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                @endif
                @if(session('success'))
                  <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <!-- <div class="form-group mb-3">
                  <label class="label" for="jenis">Jenis</label>
                  <select class="form-control select2" name='jenis' data-value="{{ old('jenis') }}">
                    <option value=2 @if(old('jenis')==2) SELECTED @endif>NIP</option>
                    <option value=1 @if(old('jenis')==1) SELECTED @endif>PIN ABSEN</option>
                    <option value=3 @if(old('jenis')==3) SELECTED @endif>EMAIL DINAS</option>
                  </select>
                </div> -->
                <div class="form-group mb-3">
                  <label class="label" for="username">NIP</label>
                  <input type="text" class="form-control" name="username" placeholder="Masukan NIP" value="{{ old('username') }}" required>
                </div>
                @if($errors->has('password'))
                  @foreach($errors->get('password') as $message)
                    <div class="alert alert-danger">{{ $message }}</div>
                  @endforeach
                @endif
                <div class="form-group mb-3">
                  <label class="label" for="password">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Masukan password" required>
                </div>
                <div class="form-group mb-3">
                  @if(env('USE_CAPTCHA'))
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display() !!}
                  @endif
                </div>
                <div class="form-group">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="jenis" value=2>
                  <button type="submit" class="form-control btn btn-primary rounded submit px-3">{{ trans('admin.login') }}</button>
                </div>
                <div class="form-group">
                  <center>
                    <!-- <a href="{{ route('auth.sso') }}" class='btn btn-primary rounded submit px-3'><i class='fa fa-cog'></i>&nbsp; Login dengan SSO</a> -->
                    <a onclick="keycloak.login()" class='btn btn-info rounded submit px-3 col-md-6' style="color: black;"><i class='fa fa-cog'></i>&nbsp; Login dengan SSO</a>
                  </center>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/keycloak-js@24.0.4/dist/keycloak.min.js"></script>
  <script src="{{ admin_asset("login/js/jquery.min.js") }}"></script>
  <script src="{{ admin_asset("login/js/popper.js") }}"></script>
  <script src="{{ admin_asset("login/js/bootstrap.min.js") }}"></script>
  <script src="{{ admin_asset("login/js/main.js") }}"></script>
  <script>
    const keycloak = new Keycloak({
      url: 'https://sso-siasn.bkn.go.id/auth',
      realm: 'public-siasn',
      clientId: 'anriclient'
    });

    async function actionLoginSso() {
      let silent = 'https://kepegawaian.anri.go.id/siap/silentsso.html';
      let authenticate;
      try {
        authenticate = await keycloak.init({
          onLoad: 'check-sso',
          silentCheckSsoRedirectUri: silent
        });
      } catch(error) {
        console.log("error", error);
      }
      try {
        if(authenticate) {
          $('#loadingIndicator').show();
          var credentials = {
            _token: '{{ csrf_token() }}',
            refresh_token: keycloak.refreshToken,
            username: keycloak.idTokenParsed.preferred_username,
            jenis: 2
          };
          $.ajax({
            url: '{{ admin_url('auth/login') }}',
            method: 'POST',
            data: credentials,
            success: function() {
              window.location.reload();
            },
            error: function(xhr, status, error) {
              console.error('Error:', error);
            }
          });
        }
      } catch(error) {
        console.log("error", error)
      }
    };
  </script>
</body>
</html>
