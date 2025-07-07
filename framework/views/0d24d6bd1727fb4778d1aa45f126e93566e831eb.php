<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f2f5;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      width: 350px;
      text-align: center;
    }

    h2 {
      margin-bottom: 20px;
      color: #333;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    button {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      margin-top: 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
    }

    button:hover {
      background-color: #0056b3;
    }

    .error-message {
      color: red;
      margin-bottom: 10px;
      text-align: left;
    }

    a {
      display: block;
      margin-top: 15px;
      color: #007bff;
      text-decoration: none;
      font-size: 14px;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><h1 class="h4 mb-0">Free Placement Provider</h1></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
              aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link" href="/it/courses">View Course</a>
           <a class="nav-link" href="/">Logout</a>
        </div>
      </div>
    </div>
  </nav>
  <div class="login-container" style="margin-top: 60px;">
    <h2>Login</h2>

    <?php if($errors->any()): ?>
      <div class="error-message">
        <ul>
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>
 <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>
    <form action="<?php echo e(url('/login')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <input type="email" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required>
      <input type="password" name="password" placeholder="Password" required>
       <div class="g-recaptcha" data-sitekey="<?php echo e(env('NOCAPTCHA_SITEKEY')); ?>"></div>
      <button type="submit">Login</button>
    </form>
    <a href="/register">Don't have an account? Register</a>
  </div>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>
</html>
<?php /**PATH C:\Users\vishw\form\resources\views/auth/login.blade.php ENDPATH**/ ?>