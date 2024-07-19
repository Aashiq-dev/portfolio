<?php
session_start();
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user_check_query = "SELECT * FROM users WHERE email='$email'";
    $user_check = $con->query($user_check_query);

    if ($user_check->num_rows == 0) {

        // if username not match
        $email_not_matched = "Your email not matched!";
    } else {

        // if username match
        $row = $user_check->fetch_assoc();
        if ($password == $row['password']) {
            $_SESSION['admin'] = 'admin';
            // header('Location: admin/home.php');
            echo "<script>window.location.href='admin/index.php'</script>";
            exit;
        } else {
            // if password not matched

            $password_not_matched = "Your password not matched";
        }
    }
}