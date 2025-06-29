<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewpoint" content="width=device-width, initial-scale=1.0">
	<title>PHP Server Info</title>
</head>
<body>
	<h1>Basic User Form</h1>
	<form method="post" action="server_info.php">
		<lable for="name">Name:</lable>
		<input type="text" id="name" name="name" required><br><br>

		<lable for="email">Email:</lable>
		<input type="email" id="email" name="email" required><br><br>

		<input type="submit" value="Submit">
	</form>	
</body>
</html>
