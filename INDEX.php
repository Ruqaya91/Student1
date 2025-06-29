<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Form handling logic here
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    
    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    } else {
        // Handle file uploads
        $profilePicture = $_FILES['profile_picture'];
        $transcript = $_FILES['transcript'];

        // Validate files
        if ($profilePicture['type'] != 'image/jpeg' && $profilePicture['type'] != 'image/png') {
            echo "Profile picture must be a .jpg or .png file";
        } elseif ($transcript['type'] != 'application/pdf') {
            echo "Transcript must be a .pdf file";
        } else {
            // Rename files with timestamp for uniqueness
            $profilePictureName = 'profile_' . time() . '.' . pathinfo($profilePicture['name'], PATHINFO_EXTENSION);
            $transcriptName = 'transcript_' . time() . '.pdf';
            
            // Define upload directories
            $profilePicturePath = 'uploads/profile_pictures/' . $profilePictureName;
            $transcriptPath = 'uploads/transcripts/' . $transcriptName;

            // Move the uploaded files
            move_uploaded_file($profilePicture['tmp_name'], $profilePicturePath);
            move_uploaded_file($transcript['tmp_name'], $transcriptPath);

            // Prepare data for saving
            $userData = $fullName . ' | ' . $email . ' | ' . $phone . ' | ' . $profilePicturePath . ' | ' . $transcriptPath . "\n";

            // Save user data to data.txt
            file_put_contents('data.txt', $userData, FILE_APPEND);
            echo "Registration successful!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <h1>Register for School Admission</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" required><br><br>
        
        <label for="profile_picture">Profile Picture:</label>
        <input type="file" id="profile_picture" name="profile_picture" accept=".jpg, .png" required><br><br>
        
        <label for="transcript">Transcript:</label>
        <input type="file" id="transcript" name="transcript" accept=".pdf" required><br><br>
        
        <button type="submit">Submit</button>
    </form>
</body>
</html>
