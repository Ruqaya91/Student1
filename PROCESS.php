<!-- registration_process.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and validate form data
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if (empty($fullname) || empty($email) || empty($phone)) {
        echo "All fields are required!";
        exit;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Handle file uploads
    $uploads_dir = __DIR__ . '/uploads/';
    $profile_picture_dir = $uploads_dir . 'profile_pictures/';
    $transcripts_dir = $uploads_dir . 'transcripts/';
    
    // Create directories if not exist
    if (!file_exists($profile_picture_dir)) {
        mkdir($profile_picture_dir, 0777, true);
    }
    if (!file_exists($transcripts_dir)) {
        mkdir($transcripts_dir, 0777, true);
    }

    // Handle Profile Picture
    $profile_picture = $_FILES['profile_picture'];
    $profile_picture_name = time() . "_" . basename($profile_picture['name']);
    $profile_picture_path = $profile_picture_dir . $profile_picture_name;

    if (!move_uploaded_file($profile_picture['tmp_name'], $profile_picture_path)) {
        echo "Error uploading profile picture.";
        exit;
    }

    // Handle Transcripts
    $transcripts = $_FILES['transcripts'];
    $transcript_name = time() . "_" . basename($transcripts['name']);
    $transcript_path = $transcripts_dir . $transcript_name;

    if (!move_uploaded_file($transcripts['tmp_name'], $transcript_path)) {
        echo "Error uploading transcripts.";
        exit;
    }

    // Save user data to text file
    $user_data = "$fullname | $email | $phone | $profile_picture_path | $transcript_path\n";
    file_put_contents('data.txt', $user_data, FILE_APPEND);

    echo "Registration successful!";
}
?>
