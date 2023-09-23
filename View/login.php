<?php include 'header.php' ?>;
<?php include '../Controller/login.php';?>
<?php include 'footer.php' ?>;

<link rel="stylesheet" href="../Media/css/login.css"> 
</head>  
<body class="text-center">
    
<main class="form-signin">
  <form method="POST">
    <img class="mb-4" src="../Media/img/make-icon.png" alt="" width="100" height="80">
    <h1 class="h3 mb-3 fw-normal">Sign in</h1>

    <?php if (isset($error)) { ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php } ?>

    <div class="form-floating">
      <input type="text" name="login" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="floatingInput" placeholder="name@example.com" <?php if(isset($_SESSION['set_check'])) echo 'value="'.$_SESSION['login_cookie'].'"'; ?>>

      <label for="floatingInput">Login</label>
      <?php if(!empty($username_err)) echo "<div style='color:red; margin-bottom:10px; margin-right:100px;'>$username_err</div>" ?> 
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="floatingPassword" placeholder="Password" <?php if(isset($_SESSION['set_check'])) echo 'value="'.$_SESSION['password_cookie'].'"'; ?>>
      <label for="floatingPassword">Password</label>
      <?php if(!empty($password_err)) echo "<div style='color:red; margin-bottom:10px; margin-right:100px;'>$password_err</div>" ?> 
    </div>
    <div class="checkbox mb-3">
        <label>
          <input type="checkbox" name="remember_me" value = "1" <?php if(isset($_SESSION['set_check'])) echo 'checked'; ?>> Remember me
        </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign in</button>
  </form>
  <form method="POST" action="../Controller/fb-login.php">
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit" style="margin-top:10px;">Sign in with facebook</button>
  </form>
  <div class="link">
              Don't have an account? <a class="login_link" href="/View/registration.php">Sign up</a>
  </div>
</main>




