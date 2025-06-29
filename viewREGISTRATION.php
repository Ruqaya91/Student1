<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Students - FIU</title>
    <link rel="stylesheet" href="template.css">
</head>
<body>
    <div class="container">
        <h1>Registered Students</h1>
        <a href="index.php">Back to Registration</a>
        
        <?php
        $file = __DIR__ . "/data.txt";
        if (file_exists($file)) {
            $entries = file($file, FILE_IGNORE_NEW_LINES);
            if (count($entries) > 0) {
                echo "<ul>";
                foreach ($entries as $entry) {
                    list($fullName, $email, $phone, $profilePicPath, $transcriptPath) = explode(" | ", $entry);
                    echo "<li class='student'>
                            <strong>Name:</strong> $fullName <br>
                            <strong>Email:</strong> $email <br>
                            <strong>Phone:</strong> $phone <br>
                            <strong>Profile Picture:</strong> <br> 
                            <img src='$profilePicPath' alt='Profile Picture' width='100'> <br>
                            <strong>Transcript:</strong> <a href='$transcriptPath' download>Download Transcript</a>
                          </li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No registered students yet.</p>";
            }
        } else {
            echo "<p>No data found.</p>";
        }
        ?>
    </div>
</body>
</html>
