<?php
$dataFile = 'data.txt';
$registrations = file_exists($dataFile) ? file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .registration-card {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            margin: 15px 0;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .registration-card p {
            margin: 10px 0;
        }

        .registration-card img {
            border-radius: 50%;
            max-width: 80px;
            height: auto;
        }

        .download-link {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .download-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Registered Users</h1>
    <?php if (!empty($registrations)): ?>
        <?php foreach ($registrations as $registration): ?>
            <?php 
                list($fullName, $email, $phone, $profilePath, $transcriptPath) = explode(' | ', $registration);
            ?>
            <div class="registration-card">
                <p><strong>Full Name:</strong> <?= htmlspecialchars($fullName) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($phone) ?></p>
                <p><strong>Profile Picture:</strong><br>
                    <img src="<?= htmlspecialchars($profilePath) ?>" alt="Profile Picture">
                </p>
                <p><strong>Transcript:</strong> 
                    <a href="download.php?file=<?= urlencode(trim($transcriptPath)) ?>" class="download-link">Download Transcript</a>
                </p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No registrations found.</p>
    <?php endif; ?>
</body>
</html>
