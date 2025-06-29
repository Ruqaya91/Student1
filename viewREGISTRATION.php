
<head>
    <title>View Registrations</title>
</head>

<?php
echo "<h2><center>--User Registrations--</center></h2>"; // title


// grab the data from data.txt 
$file = 'data.txt';
if (file_exists($file)) {
    $data = file_get_contents($file);
    $lines = explode("\n", trim($data));

// create a registration list 
    foreach ($lines as $line) {
        list($fullName, $email, $phoneNumber, $pfp_path, $transcript_path) = explode(" | ", $line);  // explode breaks string into array, in this case it breaks it by every instance of | (future note) 

        echo "<div>";
        echo "<p><strong>Full Name:</strong> $fullName</p>";
		
        echo "<p><strong>Email:</strong> $email</p>";
		
        echo "<p><strong>Phone Number:</strong> $phoneNumber</p>";
		
        echo "<p><strong>Profile Picture:</strong> <img src='$pfp_path' width='100' height='100'></p>";
		
        echo "<p><strong>Transcript:</strong> <a href='$transcript_path' download>Download Transcript</a></p>";
		
        echo "</div><hr>";
    }
} else {
    echo "No registrations found.";   // if theres no data
}
?>
