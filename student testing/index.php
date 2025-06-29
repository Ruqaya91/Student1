<?php

$registrations = file_get_contents('data.txt');
if ($registrations === false) {
	die('Failed to read registrations file.');
}

$lines = explode(PHP_EOL, $registrations);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>View Registration</title>
</head>
<body>
	<h1>Registered Users</h1>
	<?php foreach ($lines as $line): ?>
		<?php if (trim($line) !== ''): ?>
			<?php
			list($name, $email, $phone, $profilePath, $transcriptPath) = explode('|', $line);
			<div> 
				<p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
				<p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
				<p><strong>Phone:</strong> <?= htmlspecialchars($Telephone) ?></p>
				<p><strong>Profile picture:</strong> <?= htmlspecialchars($profilePath) ?>" alt="Profile Picture" style="width:150px;"></p>
				<p><strong>Transcript:</strong> <?= htmlspecialchars($transcriptPath) ?></p>

			</div>	
			<hr>
		<?php endif; ?>
	<?php endforreach; ?>
</body>
</html>
