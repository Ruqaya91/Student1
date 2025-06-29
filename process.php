<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<div class='error'>Invalid email format. <a href='index.php'>Go Back</a></div>");
    }

    // Ensure upload directories exist
    $profileDir = "uploads/profile_pictures/";
    $transcriptDir = "uploads/transcripts/";

    if (!is_dir($profileDir)) {
        mkdir($profileDir, 0777, true);
    }
    if (!is_dir($transcriptDir)) {
        mkdir($transcriptDir, 0777, true);
    }

    // Handle file uploads
    $profileExt = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
    $transcriptExt = pathinfo($_FILES['transcript']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($profileExt), ['jpg', 'png']) || strtolower($transcriptExt) !== 'pdf') {
        die("<div class='error'>Invalid file type. Profile must be JPG/PNG and transcript must be PDF. 
             <a href='index.php'>Go Back</a></div>");
    }

    // Rename files with timestamp
    $profileName = "profile_" . time() . "." . $profileExt;
    $transcriptName = "transcript_" . time() . ".pdf";

    $profilePath = $profileDir . $profileName;
    $transcriptPath = $transcriptDir . $transcriptName;

    move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePath);
    move_uploaded_file($_FILES['transcript']['tmp_name'], $transcriptPath);

    // Save data to a text file
    $dataFile = 'data.txt';
    $entry = "$fullName | $email | $phone | $profilePath | $transcriptPath\n";
    file_put_contents($dataFile, $entry, FILE_APPEND);

    echo "<div class='success'>
            Registration successful! 
            <br><br>
            <a href='view_registration.php'>View Registrations</a>
          </div>";
} else {
    header("Location: index.php");
    exit;
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        text-align: center;
        margin: 50px;
    }
    .success {
        background: #d4edda;
        color: #155724;
        padding: 20px;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        display: inline-block;
    }
    .error {
        background: #f8d7da;
        color: #721c24;
        padding: 20px;
        border: 1px solid #f5c6cb;
        border-radius: 5px;
        display: inline-block;
    }
    a {
        text-decoration: none;
        color: #007bff;
        font-weight: bold;
    }
    a:hover {
        text-decoration: underline;
    }
</style>
