<?php
// Read user data from data.txt
$userData = file_get_contents('data.txt');
$users = explode("\n", $userData);

// Display user data
foreach ($users as $user) {
    if ($user != '') {
        list($fullName, $email, $phone, $profilePicture, $transcript) = explode(' | ', $user);
        echo "<div>";
        echo "<p><strong>Full Name:</strong> $fullName</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Phone:</strong> $phone</p>";
        echo "<p><strong>Profile Picture:</strong> <img src='$profilePicture' width='100'></p>";
        echo "<p><strong>Transcript:</strong> <a href='$transcript' download>Download Transcript</a></p>";
        echo "</div><hr>";
    }
}
?>
