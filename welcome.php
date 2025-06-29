<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>About Me</title>
</head>
<body>
	<h1>Welcome to Web Application Programming!</h1>
	<?php
		// Basic information stored in variables
		$name = "Alexander James Rivero";
		$designation = "Student";
		$university = "Florida International University";
		$department = "IT - Information Technology";
		$email = "arive469@fiu.edu";

		// Displaying the information dynamically
		echo "<p><strong>Name:</strong> $name</p>";
		echo "<p><strong>Designation:</strong> $designation</p>";
		echo "<p><strong>University:</strong> $university</p>";
		echo "<p><strong>Department:</strong> $department</p>";
		echo "<p><strong>Email:</strong> $email</p>";
	?>
	
	<input type=text value="<?php echo $name; ?>">
</body>
</html> 
