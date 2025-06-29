    <?php
   
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>School Admission Registration</title>
	<link rel="stylesheet" type="text/css" href="styles/index.css">
    </head>
    <body>
        <h2>Register for School Admission</h2>
        <form action="process_registration.php" method="POST" enctype="multipart/form-data">
            <label for="full_name">Full Name:</label>
            <input type="text" name="full_name" required><br>
            
            <label for="email">Email:</label>
            <input type="email" name="email" required><br>
            
            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" required><br>
            
            <label for="profile_picture">Profile Picture (.jpg, .png):</label>
            <input type="file" name="profile_picture" accept="image/jpeg, image/png" required><br>
            
            <label for="transcript">Transcript (.pdf):</label>
            <input type="file" name="transcript" accept="application/pdf" required><br>
            
            <input type="submit" name="submit" value="Register">
        </form>
    </body>
    </html>
