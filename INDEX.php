<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <h1>Registration</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        <label for="full_name">Full Name:</label><br>
        <input type="text" id="full_name" name="full_name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone Number:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="profile_picture">Profile Picture (.jpg, .png):</label><br>
        <input type="file" id="profile_picture" name="profile_picture" accept=".jpg, .png" required><br><br>

        <label for="transcript">Transcript (.pdf):</label><br>
        <input type="file" id="transcript" name="transcript" accept=".pdf" required><br><br>

        <button type="submit" name="submit">Register</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $full_name = htmlspecialchars($_POST['full_name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p>Invalid email format!</p>";
            exit();
        }
 
        $profileDir = "uploads/profile_pictures/";
        $transcriptDir = "uploads/transcripts/";

        if (!is_dir($profileDir)) mkdir($profileDir, 0777, true);
        if (!is_dir($transcriptDir)) mkdir($transcriptDir, 0777, true);

        $profileTmp = $_FILES['profile_picture']['tmp_name'];
        $profileExt = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
        $profileName = "profile_" . time() . "." . $profileExt;
        $profilePath = $profileDir . $profileName;
        move_uploaded_file($profileTmp, $profilePath);

        $transcriptTmp = $_FILES['transcript']['tmp_name'];
        $transcriptExt = pathinfo($_FILES['transcript']['name'], PATHINFO_EXTENSION);
        $transcriptName = "transcript_" . time() . "." . $transcriptExt;
        $transcriptPath = $transcriptDir . $transcriptName;
        move_uploaded_file($transcriptTmp, $transcriptPath);

        $data = "$full_name | $email | $phone | $profilePath | $transcriptPath\n";
        file_put_contents("data.txt", $data, FILE_APPEND);

        echo "<p>Registration successful!</p>";
    }
    ?>
</body>
</html>
