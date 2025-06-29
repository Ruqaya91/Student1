<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Regristration Form</title>
</head>
<body>
	<style type="text/css">
		body {
			background-color: #95C8F6;
			background-image: linear-gradient(to bottom, #fff, #95C876);
			font-family: sans-serif;
			padding: 0;
			margin: 0;
			display: flex;
			flex-direction: column;
			min-height: 100vh;
			align-items: center;
			padding-top: 50px;
			justify-content: center;
		}

		form {
			background-color: #fff;
			border: 1px solid #ccc;
			border-radius: 15px;
			max-width: 400px;
			box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
			width: 100%;
			margin: 0px;
			min-height: 10vh;
			padding: 30px;
		}

		label {
			 display: block;
			 font-weight: bold;
			 padding: 10px;
		}

		input[type="text"],
		input[type="email"],
		input[type="Telephone"],
		input[type="file"] {
			width: 100%;
			max-width: 350px;
			font-size: 14px;
		}

		button {
			padding: 10px 25px;
			background-color: #F8DA1B;
			color: black;
			border: none;
			display: block;
			margin: 5px auto;
			text-align: center;
			cursor: pointer;
		}

		button:hover {
			background-color: #FFEC09;

		}

		a {
			text-decoration: none;
			padding: 15px, 25px;
			color: black;
			background-color: #F8DA1B;
			text-align: center;
			margin: 10px auto;
		}

		a:hover {
			background-color: #FFEC09;
		}
	}
	
	</style>

	<form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" ectype="multipart/form-data">
		<h1>Registration Form</h1>

		<label for="name">Name:</label>
		<input type="text" id="name" name="name">
		<br><br>

		<label for="email">Email:</label>
		<input type="text" id="email" name="email">
		<br><br>

		<label for="Telephone">Phone Number:</label>
		<input type="Telephone" id="Telephone" name="Telephone">
		<br><br>

		<label for="profile_picture">Profile Picture:</label>
		<input type="file" name="profile_picture" accept=".jpg, .png" required>
		<br><br>

		<label for="transcript">Transcripts:</label>
		<input type="file" name="transcript" accept=".pdf" required>
		<br><br>

		<button type="submit">Submit</button>
	</form>
	<br>
	<a href="view_registration.php">View Registrations</a>
</body>
</html>
