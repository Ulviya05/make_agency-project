<?php include 'header.php' ?>;
<?php include '../Controller/registration.php';?>
<?php include 'footer.php' ?>;

  <link rel="stylesheet" href="../Media/css/registration.css">
  </head>
  <body class="text-center">
  <main class="form-signup">
    <form method="POST">
        <img class="mb-4" src="../Media/img/make-icon.png" alt="" width="100" height="80">
        <h1 class="h3 mb-3 fw-normal">Sign up</h1>


        <div class="<?php echo (!empty($success_msg)) ? 'alert alert-success' : ''; ?>"><?= $success_msg ?></div>

        <?php if (isset($error)) { ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>
        
        <div class="form-floating">
          <input type="text" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" id="floatingName" name="name" placeholder="Name" required>
          <label for="floatingName">Name</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="floatingUsername" name="login" placeholder="Login" required>
          <label for="floatingUsername">Login</label>
        </div>
        <div class="form-floating">
          <input type="tel" class="form-control <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" id="floatingPhone" name="phone" placeholder="Phone number" required>
          <label for="floatingPhone">Phone number</label>
          <?php if(!empty($phone_err)) echo "<div style='color:red; margin-bottom:10px; margin-right:140px;'>$phone_err</div>" ?> 
        </div>
        
        <div class="form-floating">
          <input type="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" id="floatingPassword" name="password" placeholder="Password" required>
          <label for="floatingPassword">Password</label>
          <?php if(!empty($password_err)) echo "<div style='color:red; margin-bottom:15px;'>$password_err</div>" ?> 
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Sign up</button>
        <div class="link">
            Already have an account? <a class="login_link" href="login.php">Sign in</a>
        </div>
    </form>
</main>
    <script src="../Media/js/bootstrap.min.js"></script> 
  </body>
</html>

