<?php include 'login.php';?>

<html>
    <head>
        <title>User Login</title>
        <link rel ="stylesheet" href ="public/css/style.css" type="text/css">
    </head>

    <body>

            <div class="container" >
                <?php if(empty($_SESSION["user_id"])) { ?>
                    <header>
                        <h1 id="main_title">Dolce Login Test</h1>
                    </header>

                    <div class="login_box">
                        <form action="" method="post" id="frmLogin">
                            <div class="error-message"><?php if(isset($message)) { echo $message; } ?></div>
                            <div class="field-group">
                                <div><label for="login">Username</label></div>
                                <div><input name="user_name" type="text" class="input-field"></div>
                            </div>
                            <div class="field-group">
                                <div><label for="password">Password</label></div>
                                <div><input name="password" type="password" class="input-field"> </div>
                            </div>
                            <div class="field-group">
                                <div><input type="submit" name="login" value="Login" class="form-submit-button"></span></div>

                            </div>

                        </form>
                        <?php
                    } else {
                    $result = mysqlI_query($conn,"SELECT * FROM users WHERE user_id='" . $_SESSION["user_id"] . "'");
                    $user  = mysqli_fetch_array($result);
                    ?>
                    <form action="" method="post" id="frmLogout">
                        <div class="member-dashboard">Welcome <?php echo ($user['user_name']); ?>, You have successfully logged in.<br>
                            Click to <input type="submit" name="logout" value="Logout" class="logout-button">.</div>
                    </form>
                </div>
            </div>
        <?php } ?>
        <p>
            <a href="http://localhost/login_dolce/register.php">Sign up</a>
        </p>
    </body>
</html>