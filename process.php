<head>
    <title>Registration</title>
</head>


<?php


//validate form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['fullName']) || empty($_POST['email']) || empty($_POST['phoneNumber']) || empty($_FILES['pfp']) || empty($_FILES['transcripts'])) {
        echo "Please fill out all of the fields!!";
        exit;
    }
}

    // checking the email
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if (!$email) {
        echo "Invalid email address!";
        exit;
    }

   
    // create folder for uploads
    if (!file_exists('uploads')) {
        mkdir('uploads', 0777, true);  // 0777 gives read, write, and execute permissions
        }
   
   
    // picture upload and name change
    $pfp = $_FILES['pfp'];
    $pfp_name = "profile_" . time() . "." . pathinfo($pfp['name'], PATHINFO_EXTENSION);
    $pfp_path = "uploads/pfps/" . $pfp_name;
	// restriction on pictures for jpeg and png
    if (!in_array($pfp['type'], ['image/jpeg', 'image/png'])) {
        echo "Profile picture must be a .jpeg or .png file!";
        exit;
    }

    // pdf upload and name change
    $transcripts = $_FILES['transcripts'];
    $transcript_name = "transcript_" . time() . ".pdf";
    $transcript_path = "uploads/transcripts/" . $transcript_name;
	// restriction on file so its a pdf 
    if ($transcripts['type'] != 'application/pdf') {
        echo "Transcript must be a .pdf file!";
        exit;
    }

    // create pfp folder
    if (!file_exists('uploads/pfps')) {
        mkdir('uploads/pfps', 0777, true);
    }
	//create transcript folder
    if (!file_exists('uploads/transcripts')) {
        mkdir('uploads/transcripts', 0777, true);
    }


    // created files move to new folders
    move_uploaded_file($pfp['tmp_name'], $pfp_path);
    move_uploaded_file($transcripts['tmp_name'], $transcript_path);


    // appending the files to data.txt
    $user_data = $_POST['fullName'] . " | " . $_POST['email'] . " | " . $_POST['phoneNumber'] . " | " . $pfp_path . " | " . $transcript_path . "\n";
    file_put_contents('data.txt', $user_data, FILE_APPEND);
	
	
	
	
	
	// website message to user on successful registration
	echo "<h1>Registration successful!</h1>";
	echo "<a href=http://localhost/Projects/view_registration.php>View Registrations</a>";
	
	
	
?>
