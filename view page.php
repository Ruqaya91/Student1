<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Registrations</title>

</head>

<body>

    <h1>Registered Users 👥</h1>
    <a href="index.php">Back to Registration Page ⬅</a><br><br>

    <?php
    if (file_exists('data.txt')) {
        $user_data = file_get_contents('data.txt');
        $users = explode(PHP_EOL, trim($user_data));

        foreach ($users as $user) {
            list($fullname, $email, $phone, $profile_picture, $transcript) = explode(' | ', $user);

            echo "<div style='border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;'>";
            echo "<p><strong>Full Name:</strong> $fullname</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Phone Number:</strong> $phone</p>";
            echo "<p><strong>Profile Picture:</strong><br><img src='$profile_picture' width='100'></p>";
            echo "<p><strong>Transcript:</strong> <a href='$transcript' download>Download Transcript</a></p>";
            echo "</div>";
        }
    } else {
        echo "<p>No registrations found.</p>";
    }
    ?>
    
</body>
</html>
