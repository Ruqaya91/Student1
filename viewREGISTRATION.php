<?php
$dataFile = 'data.txt';

if (file_exists($dataFile)) {
    $data = file_get_contents($dataFile);
    $users = explode("\n", trim($data));

    echo "<h1>Registered Users</h1>";

    foreach ($users as $user) {
        if (!empty($user)) {
            list($fullName, $email, $phone, $profilePicPath, $transcriptPath) = explode(' | ', $user);
            echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px;'>";
            echo "<p><strong>Full Name:</strong> $fullName</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Phone:</strong> $phone</p>";
            echo "<p><strong>Profile Picture:</strong><br><img src='$profilePicPath' alt='Profile Picture' style='width: 100px;'></p>";
            echo "<p><strong>Transcript:</strong> <a href='$transcriptPath' download>Download Transcript</a></p>";
            echo "</div>";
        }
    }
} else {
    echo "<p>No registrations found.</p>";
}
?>
