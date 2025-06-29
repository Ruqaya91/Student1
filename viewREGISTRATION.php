<!DOCTYPE html>
<html><!-- htmls starts -->

    <head>
        <title>School Registrations</title>
    </head>

    <body> <!-- body starts -->
        <h1>School Registration Page</h1>

        <?php //php starts

        // Checks if the data.txt file exists
        if (file_exists('data.txt')) 
        {
            
            //explode() function breaks strings into an array
            // this splits the contents of the lines from the data.txt file
            // the "\n" is the delimeter so each new line in the array will be split in the data.txt file
            $lines = explode("\n", file_get_contents('data.txt'));

            foreach ($lines as $line) 
            {
                //if the line in the data.txt file isnt empty it's gonna be further split by the " | " delimiter that is in each line
                if (!empty($line)) 
                {
                    // Split the line by delimiter " | "
                    $userInfo = explode(" | ", $line);

                    // displays the data the user inputs on the registration form by getting each index of the userinfo array
                    // <strong> this tag makes text bold/distinct from the other text
                    echo "<p> <strong>Full Name:</strong> " . htmlspecialchars($userInfo[0]) . "</p>";
                    echo "<p> <strong>Email:</strong> " . htmlspecialchars($userInfo[1]) . "</p>";
                    echo "<p> <strong>Phone Number:</strong> " . htmlspecialchars($userInfo[2]) . "</p>";
                    echo "<p> <strong>Profile Picture:</strong> <img src='" . htmlspecialchars($userInfo[3]) . "' alt='Profile Picture' style='width:100px;'></p>";
                    echo "<p> <strong>Transcript:</strong> <a href='" . htmlspecialchars($userInfo[4]) . "' download>Click to download transcript</a></p>";
                }
            }
        }
        //if the data.txt file doesn't exist there was something wrong in submission
        else 
        {
            echo "<br>There is no data in the registration form, please go back and submit the form with all of your information put in.";
        }
        ?> <!-- php ends-->

    </body> <!-- body ends -->

</html> <!-- html ends -->
