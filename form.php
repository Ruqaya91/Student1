<?php
// Check if the form is submitted using $_SERVER['REQUEST_METHOD']
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and validate the form data
    $full_name = ($_POST['full_name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = ($_POST['phone']);
    $profile_picture = $_FILES['profile_picture'];
    $transcripts = $_FILES['transcripts'];

    // Variable for folder name
    $dir = 'uploads/';

    // Check data entered 
    if ($full_name && $email && $phone && $profile_picture && $transcripts) {
        // Set variables for profile_pictures and transcripts folders
        $profile_dir = $dir . 'profile_pictures/';
        $transcript_dir = $dir . 'transcripts/';

        // Check and create profile_picture and transcript folders if they don'texist
        if (!is_dir($profile_dir)) {
            mkdir($profile_dir, 0755, true);  
        }

        if (!is_dir($transcript_dir)) {
            mkdir($transcript_dir, 0755, true);  
        }

        // Check if jpg or png. Rename profile_pic file to include timestamp
        $profile_picture_extension = strtolower(pathinfo($profile_picture['name'], PATHINFO_EXTENSION));
        if ($profile_picture_extension == 'jpg' || $profile_picture_extension == 'png') {
            $profile_picture_name = 'profile_' . time() . '.' . $profile_picture_extension;
        } else {
            echo "<p>Please submit a .jpg or .png file.</p>";
            exit;
        }
        $profile_picture_path = $profile_dir . $profile_picture_name;

        // Rename transcript file to include timestamp
        $transcript_name = 'transcript_' . time() . '.pdf';
        $transcript_path = $transcript_dir . $transcript_name;

        // Save the uploaded files 
        if (file_put_contents($profile_picture_path, file_get_contents($profile_picture['tmp_name'])) &&
            file_put_contents($transcript_path, file_get_contents($transcripts['tmp_name']))) {
            // Append student info to data.txt
            $student_data = "$full_name | $email | $phone | $profile_picture_path | $transcript_path\n";
            file_put_contents('data.txt', $student_data);  

            // View submitted registration data 
            header('Location: view_registration.php');
            exit;
        } else {
            echo "<p>The files could not be uploaded.</p>";
        }
    } else {
        echo "<p>Please make sure all fields have been completed.</p>";
    }
}

?>
