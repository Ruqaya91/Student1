<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Admission Registration</title>

        <style>


        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; 
            margin: 0; 
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .form-container {
            background-color: #fff; 
            padding: 20px;
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            width: 300px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"] {
            width: 50%; 
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            width: 20%;
            padding: 10px;
            background-color: blue; 
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: darkblue;
        }
    </style>

</head>

<body>
    <center>
    <h1>School Admission Registration Page 🔐</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

        <label for="fullname">📝 Full Name:</label> 
        <input type="text" id="fullname" name="fullname" required><br><br>

        <label for="email">📩 Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone"> 📞 Phone Number:</label>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="profile_picture">📷 Profile Picture (JPG/PNG only):</label>
        <input type="file" id="profile_picture" name="profile_picture" accept=".jpg,.png" required><br><br>

        <label for="transcript">📜 Transcript (PDF only):</label>
        <input type="file" id="transcript" name="transcript" accept=".pdf" required><br><br>

        <button type="submit" name="submit">Register</button>

    </form>
    </center>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validate form data
        $fullname = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);

        if (empty($fullname) || empty($email) || empty($phone)) {
            echo "<p style='color: red;'>All fields are required.</p>";
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p style='color: red;'>Invalid email format.</p>";
            exit;
        }

        // Handle file uploads
        $profile_picture = $_FILES['profile_picture'];
        $transcript = $_FILES['transcript'];

        // Validate file types
        $allowed_profile_types = ['image/jpeg', 'image/png'];
        $allowed_transcript_types = ['application/pdf'];

        if (!in_array($profile_picture['type'], $allowed_profile_types)) {
            echo "<p style='color: red;'>Profile picture must be a JPG or PNG file.</p>";
            exit;
        }

        if (!in_array($transcript['type'], $allowed_transcript_types)) {
            echo "<p style='color: red;'>Transcript must be a PDF file.</p>";
            exit;
        }

        // Rename files with a timestamp
        $profile_picture_name = 'profile_' . time() . '.' . pathinfo($profile_picture['name'], PATHINFO_EXTENSION);
        $transcript_name = 'transcript_' . time() . '.' . pathinfo($transcript['name'], PATHINFO_EXTENSION);

        // Save files to uploads directory
        move_uploaded_file($profile_picture['tmp_name'], 'uploads/profile_pictures/' . $profile_picture_name);
        move_uploaded_file($transcript['tmp_name'], 'uploads/transcripts/' . $transcript_name);

        // Store user details in data.txt
        $user_data = "$fullname | $email | $phone | uploads/profile_pictures/$profile_picture_name | uploads/transcripts/$transcript_name" . PHP_EOL;
        file_put_contents('data.txt', $user_data, FILE_APPEND);

        // Redirect to the viewing page
        header('Location: view_registration.php');
        exit; 
    }
    ?>
    
</body>
</html>
