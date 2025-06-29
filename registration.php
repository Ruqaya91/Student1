<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

  $fullName = $_POST['full_name']?? '';
  $email = $_POST['email']?? '';
  $Telephone = $_POST['Telephone']?? '';

  if(empty($fullName || empty($email || empty($phone)
|| empty($_FILES['profile_picture']['name']) || empty($_FILES['transcripts']['name'])) {
  	die('All fields required')
  }

  //Validate email
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  	die('Invalid email format');
  }

  $profileDir = 'uploads/profile_picture/';
  $transcriptDir = 'uploads/transcripts/';
  if (!is_dir($profileDir)) mkdir($profileDir, 0777, true);
  if (!is_dir($transcriptDir)) mkdir($transcriptDir, 0777, true);

  //Handling profile picture uploads
$profilePicture = $_FILES['profile_picture'];
$allowedImagineTypes = ['Image/jpeg', 'image/png'];

if (!in_array($profilePicture['type'], $allowedImagineTypes)) {
	die('Profile picture must be a .jpg or .png image file')
}

$profilePicturePath = 'upload/profile_picture/profile_'. time() . '.' . pathinfo($profilePicture['name'], PATHINFO_EXTENSION);
if (!move_uploaded_file($profilePicture['tmp_name'], $profilePicturePath)) {
	die('Failed to upload a profile picture.');
}

$transcriptPath = 'uploads/transcripts/transcript_' . time() . '.'. pathinfo($transcript['name'], PATHINFO_EXTENSION);
if(!move_uploaded_file($transcript['tmp_name'], $transcriptPath)) {
	die('Failed to upload transcript.');
}

//Save user data
$userData = "$fullname | $email | $Telephone | $profilePicturePath | $transcriptPath" . PHP_EOL;
file_put_contents('data.txt', $userData, FILE_APPEND);

echo "Registration successful!";
}
?>
