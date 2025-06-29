<!DOCTYPE html>
<html>

    <head>
        <title> school.php </title>
    </head>

    <body>
        <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') 
            {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $PhoneNumber = $_POST['PhoneNumber'];
            
                $profilePicture = $_FILES['profilePicture'];
                $transcripts = $_FILES['transcripts'];

                $errors = [];

                if (empty($name)) 
                {
                    $errors[] = "Your full name is needed.";
                }

                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
                    $errors[] = "A valid email is required.";
                }
                if (empty($PhoneNumber)) 
                {
                    $errors[] = "Your phone number is needed.";
                }
                if (!empty($errors)) 
                {
                    foreach ($errors as $error) 
                    {
                        echo "<p style='color: red;'>$error</p>";
                    }
                    exit;  
                }

                $uploadsDir = 'uploads/';
                $profilePictureDir = $uploadsDir . 'profilePictures/';
                $transcriptsDir = $uploadsDir . 'transcripts/';

                if (!is_dir($uploadsDir)) 
                {
                    mkdir($uploadsDir, 0755);
                }

                if (!is_dir($profilePictureDir)) 
                {

                    mkdir($profilePictureDir, 0755);
                }

                if (!is_dir($transcriptsDir))
                {
                    mkdir($transcriptsDir,0755);
                }
                 if( file_put_contents($profilePictureDir . $profilePicture['name'] . '_' .time(), file_get_contents($profilePicture['tmp_name'])) )
                {
                    echo "<br>profile picture was uploaded successfully!";
                }

                if( file_put_contents($transcriptsDir . $transcripts['name']. '_' . time(), file_get_contents($transcripts['tmp_name'])) )
                {
                    echo "<br>transcript was uploaded successfully!";
                }

                $profilePicPath = $profilePictureDir . $profilePicture['name'] . '_' . time();
                $transcriptsPath = $transcriptsDir . $transcripts['name'] . '_' . time();

                $studInfo = "$name | $email | $PhoneNumber | $profilePicPath | $transcriptsPath\n";

                 if (file_put_contents('data.txt', $studInfo, FILE_APPEND)) 
                {
                    echo "<br>User data saved!";
                } 
                else 
                {
                    echo "There was an error saving the user data.";
                }
           
            }

        ?>
        <h1> School Plus Form </h1>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
            <label for="name">Full Name: </label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="email">Email: </label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="PhoneNumber">Phone Number: </label>
            <input type="text" id="PhoneNumber" name="PhoneNumber" required><br><br>

            <label for="profilePicture"> Profile Picture: </label>
            <input type="file" id="profilePicture" name="profilePicture" accept=".jpg, .png"><br><br>

            <label for="transcripts"> Transcripts: </label>
            <input type="file" id="transcripts" name="transcripts" accept=".pdf"><br><br>

            <button type="submit">Submit</button>
        </form>
    </body>
</html>
