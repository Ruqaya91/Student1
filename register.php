<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $phone_number = trim($_POST["phone_number"]);
    
   
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    $profile_dir = "uploads/profile_pictures/";
    $transcript_dir = "uploads/transcripts/";

    if (!file_exists($profile_dir)) mkdir($profile_dir, 0777, true);
    if (!file_exists($transcript_dir)) mkdir($transcript_dir, 0777, true);

    $profile_ext = pathinfo($_FILES["profile_picture"]["name"], PATHINFO_EXTENSION);
    if (!in_array(strtolower($profile_ext), ["jpg", "png"])) {
        die("Only JPG and PNG files are allowed for profile pictures.");
    }
    $profile_path = $profile_dir . "profile_" . time() . "." . $profile_ext;
    move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $profile_path);
 
    $transcript_ext = pathinfo($_FILES["transcript"]["name"], PATHINFO_EXTENSION);
    if ($transcript_ext !== "pdf") {
        die("Only PDF files are allowed for transcripts.");
    }
    $transcript_path = $transcript_dir . "transcript_" . time() . "." . $transcript_ext;
    move_uploaded_file($_FILES["transcript"]["tmp_name"], $transcript_path);

    $user_data = "$full_name | $email | $phone_number | $profile_path | $transcript_path\n";
    file_put_contents("data.txt", $user_data, FILE_APPEND);

    echo "Registration successful. <a href='view_registration.php'>View Registrations</a>";
}
?>
