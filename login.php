<?php
session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title>LOGIN</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form action="login_data.php" method="post">
        <h2>LOGIN</h2>

        <label>User Name</label>
        <input type="text" name="uname" placeholder="User Name"><br>
        <?php if (isset($_SESSION['user_error'])) { ?>
            <p class="error"><?= $_SESSION['user_error'] ?></p>
        <?php } ?>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>
        <?php if (isset($_SESSION['pass_error'])) { ?>
            <p class="error"><?= $_SESSION['pass_error'] ?></p>
        <?php } ?>

        <button type="submit">Login</button>
        <a href="signup.php" class="ca">Create an account</a>

        <?php if (isset($_SESSION['login_error'])) { ?>
            <p class="error"><?= $_SESSION['login_error'] ?></p>
        <?php } ?>
    </form>

</body>

</html>


<?php
unset($_SESSION['user_error']);
unset($_SESSION['pass_error']);
unset($_SESSION['login_error']);
?>