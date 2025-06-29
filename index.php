<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Registration</title>
</head>
<body>
    <h2>School Admission Registration</h2>
    <form action="register.php" method="POST" enctype="multipart/form-data">
        <label>Full Name:</label>
        <input type="text" name="full_name" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Phone Number:</label>
        <input type="text" name="phone_number" required><br><br>

        <label>Profile Picture (JPG/PNG):</label>
        <input type="file" name="profile_picture" accept=".jpg, .png" required><br><br>

        <label>Transcript (PDF):</label>
        <input type="file" name="transcript" accept=".pdf" required><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
