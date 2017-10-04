<?php
if(!empty($_POST["register-user"])) {
    /* Form Required Field Validation */
    foreach($_POST as $key=>$value) {
        if(empty($_POST[$key])) {
            $error_message = "All Fields are required";
            break;
        }
    }
    /* Password Matching Validation */
    if($_POST['password'] != $_POST['confirm_password']){
        $error_message = 'Passwords should be same<br>';
    }

    /* Email Validation */
    if(!isset($error_message)) {
        if (!filter_var($_POST["userEmail"], FILTER_VALIDATE_EMAIL)) {
            $error_message = "Invalid Email Address";
        }
    }


    if(!isset($error_message)) {
        require_once("registerController.php");
        $db_handle = new registerController();
        $query = "INSERT INTO users (user_name, password, email) VALUES
		('" . $_POST["userName"] . "', '" . md5($_POST["password"]) . "', '" . $_POST["userEmail"] . "')";
        $result = $db_handle->insertQuery($query);
        if(!empty($result)) {
            $error_message = "";
            $success_message = "You have registered successfully!";
            unset($_POST);
        } else {
            $error_message = "Something went wrong. Try Again!";
        }
    }
}
?>
<html>
    <head>
        <title>PHP User Registration Form</title>
        <link rel ="stylesheet" href ="public/css/register_style.css" type="text/css">
    </head>

    <body>
        <div class="container">
            <form name="frmRegistration" method="post" action="">
                <h3 id="reg_title">Please complete your registration by filling the form. </h3>
                <table border="0" width="500" align="center" class="demo-table">

                    <?php if(!empty($success_message)) { ?>
                        <div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
                    <?php } ?>
                    <?php if(!empty($error_message)) { ?>
                        <div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
                    <?php } ?>
                    <tr>
                        <td>User Name</td>
                        <td><input type="text" class="demoInputBox" name="userName" value="<?php if(isset($_POST['userName'])) echo $_POST['userName']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" class="demoInputBox" name="password" value=""></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td><input type="password" class="demoInputBox" name="confirm_password" value=""></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="text" class="demoInputBox" name="userEmail" value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail']; ?>"></td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="submit" name="register-user" value="Register" class="btnRegister">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <p>
            <a href="http://localhost/login_dolce/">Go back to login</a>
        </p>
    </body>
</html>
