<?php
require_once "include/config.php";
require_once "login_val.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="admin/plugins/bootstrap.css">

</head>


<body class="account-pages bg-dark text-light">

    <!-- Begin page -->
    <div class="accountbg" style="background: url('admin/assets/images/bg-1.jpg');background-size: cover;background-position: center;"></div>

    <div class="container">
        <h2 class="text-uppercase text-center mt-5 pt-5">Sign In</h2>
        <div class="row justify-content-center">
            <div class="col-11 col-sm-9 col-md-7 col-lg-5  mb-3 border border-3 p-4 rounded rounded-4 shadow g-4">
                <form class="" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                    <!-- email not match     -->
                    <?php if (isset($email_not_matched)) { ?>
                        <div class="alert alert-danger">
                            <?= $email_not_matched; ?>
                        </div>
                    <?php } ?>
                    <!-- password not match -->
                    <?php if (isset($password_not_matched)) { ?>
                        <div class="alert alert-danger">
                            <?= $password_not_matched ?>
                        </div>
                    <?php } ?>

                    <div class="form-group m-b-20 row">
                        <div class="col-12 form-group">
                            <label for="emailaddress" class="form-label text-light">Email address</label>
                            <input class="form-control" type="text" id="emailaddress" placeholder="Enter your email" name="email" value="<?php if (isset($email)) {
                                                                                                                                                echo $email;
                                                                                                                                            } ?>">
                        </div>
                    </div>

                    <div class="form-group row m-b-20">
                        <div class="col-12 form-group">
                            <label for="password" class="text-light">Password</label>
                            <input class="form-control" type="password" id="password" placeholder="Enter your password" name="password" value="<?php if (isset($password)) {
                                                                                                                                                    echo $password;
                                                                                                                                                } ?>">
                        </div>
                    </div>

                    <div class="form-group row m-b-20">
                        <div class="col-12">

                            <div class="checkbox checkbox-custom">
                                <input id="remember" type="checkbox" checked="">
                                <label for="remember" class="text-light">
                                    Remember me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row text-center m-t-10">
                        <div class="col-12">
                            <input class="btn btn-block btn-primary form-control" type="submit" value="Login" name="login">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>