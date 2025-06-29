<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>
<body>
    <h1>Registration Form</h1>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
        <label for="full_name">Full Name:</label><br>
        <input type="text" id="full_name" name="full_name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone Number:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="profile_picture">Profile Picture (JPG, PNG):</label><br>
        <input type="file" id="profile_picture" name="profile_picture" accept="image/jpeg, image/png" required><br><br>

        <label for="transcript">Transcript (PDF):</label><br>
        <input type="file" id="transcript" name="transcript" accept="application/pdf" required><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>

<?php
// registration.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Directory setup
    $profileDir = 'uploads/profile_pictures/';
    $transcriptDir = 'uploads/transcripts/';

    // Ensure directories exist
    if (!is_dir($profileDir)) mkdir($profileDir, 0777, true);
    if (!is_dir($transcriptDir)) mkdir($transcriptDir, 0777, true);

    // Input validation
    $fullName = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if (empty($fullName) || empty($email) || empty($phone)) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Handle profile picture upload
    if (!empty($_FILES['profile_picture']['tmp_name']) &&
        in_array($_FILES['profile_picture']['type'], ['image/jpeg', 'image/png'])) {
        $profileExt = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
        $profilePath = $profileDir . 'profile_' . time() . '.' . $profileExt;
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profilePath);
    } else {
        echo "Invalid profile picture format. Only JPG and PNG are allowed.";
        exit;
    }

    // Handle transcript upload
    if (!empty($_FILES['transcript']['tmp_name']) && $_FILES['transcript']['type'] === 'application/pdf') {
        $transcriptPath = $transcriptDir . 'transcript_' . time() . '.pdf';
        move_uploaded_file($_FILES['transcript']['tmp_name'], $transcriptPath);
    } else {
        echo "Invalid transcript format. Only PDF is allowed.";
        exit;
    }

    // Append data to text file
    $userData = "$fullName | $email | $phone | $profilePath | $transcriptPath" . PHP_EOL;
    file_put_contents('data.txt', $userData, FILE_APPEND);

    echo "Registration successful!";
}
?>

