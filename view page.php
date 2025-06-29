<!-- view_registration.php -->
<?php
$file = 'data.txt';
if (file_exists($file)) {
    $user_data = file_get_contents($file);
    $users = explode("\n", $user_data);

    foreach ($users as $user) {
        if (!empty($user)) {
            $user_details = explode(' | ', $user);

            $fullname = $user_details[0];
            $email = $user_details[1];
            $phone = $user_details[2];
            $profile_picture_path = $user_details[3];
            $transcript_path = $user_details[4];

            echo "<h3>User Information</h3>";
            echo "<strong>Full Name:</strong> $fullname<br>";
            echo "<strong>Email:</strong> $email<br>";
            echo "<strong>Phone:</strong> $phone<br>";
            echo "<strong>Profile Picture:</strong><br><img src='$profile_picture_path' width='100' height='100'><br>";
            echo "<strong>Transcript:</strong><br><a href='$transcript_path' download>Download Transcript</a><br><br>";
        }
    }
} else {
    echo "No user data found.";
}
?>
