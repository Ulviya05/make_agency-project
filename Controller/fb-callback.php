<?php
session_start();

include_once '../Config/database.php';
include_once '../Config/fb-api.php';

try {
    $accessToken = $helper->getAccessToken();
    $helper->getPersistentDataHandler()->set('state', $_SESSION['state']); // Set the state parameter

    if (isset($accessToken)) {
        // Logged in successfully with Facebook
        $FB->setDefaultAccessToken($accessToken);
        $response = $FB->get('/me?fields=id,first_name,last_name,email');
        $userData = $response->getGraphNode()->asArray();

        $email = $userData['email'];
        $firstName = $userData['first_name'];
        $lastName = $userData['last_name'];

        // Check if the user is already registered
        // Perform your database query or checks here to determine if the user is already registered
        // Assuming you have a database connection in $conn variable

        // Example query to check if email exists in your users table
        $stmt = $conn->prepare("SELECT * FROM mydb.users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // User is already registered, log them in
            $_SESSION['loggedin'] = true;
            $stmt = $conn->prepare("SELECT user_id FROM mydb.users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($userId);
            $stmt->fetch();
            $_SESSION['user_id'] = $userId;
            // Set other session variables or perform any other actions for logged in user
            header("Location: ../View/dashboard.php?error=hi");
            exit();
        } else {
            // User is not registered, register them
            // Perform your user registration process here
            // Insert the user data into your database or perform any other necessary actions

            // Example query to insert user into your users table
            $stmt = $conn->prepare("INSERT INTO mydb.users (email, name, last_name) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $firstName, $lastName);
            $stmt->execute();

            $stmt = $conn->prepare("SELECT user_id FROM mydb.users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($userId);
            $stmt->fetch();

            // Set session variables or perform any other actions for registered user
            $_SESSION['user_id'] = $userId;
            $_SESSION['loggedin'] = true;
            // Set other session variables or perform any other actions for logged in user
            header("Location: ../View/dashboard.php?error=hey");
            exit();
        }
    } else {
        // Facebook login unsuccessful
        // Handle the error or redirect to an error page
        echo "Facebook login failed.";
    }
} catch (\Facebook\Exceptions\FacebookResponseException $e) {
    // Facebook API error occurred
    // Handle the error or redirect to an error page
    echo "Facebook API error: " . $e->getMessage();
} catch (\Facebook\Exceptions\FacebookSDKException $e) {
    // Facebook SDK error occurred
    // Handle the error or redirect to an error page
    echo "Facebook SDK error: " . $e->getMessage();
}
?>

