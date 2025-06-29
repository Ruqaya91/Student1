<?php
// Registration Form (index.php)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    
    $errors = [];

    // Validate inputs
    if (empty($fullName) || empty($email) || empty($phone)) {
        $errors[] = "All fields are required.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // File upload handling
    $profilePicDir = 'uploads/profile_pictures/';
    $transcriptDir = 'uploads/transcripts/';

    if (!file_exists($profilePicDir)) {
        mkdir($profilePicDir, 0777, true);
    }

    if (!file_exists($transcriptDir)) {
        mkdir($transcriptDir, 0777, true);
    }

    function validateFileType($file, $allowedTypes) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        return in_array($ext, $allowedTypes);
    }

    $profilePicPath = '';
    $transcriptPath = '';

    if ($_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        if (!validateFileType($_FILES['profile_picture'], ['jpg', 'png'])) {
            $errors[] = "Profile picture must be a .jpg or .png file.";
        } else {
            $profilePicPath = $profilePicDir . 'profile_' . time() . '.' . pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePicPath);
        }
    } else {
        $errors[] = "Error uploading profile picture.";
    }

    if ($_FILES['transcript']['error'] === UPLOAD_ERR_OK) {
        if (!validateFileType($_FILES['transcript'], ['pdf'])) {
            $errors[] = "Transcript must be a .pdf file.";
        } else {
            $transcriptPath = $transcriptDir . 'transcript_' . time() . '.' . pathinfo($_FILES['transcript']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['transcript']['tmp_name'], $transcriptPath);
        }
    } else {
        $errors[] = "Error uploading transcript.";
    }

    // Save user details to data.txt
    if (empty($errors)) {
        $userDetails = "$fullName | $email | $phone | $profilePicPath | $transcriptPath\n";
        file_put_contents('data.txt', $userDetails, FILE_APPEND);
        echo "<p>Registration successful!</p>";
    } else {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Admission Registration</title>
</head>
<body>
    <h1>School Admission Registration</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="profile_picture">Profile Picture (.jpg, .png):</label>
        <input type="file" id="profile_picture" name="profile_picture" accept=".jpg,.png" required><br><br>

        <label for="transcript">Transcript (.pdf):</label>
        <input type="file" id="transcript" name="transcript" accept=".pdf" required><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>


<?php
