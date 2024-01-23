<!doctype html>
<html lang="en">

<head>
  <title><?php echo e(config('admin.title'), false); ?> | <?php echo e(trans('admin.login'), false); ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo e(admin_asset('login/css/style.css'), false); ?>">
  <?php if(!is_null($favicon = Admin::favicon())): ?>
    <link rel="shortcut icon" href="<?php echo e($favicon, false); ?>">
  <?php endif; ?>
</head>

<body>
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-3">
          <h2 class="heading-section">UPDATE PASSWORD</h2>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-12 col-lg-10">
          <div class="wrap d-md-flex">
            <div class="img p-4 p-md-5">
              <p><b>Ketentuan Standar Password :</b></p>
              <p>1. Panjang password minimal 8 karakter
              <br>2. Mengandung minimal 1 digit angka
              <br>3. Mengandung minimal 1 huruf kapital
              <br>4. Mengandung minimal 1 huruf kecil
              <br>5. Mengandung minimal 1 tanda simbol
              <br>6. Tidak menggunakan simbol petik satu atau dua</p>
            </div>
            <div class="login-wrap p-4 p-md-5">
              <form id="myForm" action="<?php echo e(route('auth.period'), false); ?>" method="post" class="signin-form">
                <div class="form-group mb-3">
                  <label class="label" for="password">Password Baru (minimal 8 karakter)</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password baru" required>
                  <p id="passwordRequirements" style="color: red;"></p>
                </div>
                <div class="form-group mb-3">
                  <label class="label" for="password">Konfirmasi Password</label>
                  <input type="password" class="form-control" name="password_konfirmasi" id="password_konfirmasi" placeholder="Konfirmasi password" required>
                  <p id="passwordMatchMessage" style="color: red;"></p>
                </div>
                <div class="form-group mb-3">
                  <input type="checkbox" id="showPasswordCheckbox"> Show Password</input>
                </div>
                <div class="form-group">
                  <input type="hidden" name="_token" value="<?php echo e(csrf_token(), false); ?>">
                  <input type="hidden" name="username" value="<?php echo e($username, false); ?>">
                  <input type="hidden" name="jenis" value="<?php echo e($jenis, false); ?>">
                  <input type="hidden" name="pass" id="pass" value="<?php echo e($pass, false); ?>">
                  <button style="border: none !important;" type="submit" class="form-control btn btn-primary rounded submit px-3" id="submitButton">Ubah Password</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    document.getElementById('showPasswordCheckbox').addEventListener('change', function() {
      var password = document.getElementById('password');
      var password_konfirmasi = document.getElementById('password_konfirmasi');
      if(this.checked) {
        password.type = 'text';
        password_konfirmasi.type = 'text';
      } else {
        password.type = 'password';
        password_konfirmasi.type = 'password';
      }
    });

    $(document).ready(function() {
      $('#password').on('input', function() {
        var password = $(this).val();
        var pass = $('#pass').val();
        var hasUpperCase = /[A-Z]/.test(password);
        var hasLowerCase = /[a-z]/.test(password);
        var hasSymbol = /[^a-zA-Z0-9'"]/.test(password);
        var hasNumber = /\d/.test(password);
        var isLengthValid = password.length >= 8;
        var isSame = password != pass;
        $('#passwordRequirements').html(
          (!isLengthValid ? 'Minimal 8 karakter<br>' : '') +
          (!hasNumber ? 'Mengandung angka<br>' : '') +
          (!hasUpperCase ? 'Mengandung huruf kapital<br>' : '') +
          (!hasLowerCase ? 'Mengandung huruf kecil<br>': '') +
          (!hasSymbol ? 'Mengandung simbol (bukan petik satu atau dua)<br>': '') +
          (!isSame ? 'Tidak boleh sama dengan password sebelumnya': '')
        );
        updateSubmitButtonState();
      });

      $('#password_konfirmasi').on('input', function() {
        var password = $('#password').val();
        var confirmPassword = $(this).val();
        if(!(password === confirmPassword)) {
          $('#passwordMatchMessage').text('Konfirmasi password tidak cocok');
        } else {
          $('#passwordMatchMessage').text('');
        }
        updateSubmitButtonState();
      });

      function updateSubmitButtonState() {
        var password = $('#password').val();
        var confirmPassword = $('#password_konfirmasi').val();
        var pass = $('#pass').val();
        var hasUpperCase = /[A-Z]/.test(password);
        var hasLowerCase = /[a-z]/.test(password);
        var hasSymbol = /[^a-zA-Z0-9'"]/.test(password);
        var hasNumber = /\d/.test(password);
        var isLengthValid = password.length >= 8;
        var isSame = password != pass;
        var passwordsMatch = password === confirmPassword;
        $('#submitButton').prop('disabled', !(hasUpperCase && hasLowerCase && hasSymbol && hasNumber && isLengthValid && isSame && passwordsMatch));
        $('#submitButton').attr('style', function(i, style) {
          return (style || '') + ($('#submitButton').prop('disabled') ? 'background: grey !important;' : 'background: #e3b04b !important;');
        });
      }
    });
  </script>
  <script src="<?php echo e(admin_asset('login/js/jquery.min.js'), false); ?>"></script>
  <script src="<?php echo e(admin_asset('login/js/popper.js'), false); ?>"></script>
  <script src="<?php echo e(admin_asset('login/js/bootstrap.min.js'), false); ?>"></script>
  <script src="<?php echo e(admin_asset('login/js/main.js'), false); ?>"></script>
</body>

</html><?php /**PATH /home/webapps/anri.siap/resources/views/admin/password_check.blade.php ENDPATH**/ ?>