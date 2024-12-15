<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url()?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>assets/admin/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="register-logo">
      <a href="<?= base_url()?>assets/admin/index2.html"><b>Perpustakaan</b>SMA</a>
    </div>

    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>

        <!-- Registration Form -->
        <form action="<?= base_url('auth/prosesregister')?>" method="post">

          <!-- Name -->
          <?php if (isset(session('error')['name'])):?>
              <div class="alert alert-danger"><?= session('error')['name']?></div>
          <?php endif?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Full name" name="name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>

          <!-- NISN -->
          <?php if (isset(session('error')['nisn'])):?>
              <div class="alert alert-danger"><?= session('error')['nisn']?></div>
          <?php endif?>
          <div class="input-group mb-3">
            <input type="number" class="form-control" placeholder="NISN" name="nisn">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-id-card"></span>
              </div>
            </div>
          </div>

          <!-- Email -->
          <?php if (isset(session('error')['email'])):?>
              <div class="alert alert-danger"><?= session('error')['email']?></div>
          <?php endif?>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <!-- Password -->
          <?php if (isset(session('error')['password'])):?>
              <div class="alert alert-danger"><?= session('error')['password']?></div>
          <?php endif?>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <!-- Confirm Password -->
          <?php if (isset(session('error')['confirm_password'])):?>
              <div class="alert alert-danger"><?= session('error')['confirm_password'];?></div>
          <?php endif?>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <!-- Address -->
          <?php if (isset(session('error')['address'])):?>
              <div class="alert alert-danger"><?= session('error')['address'];?></div>
          <?php endif?>
          <div class="input-group mb-3">
            <textarea name="address" class="form-control" rows="3" placeholder="Address"></textarea>
          </div>

          <!-- Class -->
          <?php if (isset(session('error')['class'])):?>
              <div class="alert alert-danger"><?= session('error')['class'];?></div>
          <?php endif?>
          <div class="input-group mb-3">
            <select name="class" class="form-control" required>
              <option value="">Select Class</option>
              <option value="X" <?= old('class') == 'X' ? 'selected' : ''; ?>>X</option>
              <option value="XI" <?= old('class') == 'XI' ? 'selected' : ''; ?>>XI</option>
              <option value="XII" <?= old('class') == 'XII' ? 'selected' : ''; ?>>XII</option>
            </select>
          </div>

          <!-- Gender -->
          <?php if (isset(session('error')['gender'])):?>
              <div class="alert alert-danger"><?= session('error')['gender'];?></div>
          <?php endif?>
          <div class="input-group mb-3">
            <select name="gender" class="form-control" required>
              <option value="">Select Gender</option>
              <option value="laki_laki" <?= old('gender') == 'laki_laki' ? 'selected' : ''; ?>>Male</option>
              <option value="perempuan" <?= old('gender') == 'perempuan' ? 'selected' : ''; ?>>Female</option>
            </select>
          </div>

          <!-- Submit Button -->
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
          </div>
        </form>

        <!-- Redirect Link to Login -->
        <a href="<?= base_url('auth')?>" class="text-center">I already have a membership</a>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="<?= base_url()?>assets/admin/plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url()?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url()?>assets/admin/dist/js/adminlte.min.js"></script>
</body>

</html>
