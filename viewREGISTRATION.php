<?php
 
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>View Registrations</title>
        <link rel="stylesheet" type="text/css" href="styles/view_registration.css">
    </head>
    <body>
        <h2>Registered Users</h2>
        <?php
        $data_file = 'data.txt';
        if (file_exists($data_file)) {
            $entries = file($data_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            echo "<table>
                    <tr>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Profile Picture</th>
                        <th>Transcript</th>
                    </tr>";
            
            foreach ($entries as $entry) {
                list($full_name, $email, $phone, $profile_path, $transcript_path) = explode(' | ', $entry);
                echo "<tr>
                        <td>$full_name</td>
                        <td>$email</td>
                        <td>$phone</td>
                        <td><img src='$profile_path' width='100'></td>
                        <td><a href='$transcript_path' target='_blank'>Download</a></td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='no-data'>No registrations found.</p>";
        }
        ?>
    </body>
    </html>
