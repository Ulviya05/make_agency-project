<?php include '../Controller/settings.php';?>
<?php include 'header.php' ?>
<!-- <?php require_once __DIR__ . '/../Controller/dashboard.php';?> -->
<?php include 'footer.php' ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$userId = $_SESSION['user_id'];
// echo "login: $userId<br>";

$query = $conn->prepare("SELECT lang, first_name, last_name, about_me, phone_number, birthdate, city, gender, profile_image 
                         FROM mydb.user_profiles 
                         WHERE user_id = ?");
$query->bind_param("i", $userId);
$query->execute();
$query->bind_result($lang, $firstName, $lastName, $bio, $phoneNumber, $birthdate, $city, $gender, $profileImage1);
$query->fetch();

$row1 = [
    'lang' => $lang,
    'first_name' => $firstName,
    'last_name' => $lastName,
    'about_me' => $bio,
    'phone_number' => $phoneNumber,
    'birthdate' => $birthdate,
    'city' => $city,
    'gender' => $gender,
    'profile_image' => $profileImage1,
];

$query->fetch();
$firstNameAz = isset($firstName) ? $firstName : null;
$lastNameAz = isset($lastName) ? $lastName : null;
$bioAz = isset($bio) ? $bio : null;

$row2 = [
  'first_name' => $firstNameAz,
  'last_name' => $lastNameAz,
  'about_me' => $bioAz,
];


$lang = isset($row1['lang']) ? $row1['lang'] : null;
$firstName = isset($row1['first_name']) ? $row1['first_name'] : null;
$lastName = isset($row1['last_name']) ? $row1['last_name'] : null;
$bio = isset($row1['about_me']) ? $row1['about_me'] : null;
$phoneNumber = isset($row1['phone_number']) ? $row1['phone_number'] : null;
$birthdate = isset($row1['birthdate']) ? $row1['birthdate'] : null;
$city = isset($row1['city']) ? $row1['city'] : null;
$gender = isset($row1['gender']) ? $row1['gender'] : null;
$profileImage1 = isset($row1['profile_image']) ? $row1['profile_image'] : null;

$firstNameAz = isset($row2['first_name']) ? $row2['first_name'] : null;
$lastNameAz = isset($row2['last_name']) ? $row2['last_name'] : null;
$bioAz = isset($row2['about_me']) ? $row2['about_me'] : null;

$profileImage = "../Media/uploads/" . $profileImage1;
// echo "login: $profileImage<br>";

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Language Selector</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="../Media/css/bootstrap.min.css">  
  <link rel="stylesheet" href="../Media/css/settings.css"> 
  <link rel="stylesheet" href="../Media/css/dashboard.css">
</head>
<body>
<div class="container1" style="display: flex;">
  <!-- <div class="row"> -->
  <div class="menu" >   
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="home" viewBox="0 0 16 16">
        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
      </symbol>
      <symbol id="people-circle" viewBox="0 0 16 16">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
      </symbol>
    </svg>

    <main>

      <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height:100vh; position:fixed;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
          <span class="fs-1">Menu</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link text-white" aria-current="page">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
              Home
            </a>
          </li>
          <li>
            <a href="settings.php" class="nav-link text-white">
              <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
              Personal settings
            </a>
          </li>
          <li>
        <a href="parser.php" class="nav-link text-white">
          <!-- <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg> -->
          Parser
        </a>
      </li>
      <li>
        <a href="products.php" class="nav-link text-white">
          <!-- <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg> -->
          Parsed products
        </a>
      </li>
        </ul>
        <hr>
        <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <svg alt="" width="32" height="32" class="bi me-2"><use xlink:href="#people-circle"></svg>
            <strong>user</strong>
          </a>
          <form method="post">
        <button type="submit" name="logout" class="btn btn-lg btn-primary">Log out</button>
          </form>

        </div>
      </div>

      <div class="b-example-divider"></div>
    </main>
  </div>

  <div class="col-md-8" style="display: flex; justify-content:right;">
    <section class="vh-100 gradient-custom">
      <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-9 col-xl-7">
            <div class="card shadow-2-strong card-registration" style="border-radius: 15px; width:600px;">
              <div class="card-body p-4 p-md-5">
                <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Settings</h3>
                <div class="<?php echo (!empty($success_msg)) ? 'alert alert-success' : ''; ?>"><?= $success_msg ?></div>
                <!-- <form action="../Controller/upload.php" method="POST" enctype="multipart/form-data" style="margin: 30px 0px;">
                <input type="file" name="imageToUpload" required>
                <input class="upload_image" type="submit" name="submit" value="Upload">
                </form> -->
                            
              <form method="POST" enctype="multipart/form-data" >    
              <input type="file" name="imageToUpload" style="margin-bottom:20px;">    
                  <div class="row">
                  <br><div class="container">
                    <div class="row">
                    <div class="col-sm-2 imgUp">
                    <div class="imagePreview" style="background-image: url('<?php echo $profileImage; ?>')"></div>
                </div>
                <?php include '../Config/database.php';?>
                    <?php
                    if(isset($row1['profile_image']) && $row1['profile_image'] !== null) { 
                      if(array_key_exists('button1', $_POST)) {
                        button1();
                    }
                    ?>
                    
                    <div class="text-start">
                      <button type="submit" class="delete" name="button1">Delete</button>
                </div>
                    <?php } ?>

                    </div>
                    </div>
                    </div>

                    <div class="buttons text-end">
                      <button type="button" class="btn1 eng-button clicked" value="1">English</button>
                      <button type="button" class="btn1 az-button" value="2">Azerbaijani</button>
                      
                    </div>

                    <div class="eng-fields">
                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <label class="form-label" for="firstName">First Name</label>
                          <input type="text" id="firstName" class="form-control form-control-lg" name="first_name" style="font-size:16px;" required value="<?php echo $firstName; ?>"/>
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <label class="form-label" for="lastName">Last Name</label>
                          <input type="text" id="lastName" class="form-control form-control-lg" name="last_name" style="font-size:16px;" required value="<?php echo $lastName; ?>"/>
                        </div>
                      </div>
                    </div>
                      <div class="column">
                        <div class="col-md-9 pe-5">
                          <label class="form-label about" for="aboutMe">About Me</label>
                          <textarea placeholder="" cols="30" rows="5" id="aboutMe" class="form-control form-control-lg" name="about_me" style="font-size:16px; resize:none; margin-bottom: 20px;" required><?php echo $bio; ?></textarea>
                        </div>
                      </div>
                    </div>

                    <div class="az-fields" style="display:none;">
                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <label class="form-label" for="firstNameAz">Ad</label>
                          <input type="text" id="firstNameAz" class="form-control form-control-lg" name="first_name_az" style="font-size:16px;" required value="<?php echo $firstNameAz; ?>"/>
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <label class="form-label" for="lastNameAz">Soyad</label>
                          <input type="text" id="lastNameAz" class="form-control form-control-lg" name="last_name_az" style="font-size:16px;" required value="<?php echo $lastNameAz; ?>"/>
                        </div>
                      </div>
                    </div>
                      <div class="column">
                        <div class="col-md-9 pe-5">
                          <label class="form-label about" for="aboutMeAz">Haqqımda</label>
                          <textarea placeholder="" cols="30" rows="5" id="aboutMeAz" class="form-control form-control-lg" name="about_me_az" style="font-size:16px; resize:none; margin-bottom: 20px;" required><?php echo $bioAz;?></textarea>
                        </div>
                      </div>
                      </div>
                    
                  <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="gender">Gender</label>
                    </div>
                    <div class="row">
                    <div class="col-md-6 mb-3">
                      <div class="form-check form-check-inline" style="margin-right:-1px;">
                        <input type="radio" id="genderFemale" name="gender" value="1" <?php if($gender == '1') { echo 'checked'; } ?>>
                        <label class="form-check-label" for="femaleGender">Female</label>
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <div class="form-check form-check-inline">
                        <input type="radio" id="genderMale" name="gender" value="2" <?php if($gender == '2') { echo 'checked'; } ?>>
                        <label class="form-check-label" for="maleGender">Male</label>
                      </div>
                    </div>

                    </div>
                    </div>

                    <div class="col-md-6 mb-4 pb-2">
                    <div class="col-md-9 pe-5">

                      <div class="form-outline">
                        <label class="form-label" for="date" style="margin-bottom: 20px;">Date of Birth</label>
                        <input type="date" id="birthdate" name="birthdate" required value="<?php echo $birthdate; ?>">
                      </div>

                    </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6 mb-4 pb-2">
                        <div class="form-outline">
                        <label class="form-label <?php echo (!empty($phone_err)) ? 'is-invalid' : ''; ?>" for="phoneNumber">Phone Number</label>
                        <input type="tel" id="phoneNumber" class="form-control form-control-lg" name="phone_number" style="font-size:16px;" required value="<?php echo $phoneNumber; ?>"/>
                        <?php if(!empty($phone_err)) echo "<div style='color:red; margin-bottom:10px; margin-right:140px;'>$phone_err</div>" ?> 
                        </div>

                    </div>

                    <div class="col-md-6 mb-4 pb-2">
                    <div class="form-group">
                      <label for="city" style="margin-bottom: 10px;">City</label>
                      <select id="city" name="city" class="form-control <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>">
                      <option selected disabled>Choose...</option>
                        <option value="Baku" <?php if ($city == 'Baku') echo 'selected'; ?>>Baku</option>
                        <option value="Sumgait" <?php if ($city == 'Sumgait') echo 'selected'; ?>>Sumgait</option>
                        <option value="Ganja" <?php if ($city == 'Ganja') echo 'selected'; ?>>Ganja</option>
                      </select>
                    </div>
                  </div>



                    </div>


                  <div class="mt-4 pt-2">
                    <button class="btn btn-primary btn-save" id="submitButton" type="submit" name="submit">Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>
  <!-- </div> -->
</div>

  <script
  src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.2/axios.min.js" integrity="sha512-NCiXRSV460cHD9ClGDrTbTaw0muWUBf/zB/yLzJavRsPNUl9ODkUVmUHsZtKu17XknhsGlmyVoJxLg/ZQQEeGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../Media/js/settings.js"></script>

</body>
</html>