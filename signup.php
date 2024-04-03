
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>

    <link rel="stylesheet" href="Formstyle.css" />
    <title>Exploree</title>
    
</head>
<body>

<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>

 <!--start of signup form -->
 <div class="container">
  
 <div class="forms-container">
        <div class="signin-signup">
          <form action="#" class="sign-in-form">
          <h2 class="title"></h2>
            
          </form>

      <form action="#" class="sign-up-form" method="post">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" class="login-input" name="username" placeholder="Username" required />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="text" class="login-input" name="email" placeholder="Email Address">
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" class="login-input" name="password" placeholder="Password">
            </div>
            <input type="submit" name="submit" value="Register" class="btn solid">


            



            <!-- social media links-->
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>







      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Please sign up to be one of us
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3></h3>
            <p>
             
            </p>
            <button class="btn transparent" id="sign-in-btn">
              
            </button>
          </div>
          <img src="signup-login/images/Login.jpg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="signup-login/js/Form.JS"></script>
  


<?php
    }
?>



</body>
</html>