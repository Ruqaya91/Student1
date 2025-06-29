<?php
$data_txt_file = 'data.txt';

// Check for file
if (file_exists($data_txt_file)) {
    // Read data.txt
    $student_data = file_get_contents($data_txt_file);

    // Intialize variables
    $full_name = '';
    $email = '';
    $phone = '';
    $profile_pic_path = '';
    $transcripts_path = '';

    $start = 0;
    $field_count = 0;
    $line_length = strlen($student_data);

    // Split the content
    $current_field = '';
    for ($i = 0; $i < $line_length; $i++) {
        if ($student_data[$i] != '|' && $student_data[$i] != "\n") {
            
            $current_field .= $student_data[$i];
        } else {
            
            if ($field_count == 0) {
                $full_name = $current_field; 
            } elseif ($field_count == 1) {
                $email = $current_field; 
            } elseif ($field_count == 2) {
                $phone = $current_field; 
            } elseif ($field_count == 3) {
                $profile_pic_path = $current_field; 
            } elseif ($field_count == 4) {
                $transcripts_path = $current_field; 
            }

            $field_count++; 
            $current_field = ''; 
        }
    }

    // Check data for each field
    if ($field_count == 5) {
        // Display student data
        echo "<h1>Student Registered</h1>";
        echo "<p><strong>Full Name:</strong> $full_name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Phone Number:</strong> $phone</p>";
        echo "<p><strong>Profile Picture:</strong><br><img src='$profile_pic_path' style='width: 200px;'></p>";
        echo "<p><strong>Transcript File:</strong> <a href='$transcripts_path' download>Download Transcript</a></p>";
    } else {
        echo "<p>Missing data.</p>";
    }
} else {
    echo "<p>No data found.</p>";
}

?>
