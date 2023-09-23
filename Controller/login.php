
<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username_err = "";
$password_err = "";

if (isset($_POST['login']) && isset($_POST['login'])) {
    require_once '../Config/database.php';
    require_once '../Model/authorization.php';
    // require_once 'dashboard.php';

    $auth = new Authorization($conn);

    $login = $_POST['login'];
    $password = $_POST['password'];

    $remember_me = 0;

    if(strlen(trim($_POST["login"])) == 0){
        $username_err = "Please enter your username";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["login"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    }

    if(strlen(trim($_POST["login"])) == 0){
        $password_err = "Please enter your password";
    }
    // echo "login: $login<br>";
    // echo "password: $password<br>";
    if(empty($username_err) && empty($password_err)){
        if ($auth->loginUser($login, $password)) {
            $_SESSION['loggedin'] = true;
        
            if(isset($_POST['remember_me']) && $_POST['remember_me'] == 1 && $_SESSION['loggedin'] === true) {
                $remember_me = 1;
                echo "checked<br>";
                if(isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
                    $_SESSION['login_cookie'] = $_COOKIE['login'];
                    $_SESSION['password_cookie'] = $_COOKIE['password'];
                    $_SESSION['set_check'] = 'checked';
                }
            
                if(isset($remember_me)) {
                    $hour = time() + 3600 * 24 *30;
                    setcookie('login',$login,$hour);
                    setcookie('password',$password,$hour);
                } else {
                    $hour = time() + + 3600 * 24 *30;
                    setcookie('login',$login,$hour);
                    setcookie('password',$password,$hour);
                    $_SESSION['login_cookie'] = "";
                    $_SESSION['password_cookie'] = "";
                    $_SESSION['set_check'] = '';
            
                }
            }
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password";
            $username_err = " ";
            $password_err = " ";
            // echo "Invalid username or password<br>";
        }
    }
}
?>



