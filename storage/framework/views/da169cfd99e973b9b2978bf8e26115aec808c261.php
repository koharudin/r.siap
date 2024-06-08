<!doctype html>
<html lang="en">

<head>
  <title><?php echo e(config('admin.title'), false); ?> | <?php echo e(trans('admin.login'), false); ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo e(admin_asset("login/css/style.css"), false); ?>">
  <?php if(!is_null($favicon = Admin::favicon())): ?>
    <link rel="shortcut icon" href="<?php echo e($favicon, false); ?>">
  <?php endif; ?>

  <style>
    #loadingIndicator {
        display: block;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(219, 215, 210, 0.95);
        padding: 100%;
        border-radius: 10px;
        text-align: center;
    }
    .loader {
        display: inline-block;
        width: 30px;
        height: 30px;
        border: 3px solid rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        border-top-color: #007bff;
        animation: spin 1s ease-in-out infinite;
        margin-right: 10px;
        margin-bottom: 5px;
        vertical-align: middle;
    }
    .loading-text {
        display: inline-block;
        font-size: 16px;
    }
    @keyframes  spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
  </style>
</head>

<body onload="actionLoginSso()">
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
            <div class="img" style="background-image: url(<?php echo e(env('CLIENT_BACKGROUND'), false); ?>); background-size: contain">
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
              <form action="<?php echo e(admin_url('auth/login'), false); ?>" method="post" class="signin-form">
                <?php if($errors->has('username')): ?>
                  <?php $__currentLoopData = $errors->get('username'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="alert alert-danger"><?php echo e($message, false); ?></div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <!-- <?php if(env('USE_CAPTCHA')): ?>
                  <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="alert alert-danger"><?php echo e($message, false); ?></div>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php endif; ?> -->
                <?php if(session('success')): ?>
                  <div class="alert alert-success"><?php echo e(session('success'), false); ?></div>
                <?php endif; ?>
                <!-- <div class="form-group mb-3">
                  <label class="label" for="jenis">Jenis</label>
                  <select class="form-control select2" name='jenis' data-value="<?php echo e(old('jenis'), false); ?>">
                    <option value=2 <?php if(old('jenis')==2): ?> SELECTED <?php endif; ?>>NIP</option>
                    <option value=1 <?php if(old('jenis')==1): ?> SELECTED <?php endif; ?>>PIN ABSEN</option>
                    <option value=3 <?php if(old('jenis')==3): ?> SELECTED <?php endif; ?>>EMAIL DINAS</option>
                  </select>
                </div> -->
                <div class="form-group mb-3">
                  <label class="label" for="username">NIP</label>
                  <input type="text" class="form-control" name="username" placeholder="Masukan NIP" value="<?php echo e(old('username'), false); ?>" required>
                </div>
                <?php if($errors->has('password')): ?>
                  <?php $__currentLoopData = $errors->get('password'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="alert alert-danger"><?php echo e($message, false); ?></div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <div class="form-group mb-3">
                  <label class="label" for="password">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Masukan password" required>
                </div>
                <!-- <div class="form-group mb-3">
                  <?php if(env('USE_CAPTCHA')): ?>
                    <?php echo NoCaptcha::renderJs(); ?>

                    <?php echo NoCaptcha::display(); ?>

                  <?php endif; ?>
                </div> -->
                <div class="form-group">
                  <input type="hidden" name="_token" value="<?php echo e(csrf_token(), false); ?>">
                  <input type="hidden" name="jenis" value=2>
                  <button type="submit" class="form-control btn btn-primary rounded submit px-3"><?php echo e(trans('admin.login'), false); ?></button>
                </div>
                <div class="form-group">
                  <center>
                    <!-- <a href="<?php echo e(route('auth.sso'), false); ?>" class='btn btn-primary rounded submit px-3'><i class='fa fa-cog'></i>&nbsp; Login dengan SSO</a> -->
                    <a onclick="keycloak.login()" class='btn btn-primary rounded submit px-3 col-md-6'><i class='fa fa-cog'></i>&nbsp; Login dengan SSO</a>
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
  <script src="<?php echo e(admin_asset("login/js/jquery.min.js"), false); ?>"></script>
  <script src="<?php echo e(admin_asset("login/js/popper.js"), false); ?>"></script>
  <script src="<?php echo e(admin_asset("login/js/bootstrap.min.js"), false); ?>"></script>
  <script src="<?php echo e(admin_asset("login/js/main.js"), false); ?>"></script>
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
          var credentials = {
            _token: '<?php echo e(csrf_token(), false); ?>',
            refresh_token: keycloak.refreshToken,
            username: keycloak.idTokenParsed.preferred_username,
            jenis: 2
          };
          $.ajax({
            url: '<?php echo e(admin_url('auth/login'), false); ?>',
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
<?php /**PATH /home/webapps/anri.siap/resources/views/admin/login.blade.php ENDPATH**/ ?>