<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    $profileDir = __DIR__ . "/uploads/profile_pictures/";
    $transcriptDir = __DIR__ . "/uploads/transcripts/";

    // Validate form fields
    if (empty($fullName) || empty($email) || empty($phone) || empty($_FILES['profile_pic']['name']) || empty($_FILES['transcript']['name'])) {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } else {
        // Ensure the directories exist
        if (!is_dir($profileDir)) {
            mkdir($profileDir, 0777, true);
        }
        if (!is_dir($transcriptDir)) {
            mkdir($transcriptDir, 0777, true);
        }

        // Profile Picture Upload
        $profileExt = pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);
        $profilePicPath = "uploads/profile_pictures/profile_" . time() . ".$profileExt";

        // Transcript Upload
        $transcriptExt = pathinfo($_FILES["transcript"]["name"], PATHINFO_EXTENSION);
        $transcriptPath = "uploads/transcripts/transcript_" . time() . ".$transcriptExt";

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], __DIR__ . "/" . $profilePicPath) &&
            move_uploaded_file($_FILES["transcript"]["tmp_name"], __DIR__ . "/" . $transcriptPath)) {
            
            // user data to data.txt
            $entry = "$fullName | $email | $phone | $profilePicPath | $transcriptPath" . PHP_EOL;
            file_put_contents(__DIR__ . "/data.txt", $entry, FILE_APPEND);

            $success = "Registration successful!";
        } else {
            $error = "File upload failed!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIU Student Registration</title>
    <link rel="stylesheet" href="template.css">
</head>
<body>
    <div class="container">
        <h1>Florida International University Student Registration</h1>
        
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if (isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" id="full_name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" required>

            <label for="profile_pic">Profile Picture (JPG/PNG only):</label>
            <input type="file" name="profile_pic" id="profile_pic" accept=".jpg, .png" required>

            <label for="transcript">Transcript (PDF only):</label>
            <input type="file" name="transcript" id="transcript" accept=".pdf" required>

            <button type="submit">Register</button>
        </form>

        <br>
        <a href="view_registration.php">View Registered Students</a>
    </div>
</body>
</html>
