<?php
if (file_exists("data.txt")) {
    
    $data = file_get_contents("data.txt");

    
    $lines = explode("\n", $data);

    
    foreach ($lines as $line) {
        if (!empty($line)) {  
            $fields = explode(" | ", $line);

            
            $name =  $fields[0];
            $email = $fields[1];
            $phone = $fields[2];
            $profilePicturePath = $fields[3];
            $transcriptPath = $fields[4];



            
          echo "<div style='border: 1px solid #ddd; padding: 10px; margin-bottom: 10px;'>";
            echo "<h3>User Information</h3>";
            echo "<strong>Full Name:</strong> " . htmlspecialchars($name) . "<br>";
            echo "<strong>Email:</strong> " . htmlspecialchars($email) . "<br>";
            echo "<strong>Phone Number:</strong> " . htmlspecialchars($phone) . "<br>";

            
            if (file_exists($profilePicturePath)) {
                echo "<strong>Profile Picture:</strong> <img src='" . htmlspecialchars($profilePicturePath) . "' alt='Profile Picture' style='width: 100px; height: 100px;'><br>";
            } else {
                echo "<strong>Profile Picture:</strong> <em>No profile picture uploaded</em><br>";
            }

            
            if (file_exists($transcriptPath)) {
                echo "<strong>Transcript:</strong> <a href='" . htmlspecialchars($transcriptPath) . "' download>Download Transcript</a><br>";
            } else {
                echo "<strong>Transcript:</strong> <em>No transcript uploaded</em><br>";
            }
            echo "</div>";
        }
    }
} else {
    echo "No registration data was found.";
}
?>
