<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Registration</title>
</head>
<body>
    <h1>Registered Users</h1>
    <?php
    $dataFile = "data.txt";

    if (file_exists($dataFile)) {
        $data = file_get_contents($dataFile);
        $lines = explode("\n", trim($data));

        foreach ($lines as $line) {
            list($full_name, $email, $phone, $profilePath, $transcriptPath) = explode(" | ", $line);

            echo "<div style='border: 1px solid #000; margin-bottom: 10px; padding: 10px;'>";
            echo "<p><strong>Full Name:</strong> $full_name</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Phone Number:</strong> $phone</p>";
            echo "<p><strong>Profile Picture:</strong></p>";
            echo "<img src='$profilePath' alt='Profile Picture' style='max-width: 100px;'><br>";
            echo "<p><strong>Transcript:</strong> <a href='$transcriptPath' download>Download</a></p>";
            echo "</div>";
        }
    } else {
        echo "<p>No registrations found.</p>";
    }
    ?>
</body>
</html>


