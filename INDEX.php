// Form

<h1> Miami School  Registration</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

    
    <!-- Full Name -->
    <input type="text" name="Full_Name" placeholder="Full Name" required><br><br>

    <!-- Email -->
    <input type="email" name="Email" placeholder="Email" required><br><br>

    <!-- Phone Number -->
    <input type="text" name="phone_number" placeholder="Phone Number" required><br><br>

    <!-- Profile Picture -->
    <input type="file" name="profile_picture" accept=".jpg, .png" required><br><br>

    <!-- Transcript -->
    <input type="file" name="transcripts" accept=".pdf" required><br><br>

    <!-- Submit -->
    <input type="submit" value="Submit">
</form>



// Processing and Validation

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // form 
    $name = $_POST["Full_Name"];
    $email = $_POST["Email"];
    $phone = $_POST["phone_number"];
    $profilePicture = $_FILES["profile_picture"];
    $transcripts = $_FILES["transcripts"];




    // Validation
    if (empty($name)) {
        echo "This Field  is required.<br>";
    }

    if (empty($email)) {
        echo "Email is required.<br>";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "This field is required.<br>";
    }

    if (empty($phone)) {
        echo "This field is required.<br>";
    }

    if (empty($profilePicture["name"])) {
        echo "Profile picture is mandatory.<br>";
    } else if (!in_array(pathinfo($profilePicture["name"], PATHINFO_EXTENSION), ["jpg", "png"])) {
        echo "Profile Picture must be a JPG or PNG file.<br>";


    }

    if (empty($transcripts["name"])) {
        echo "Transcript is required.<br>";
    } else if (pathinfo($transcripts["name"], PATHINFO_EXTENSION) != "pdf") {
        echo "Transcript must be a PDF file.<br>";
    }


    
    if (!empty($name) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($phone) &&
        !empty($profilePicture['name']) && in_array(pathinfo($profilePicture['name'], PATHINFO_EXTENSION), ['jpg', 'png']) &&
        !empty($transcripts['name']) && pathinfo($transcripts['name'], PATHINFO_EXTENSION) == 'pdf') {





//Paths
    
$profilePicturePath = "uploads/profile_pictures/" . time() . "_" . $profilePicture["name"];
$transcriptPath = "uploads/transcripts/" . time() . "_" . $transcripts["name"];


move_uploaded_file($profilePicture["tmp_name"], $profilePicturePath);
move_uploaded_file($transcripts["tmp_name"], $transcriptPath);


$data = $name . " | " . $email . " | " . $phone . " | " . $profilePicturePath . " | " . $transcriptPath . "\n";
file_put_contents("data.txt", $data, FILE_APPEND);

echo "Form submitted successfully!<br>";

    }
}
?>

