
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../Model/authorization.php';
include_once '../Config/database.php';
// include '../View/registration.php';
$password_err = '';
$phone_err = '';
$success_msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve the form data
    $name = $_POST['name'];
    $login = $_POST['login'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM mydb.users WHERE login = '$login'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $error= "User already exists";
    } else {

    // echo "login: $login<br>";
    // echo "password: $password<br>";

    if(strlen(trim($_POST["password"])) == 0){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
        
    }

    if (!preg_match("/^\+?[0-9]+$/", $phone)) {
        // echo "Password must have atleast 6 characters.<br>";
        $phone_err= "Invalid phone number";
        // header('Location: registration.php');
        
        
     }
    $auth = new Authorization($conn);
    // Register the user
    if(empty($password_err) && empty($phone_err)) {
        if ($auth->registerUser($login, $password, $name, $phone)) {
            $success_msg = 'Congratulations, your account has been successfully created';
            // if(!empty($success_msg)){
            //     sleep(5);
            //     header('Location: dashboard.php');
            //     exit;
            // }
            // echo "<meta http-equiv='refresh' content='5;url=dashboard.php'>";
            // echo "<p>$success_msg</p>";
            // exit;
        } else {
            echo "Error: Unable to register the user";
        }
    }
    
    }
}
?>

