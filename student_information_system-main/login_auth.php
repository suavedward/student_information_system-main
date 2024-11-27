<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Auth</title>
    <link rel="stylesheet" href="assets/css/global.css" />
  </head>
  <?php include 'db_connection.php';?>
  <body>
    <div class="login-auth-container">
      <div class="login-auth-header">
        <header>LOGIN</header>
        <div class="login-auth">
          <button class="login-google" id="login-google">
            <img src="assets/images/google.png" alt="Google Icon" />
            <p>Log in to your Account</p>
          </button>
        </div>
      </div>
    </div>

    <script src="assets/js/global.js"></script>
  </body>
</html>
