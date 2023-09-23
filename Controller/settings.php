<?php

include_once '../Model/authorization.php';
include_once '../Config/database.php';
include_once '../Controller/login.php';
// include_once '../View/upload.php';
// include '../Controller/login.php';
// session_start();
$phone_err= "";
$success_msg="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $lang = $_POST['lang'];
    // echo "login: $lang<br>";
    $userId = $_SESSION['user_id'];

    $firstName = $_POST['first_name'];
    
    $lastName = $_POST['last_name'];
    $bio = $_POST['about_me'];

    $firstNameAz = $_POST['first_name_az'];
    // echo "login: $firstNameAz<br>";
    $lastNameAz = $_POST['last_name_az'];
    $bioAz = $_POST['about_me_az'];


    $phoneNumber = $_POST['phone_number'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $birthdate = $_POST['birthdate'];
    // $profileImage = $_POST['imageToUpload'];
    // echo "login: $profileImage<br>";
    // move_uploaded_file($profileImage, "../Media/uploads/". $profileImage);

    if(isset($_FILES['imageToUpload']) && !isset($_POST['button1']) && $_FILES['imageToUpload']['tmp_name'] !== ''){
      $target_dir = "../Media/uploads/";
      $target_file = $target_dir . basename($_FILES['imageToUpload']['name']);
      // var_dump($_FILES);
      $check = getimagesize($_FILES['imageToUpload']['tmp_name']);
  
      if($check === false) {
          echo "File is not an image.";
          exit;
      }
  
      if ($_FILES["imageToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          exit;
      }
  
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          exit;
      }
  
      $img = imagecreatefromstring(file_get_contents($_FILES['imageToUpload']['tmp_name']));
      $width = imagesx($img);
      $height = imagesy($img);
      $newWidth = 300;
      $newHeight = 300;
      $resizedImg = imagecreatetruecolor($newWidth, $newHeight);
      imagecopyresampled($resizedImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
  
      $filename = time() . '.' . $imageFileType;
      imagejpeg($resizedImg, $target_dir . $filename);
  
      $_SESSION['profile_img'] = $filename;
  
      $profileImage = $filename;
  }
    $profileImage = isset($_SESSION['profile_img']) ? $_SESSION['profile_img'] : "";
  //   else{
    //     echo "Image not found!";
    //   }

    if (!preg_match("/^\+?[0-9]+$/", $phoneNumber)) {
        $phone_err= "Invalid phone number";
              
     }
    if(isset($_POST['button1'])) {

    $updateQuery = $conn->prepare("UPDATE mydb.user_profiles SET profile_image = NULL WHERE user_id = ?");
    $updateQuery->bind_param("i", $userId);
    $updateQuery->execute();

    $profileImage = NULL;
    }
    if(!isset($_POST['button1']) && empty($phone_err) && empty($city_err)) {
    $sql = "SELECT * FROM mydb.user_profiles WHERE user_id = '$userId'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // header("Location: settings.php?error=nulu");
        $deleteQuery = $conn->prepare("DELETE FROM mydb.user_profiles WHERE user_id = ?");
        $deleteQuery->bind_param("i", $userId);
        $deleteQuery->execute();
    }

    $auth = new Authorization($conn);

    if ($auth->createProfile($userId, 1, $firstName, $lastName, $bio, $phoneNumber, $city, $gender, $birthdate, $profileImage) && $auth->createProfile($userId, 2, $firstNameAz, $lastNameAz, $bioAz, $phoneNumber, $city, $gender, $birthdate, $profileImage)) {
        $success_msg = 'Congratulations, your profile has been successfully created!';
        // echo "Profile created successfully!";

    } else {
        echo "Error creating profile.";
    }
}


}
?>