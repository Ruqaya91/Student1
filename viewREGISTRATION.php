<?php
$dataFile = "data.txt";

if (!file_exists($dataFile)) {
    die("No registrations found.");
}

$entries = file($dataFile, FILE_IGNORE_NEW_LINES);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(45deg, #210B2C, #55286F, #BC96E6, #D8B4E2, #AE759F);
            color: #ffffff;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding-top: 50px; /* Small adjustment to position content better */
        }

        h2 {
            color: #ffffff;
            text-align: center;
            text-shadow: 1px 1px 2px #000000;
        }

        .user-container {
            max-width: 600px;
            margin: 2em auto;
            padding: 1em;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .user {
            margin-bottom: 1.5em;
        }

        p {
            color: #000000;
        }

        img {
            display: block;
            margin: 0 auto;
        }

        hr {
            border: 0;
            border-top: 1px solid #e0e0e0;
            margin: 1em 0;
        }

        a {
            color: #ffffff;
            text-decoration: none;
            text-align: center;
            display: block;
            margin-top: 1em;
        }

        a:hover {
            color: #BC96E6;
        }
    </style>
</head>
<body>
<h2>Registered Users</h2>
<?php foreach ($entries as $entry):
    list($fullName, $email, $phone, $profilePath, $transcriptPath) = explode(" | ", $entry);
    ?>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($fullName); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
    <p><strong>Phone:</strong> <?php echo htmlspecialchars($phone); ?></p>
    <p><strong>Profile Picture:</strong> <br><br>
        <img src="<?php echo htmlspecialchars($profilePath); ?>" width="100">
    </p>
    <p><strong>Transcript:</strong> <a href="<?php echo htmlspecialchars($transcriptPath); ?>" download>Download</a></p>
    <hr>
<?php endforeach; ?>
</body>
</html>
