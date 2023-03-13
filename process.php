<?php

// Validate form inputs
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_FILES['profile_picture'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profile_picture = $_FILES['profile_picture'];

    // Ensure all fields are filled out
    if(!empty($name) && !empty($email) && !empty($password) && !empty($profile_picture)) {
        // Ensure email is in valid format
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Create unique filename for profile picture
            $filename = uniqid() . '_' . $profile_picture['name'];
            // Save profile picture to server
            move_uploaded_file($profile_picture['tmp_name'], 'uploads/' . $filename);
            // Add current date and time to filename
            $filename_with_date = date('Y-m-d_H-i-s') . '_' . $filename;
            rename('uploads/' . $filename, 'uploads/' . $filename_with_date);
            // Save user's name, email, and profile picture filename to CSV file
            $data = array($name, $email, $filename_with_date);
            $fp = fopen('users.csv', 'a');
            fputcsv($fp, $data);
            fclose($fp);
            // Start new session and set cookie with user's name
            session_start();
            $_SESSION['name'] = $name;
            setcookie('name', $name, time() + (86400 * 30), '/');
            // Redirect to success page
            header('Location: success.php');
            exit();
        } else {
            echo 'Invalid email format';
        }
    } else {
        echo 'All fields are required';
    }
} else {
    echo 'Form not submitted';
}

?>


