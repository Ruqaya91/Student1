<?php
$data_file = "data.txt";

if (!file_exists($data_file) || filesize($data_file) == 0) {
    die("No registrations found.");
}

$users = file_get_contents($data_file);
$users = explode("\n", trim($users));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
</head>
<body>
    <h2>Registered Users</h2>
    <?php foreach ($users as $user): ?>
        <?php 
        $details = explode(" | ", $user);
        if (count($details) < 5) continue;
        list($name, $email, $phone, $profile, $transcript) = $details;
        ?>
        <div>
            <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
            <p><strong>Phone:</strong> <?= htmlspecialchars($phone) ?></p>
            <p><strong>Profile Picture:</strong><br> <img src="<?= htmlspecialchars($profile) ?>" width="100" alt="Profile Picture"></p>
            <p><a href="<?= htmlspecialchars($transcript) ?>" download>Download Transcript</a></p>
            <hr>
        </div>
    <?php endforeach; ?>
</body>
</html>
