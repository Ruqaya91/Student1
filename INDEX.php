<?php
// Define directories for uploads
$profileDir = "uploads/profile_pictures/";
$transcriptDir = "uploads/transcripts/";
$dataFile = "data.txt";

// Create directories if not exist
if (!is_dir($profileDir)) {
    mkdir($profileDir, 0777, true);
}
if (!is_dir($transcriptDir)) {
    mkdir($transcriptDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $profilePic = $_FILES['profile_picture'];
    $transcript = $_FILES['transcript'];

    // Validate form inputs
    if (empty($fullName) || empty($email) || empty($phone) || empty($profilePic) || empty($transcript)) {
        echo "All fields are required.";
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Handle Profile Picture Upload
    $profileExt = pathinfo($profilePic['name'], PATHINFO_EXTENSION);
    $profileFileName = "profile_" . time() . ".$profileExt";
    $profilePath = $profileDir . $profileFileName;
    if (!move_uploaded_file($profilePic['tmp_name'], $profilePath)) {
        echo "Error uploading profile picture.";
        exit;
    }

    // Handle Transcript Upload
    $transcriptExt = pathinfo($transcript['name'], PATHINFO_EXTENSION);
    $transcriptFileName = "transcript_" . time() . ".$transcriptExt";
    $transcriptPath = $transcriptDir . $transcriptFileName;
    if (!move_uploaded_file($transcript['tmp_name'], $transcriptPath)) {
        echo "Error uploading transcript.";
        exit;
    }

    // Save user data to text file
    $entry = "$fullName | $email | $phone | $profilePath | $transcriptPath" . PHP_EOL;
    file_put_contents($dataFile, $entry, FILE_APPEND);
    echo "Registration successful.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(45deg, #210B2C, #55286F, #BC96E6, #D8B4E2, #AE759F);
            color: #ffffff;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }

        h2 {
            color: #ffffff;
            text-align: center;
            text-shadow: 1px 1px 2px #000000;
        }

        form {
            max-width: 500px;
            margin: 2em auto;
            padding: 2em;
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: .5em;
            color: #55286F;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"],
        input[type="submit"] {
            width: 100%;
            padding: .5em;
            margin-bottom: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #55286F;
            color: #ffffff;
            border: none;
            cursor: pointer;
            font-size: 1em;
        }

        input[type="submit"]:hover {
            background-color: #210B2C;
        }

        a {
            color: #f5f1f1;
            text-decoration: none;
            text-align: center;
            display: block;
            margin-top: 1em;
        }

        a:hover {
            color: #BC96E6;
        }

    </style>
</head>
<body>
<h2>Registration Form</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <label>Full Name:</label>
    <input type="text" name="full_name" required><br><br>
    <label>Email:</label>
    <input type="email" name="email" required><br><br>
    <label>Phone Number:</label>
    <input type="text" name="phone" required><br><br>
    <label>Profile Picture (JPG/PNG):</label>
    <input type="file" name="profile_picture" accept="image/jpg, image/png" required><br><br>
    <label>Transcripts (PDF):</label>
    <input type="file" name="transcript" accept="application/pdf" required><br><br>
    <input type="submit" value="Register">
</form>
<br>
<a href="view_registration.php">View Registrations</a>
</body>
</html>
