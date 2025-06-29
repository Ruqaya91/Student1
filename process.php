    <?php
   

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $full_name = trim($_POST['full_name']);
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $phone = trim($_POST['phone']);

        $upload_dir = 'uploads/';
        $profile_dir = $upload_dir . 'profile_pictures/';
        $transcript_dir = $upload_dir . 'transcripts/';
        
        if (!is_dir($profile_dir)) mkdir($profile_dir, 0777, true);
        if (!is_dir($transcript_dir)) mkdir($transcript_dir, 0777, true);
        
        $profile_pic = $_FILES['profile_picture'];
        $transcript = $_FILES['transcript'];
        
        $profile_ext = pathinfo($profile_pic['name'], PATHINFO_EXTENSION);
        $transcript_ext = pathinfo($transcript['name'], PATHINFO_EXTENSION);
        
        $profile_path = $profile_dir . 'profile_' . time() . '.' . $profile_ext;
        $transcript_path = $transcript_dir . 'transcript_' . time() . '.' . $transcript_ext;
        
        if (move_uploaded_file($profile_pic['tmp_name'], $profile_path) && move_uploaded_file($transcript['tmp_name'], $transcript_path)) {
            $data = "$full_name | $email | $phone | $profile_path | $transcript_path\n";
            file_put_contents('data.txt', $data, FILE_APPEND);
            echo "Registration successful. <a href='view_registration.php'>View Registrations</a>";
        } else {
            echo "File upload failed.";
        }
    }
    ?>
