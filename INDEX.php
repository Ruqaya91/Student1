<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $required_fields = ['full_name', 'email', 'phone_number', 'profile_picture', 'transcripts'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field]) && !isset($_FILES[$field])) {
            echo "All fields are required.";
            exit;
        }
    }

    
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    
    function handleFileUpload($file, $allowed_extensions, $directory, $prefix) {
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        if (!in_array($extension, $allowed_extensions)) {
            echo "Invalid file type for " . $file['name'];
            exit;
        }
        $filename = $prefix . '_' . time() . '.' . $extension;
        $path = $directory . '/' . $filename;
        move_uploaded_file($file['tmp_name'], $path);
        return $path;
    }

    
    $profile_picture_path = handleFileUpload($_FILES['profile_picture'], ['jpg', 'png'], 'uploads/profile_pictures', 'profile');
    $transcript_path = handleFileUpload($_FILES['transcripts'], ['pdf'], 'uploads/transcripts', 'transcript');

    
    $user_data = htmlspecialchars($_POST['full_name']) . ' | ' . htmlspecialchars($_POST['email']) . ' | ' . htmlspecialchars($_POST['phone_number']) . ' | ' . $profile_picture_path . ' | ' . $transcript_path . "\n";

    
    file_put_contents('data.txt', $user_data, FILE_APPEND);

    echo "You have been Succefully Registred! <a href='view_registration.php'>View all registrations</a>";
}
?>
