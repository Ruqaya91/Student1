<?php
// view_registration.php
$dataFile = 'data.txt';

if (file_exists($dataFile)) {
    $registrations = file_get_contents($dataFile);
    $lines = explode(PHP_EOL, trim($registrations));

    echo "<h1>Registered Users</h1>";

    foreach ($lines as $line) {
        list($name, $email, $phone, $profilePath, $transcriptPath) = explode(' | ', $line);

        echo "<div>";
        echo "<p><strong>Full Name:</strong> $name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Phone:</strong> $phone</p>";
        echo "<p><strong>Profile Picture:</strong><br><img src='$profilePath' alt='Profile Picture' width='100'></p>";
        echo "<p><strong>Transcript:</strong><br><a href='$transcriptPath' download>Download Transcript</a></p>";
        echo "</div><hr>";
    }
} else {
    echo "No registrations found.";
}
?>
