<!DOCTYPE html>
<html>
<head>
	<title>About Me</title>
</head>
<body>
<form action=<?php echo $_SERVER['PHP_SELF'] ?> method="post" enctype="multipart/form-data">
Name: <input type="text" name="name" required><br>
E-mail: <input type="text" name="email" required><br>
Phone Number: <input type="text" name="phone" required><br>
Profile Picture: <input type="file" name="profilepic" id="profilepic" required><br>
Transcripts: <input type="file" name="transcript" id="transcript" required><br>
<input type="submit" name="submit"><br>
</form>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST")

    // save form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);

	//validate data
    // sanitize and validate email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email";
        exit();
    }
	
	//validate upload file types
	$pfp_ext = strtolower(pathinfo($_FILES['profilepic']['name'], PATHINFO_EXTENSION));
	$transcript_ext = strtolower(pathinfo($_FILES['transcript']['name'], PATHINFO_EXTENSION));
	
	$pfp_allowed = array("jpg", "jpeg", "png");
	
	if(!in_array($pfp_ext, $pfp_allowed)) {
		echo "Profile picture must be a JPG or PNG file.";
		exit();
	}
	
	if($transcript_ext != "pdf") {
		echo "Transcript must be in PDF format.";
		exit();
	}

    // upload files with new names
    $pfp_dir = "uploads/profile_pictures/";
    $transcript_dir = "uploads/transcripts/";

    $pfp_tmp = $_FILES['profilepic']['tmp_name'];
	$transcript_tmp = $_FILES['transcript']['tmp_name'];

    $pfp_newname = "profile_". time() . "." . "$pfp_ext";
    $transcript_newname = "transcript_". time() . "." . "$transcript_ext";
	
    move_uploaded_file($pfp_tmp, $pfp_dir . $pfp_newname);
	move_uploaded_file($transcript_tmp, $transcript_dir . $transcript_newname);
	
	// add data to datafile
    $datafile = 'data.txt';
    $newdata = "$name,$email,$phone,$pfp_dir$pfp_newname,$transcript_dir$transcript_newname\n";

    file_put_contents($datafile, $newdata, FILE_APPEND)
?>

<a href="view_registration.php" target="_blank">View Registered Users</a>

</body>
</html>
