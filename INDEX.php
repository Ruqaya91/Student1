<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	$full_name = $_POST['fullName'];
	$email = $_POST['email'];
	$phone_number = $_POST['phoneNumber'];
}
	// email validation
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo "Invalid email format.";
		exit;
	}
	// checking if files got uploaded
	if (isset($_FILES['profilePicture']) && isset($_FILES['transcripts'])){
		$profile_picture = $_FILES['profilePicture'];
		$transcripts = $_FILES['transcripts'];
		
	// making unique timestamped names for the files	
	$profile_picture_unique = time() . '.' . pathinfo($profile_picture['name'], PATHINFO_EXTENSION);
	$transcript_unique = time() . '.pdf';
	
	// making the path for files to save
	$profile_picture_path = 'uploads/profile_pictures/' . $profile_picture_unique;
	$transcript_path = 'uploads/transcripts/' . $transcript_unique;
	
	// formatting all info into one string
	$regis_data = $full_name . ' | ' . $email . ' | ' . $phone_number . ' | ' . $profile_picture_path . ' | ' . $transcript_path . "\n";
	
	// saving info to data file
	file_put_contents('data.txt', $regis_data, FILE_APPEND);
	
	echo "Thank you for Registering.";
	} else {
		echo "Please fill in all fields.";
	}
	
?>
