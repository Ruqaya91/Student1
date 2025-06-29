<!DOCTYPE html>
<html> <!--html starts -->

    <head>
        <title>Registration Form</title>
    </head>

    <body> <!-- body starts -->
        <h1>Registration Form</h1>

        <!-- PHP starts -->
        <?php 
            // Checks if form is submitted by post and processes the form the user submitted
            if ($_SERVER['REQUEST_METHOD'] === 'POST') 
            {
                // gets the data from the form that the user submits
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $phonenumber = $_POST['phonenumber'];
            
                // Accesses the uploaded files submitted from user
                $profile_picture = $_FILES['profile_picture'];
                $transcript = $_FILES['transcript'];

                // Initialize an array for errors
                $errors = [];

                // fullname, email, and phonenumber are required to submit the form
                if (empty($fullname)) 
                {
                    $errors[] = "Your full name is needed.";
                }

                if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) 
                {
                    $errors[] = "A valid email is required.";
                }
                if (empty($phonenumber)) 
                {
                    $errors[] = "Your phone number is needed.";
                }

                // if the fields for fullname, email, or phonenumber are missing program will display error message and the program ends
                if (!empty($errors)) 
                {
                    foreach ($errors as $error) 
                    {
                        echo "<p style='color: red;'>$error</p>";
                    }
                    exit;  // Stops the program if empty fields
                }

                // Directory paths for storing uploaded files submitted by the user
                $uploadsDir = 'uploads/';
                $childDirPic = $uploadsDir . 'profile_pictures/';
                $childDirTranscript = $uploadsDir . 'transcripts/';

                // checks to see if the directories already exist and create directories if they don't exist
                if (!is_dir($uploadsDir)) 
                {
                    //0755 is the permissions granted
                    mkdir($uploadsDir, 0755);
                }

                if (!is_dir($childDirPic)) 
                {

                    mkdir($childDirPic, 0755);
                }

                if (!is_dir($childDirTranscript)) 
                {
                    mkdir($childDirTranscript, 0755);
                }

                
                // Moves the uploaded profile picture to the desired directory using file_get_contents and file_put_contents
                //file_put_contents($childDirPic . $profile_picture['name'] . '_' . time(), file_get_contents($profile_picture['tmp_name']));
                if( file_put_contents($childDirPic . $profile_picture['name'] . '_' . time(), file_get_contents($profile_picture['tmp_name'])) )
                {
                    echo "<br>profile picture was uploaded successfully!";
                }

                // Moves the uploaded transcript to the desired directory using file_get_contents and file_put_contents
                //file_put_contents($childDirTranscript . $transcript['name']. '_' . time(), file_get_contents($transcript['tmp_name']));
                if( file_put_contents($childDirTranscript . $transcript['name']. '_' . time(), file_get_contents($transcript['tmp_name'])) )
                {
                    echo "<br>transcript was uploaded successfully!";
                }

                //variables that hold the string for the paths of profile pictures & transcripts so the path string can be added to data.txt file
                $profilePicPath = $childDirPic . $profile_picture['name'] . '_' . time();
                $transcriptPath = $childDirTranscript . $transcript['name'] . '_' . time();

                //after data is uploaded the user data is formated to be placed in data.txt file
                $userData = "$fullname | $email | $phonenumber | $profilePicPath | $transcriptPath\n";

                // Appends user data to data.txt using file_put_contents
                if (file_put_contents('data.txt', $userData, FILE_APPEND)) 
                {
                    echo "<br>User data saved!";
                } 
                else 
                {
                    echo "There was an error saving the user data.";
                }
           
            }
        ?> <!-- PHP ends -->

        <!-- Registration Form -->                        <!-- multipart/form-data is important it's necessary if the user will upload a file through the form -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
        
            <!-- fields for the form -->
            <label for="fullname">Full Name: </label>
            <input type="text" id="fullname" name="fullname" ><br><br>

            <label for="email">Email: </label>
            <input type="text" id="email" name="email" ><br><br>

            <label for="phonenumber">Phone Number: </label>
            <input type="text" id="phonenumber" name="phonenumber" ><br><br>

            <!-- file inputs for profile picture and transcript -->
            <label for="profile_picture">Profile Picture (jpg/png only):</label>
            <input type="file" id="profile_picture" name="profile_picture" accept=".jpg, .png" ><br><br>

            <label for="transcript">Transcript (pdf only):</label>
            <input type="file" id="transcript" name="transcript" accept=".pdf" ><br><br>

            <!--submit button  -->
            <button type="submit">Submit</button>
        </form>

    </body> <!-- body ends -->
</html> <!-- html ends -->
