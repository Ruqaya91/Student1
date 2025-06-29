<?php
// Ensure the uploads directory exists
if (!is_dir('uploads/profile_pictures')) {
    mkdir('uploads/profile_pictures', 0777, true);
}
if (!is_dir('uploads/transcripts')) {
    mkdir('uploads/transcripts', 0777, true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Admission Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        label {
            display: block;
            text-align: left;
            font-weight: bold;
            margin-top: 10px;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            margin-top: 15px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
        }
        input[type="submit"]:hover {
            background: #218838;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>School Admission Registration</h2>
        <form action="process_registration.php" method="POST" enctype="multipart/form-data">
            <label>Full Name:</label>
            <input type="text" name="full_name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Phone Number:</label>
            <input type="text" name="phone" required>

            <label>Profile Picture (JPG/PNG only):</label>
            <input type="file" name="profile_picture" accept=".jpg, .png" required>

            <label>Transcript (PDF only):</label>
            <input type="file" name="transcript" accept=".pdf" required>

            <input type="submit" value="Register">
        </form>
    </div>

</body>
</html>
