<?php
$data = file_get_contents('data.txt');
if (!$data) {
    echo "No registration data available.";
    exit;
}

echo "<h2>Registered Users</h2>";
foreach (explode("\n", $data) as $line) {
    if (!$line) continue;


    list($full_name, $email, $phone_number, $profile_picture_path, $transcript_path) = explode(' | ', $line);

    echo "<div>";
    echo "<h3>$full_name</h3>";
    echo "<p><strong>Email:</strong> $email</p>";
    echo "<p><strong>Phone:</strong> $phone_number</p>";
    echo "<p><strong>Profile Picture:</strong> <img src='$profile_picture_path' width='100'></p>";
    echo "<p><strong>Transcript:</strong> <a href='$transcript_path' download>Download Transcript</a></p>";
    echo "</div><hr>";
}
?>
