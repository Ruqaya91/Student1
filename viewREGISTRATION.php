<!DOCTYPE html>
<html>

    <head>
        <title> Register to my School </title>
    </head>

    <body>
        <h1> Register Sheet </h1>

        <?php

            if (file_exists('data.txt')) 
            {
                $lines = explode("\n", file_get_contents('data.txt'));

                foreach ($lines as $line) 
                {
                    if (!empty($line)) 
                    {
                        $studInfo = explode(" | ", $line);

                        echo "<p>   Full Name: " . htmlspecialchars($studInfo[0]) . "</p>";
                        echo "<p>   Email: " . htmlspecialchars($studInfo[1]) . "</p>";
                        echo "<p>   Phone Number: " . htmlspecialchars($studInfo[2]) . "</p>";
                        echo "<p>   Profile Picture <img src='" . htmlspecialchars($studInfo[3]) . "' alt='Profile Picture' style='width:100px;'></p>";
                        echo "<p>   Transcript: <a href='" . htmlspecialchars($studInfo[4]) . "' download>Click to download transcript</a></p>";
                    }
                }
            }
            else 
            {
                echo "<br>There is no data in the registration form, please go back and submit the form with all of your information put in.";
            }
        ?>
    </body>
</html>
