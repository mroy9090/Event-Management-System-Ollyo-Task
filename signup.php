<?php

session_start();

?>


<!DOCTYPE html>
<html>

<head>
     <title>SIGN UP</title>
     <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
     <form action="signup-check.php" method="post">
          <h2>SIGN UP</h2>
          <?php if (isset($_SESSION['error'])) { ?>
               <p class="error"><?= $_SESSION['error']; ?></p>
          <?php } ?>

          <?php if (isset($_SESSION['success'])) { ?>
               <p class="success"><?= $_SESSION['success']; ?></p>
          <?php } ?>

          <label>Name</label>
          <input type="text" name="name" placeholder="Name"><br>
          <?php if (isset($_SESSION['name'])) { ?>
               <p class="error"><?= $_SESSION['name']; ?></p>
          <?php } ?>

          <label>User Email</label>
          <input type="text" name="email" placeholder="User Email"><br>
          <?php if (isset($_SESSION['email'])) { ?>
               <p class="error"><?= $_SESSION['email']; ?></p>
          <?php } ?>

          <label>User Name</label>
          <input type="text" name="uname" placeholder="User Name"><br>
          <?php if (isset($_SESSION['uname'])) { ?>
               <p class="error"><?= $_SESSION['uname']; ?></p>
          <?php } ?>


          <label>Password</label>
          <input type="password" name="password" placeholder="Password"><br>
          <?php if (isset($_SESSION['password_error'])) { ?>
               <p class="error"><?= $_SESSION['password_error']; ?></p>
          <?php } ?>

          <label>Re Password</label>
          <input type="password" name="re_password" placeholder="Re_Password"><br>
          <?php if (isset($_SESSION['re_password_error'])) { ?>
               <p class="error"><?= $_SESSION['re_password_error']; ?></p>
          <?php } ?>

          <?php if (isset($_SESSION['pass_match_error'])) { ?>
               <p class="error"><?= $_SESSION['pass_match_error']; ?></p>
          <?php } ?>
          <label>User Type</label>
          <input type="text" name="usertype" value="NON-ADMIN" placeholder="User Type" readonly>

          <button type="submit">Sign Up</button>
          <a href="login.php" class="ca">Already have an account?</a>
     </form>
</body>

</html>


<?php

unset($_SESSION['success']);
unset($_SESSION['error']);
unset($_SESSION['name']);
unset($_SESSION['uname']);
unset($_SESSION['password_error']);
unset($_SESSION['re_password_error']);
unset($_SESSION['pass_match_error']);
unset($_SESSION['email']);
?>