<?php
require_once('../dbconnect.php');
require('check.php');

if (isset($_POST['submit'])) {

    $username = $con->real_escape_string($_POST['username']);
    $password = $con->real_escape_string($_POST['password']);

    // $encrypt_pass = pass_encrypt($password, true);
    // $hash_pass    = password_hash($encrypt_pass, PASSWORD_DEFAULT);

    $sql = "SELECT password FROM users_info WHERE  username= '" . $username . "' ";

    $result = $con->query($sql);
    $row_password = $result->fetch_assoc();


    if (!empty($row_password)) {
        // echo "<div class='alert alert-warning' role='alert'>
        // <b>คำใบ้ มาถูกทางแล้ว</b><br>
        // Password in Database : ".$row_password['password']."</div>";


        if (password_verify(pass_encrypt($password), $row_password['password'])) {
            $sql = "SELECT * FROM users_info 
                  WHERE  username='" . $username . "' 
                  AND  password='" . $row_password['password'] . "' ";

            $result = $con->query($sql);
            $row = $result->fetch_assoc();

            if (!empty($row)) {

                $_SESSION["id"] = $row["id"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["name"] = $row["name"];
                $_SESSION["address"] = $row["address"];
                $_SESSION["tel"] = $row["tel"];
                $_SESSION["password"] = $row["password"];
                $_SESSION["level"] = $row["level"];
                $_SESSION["img"] = $row["img"];

                header("location: index.php");
            } else {
                echo "<script>";
                echo "alert(\" username หรือ  password ไม่ถูกต้อง\");";
                echo "</script>";
                header('Refresh:0; url=login.php');
            }
        } else {
            echo "<script>";
            echo "alert(\" password ไม่ถูกต้อง\");";
            echo "</script>";
        }
    } else {
        echo "<script>";
        echo "alert(\" username ไม่ถูกต้อง\");";
        echo "</script>";
    }



    //password-verify

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="../css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../css/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>LOGIN</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                        <div class="ml-2 mt-2">
                            <a href="register.php">You are not registered yet ? Click.</a>
                        </div>
                        
                    </div>
                </form>

                
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/adminlte.min.js"></script>
    
</body>

</html>