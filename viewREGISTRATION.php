<?php

$data_contents = file_get_contents("data.txt");

$user_array = explode("\n", $data_contents); //split data by line

array_pop($user_array); // remove trailing newline

foreach ($user_array as $index=>$user) {
	echo "<h2>User $index</h2>";
	$userdata = explode(",", $user);
	echo "Name: $userdata[0]<br>";
	echo "Email: $userdata[1]<br>";
	echo "Phone: $userdata[2]<br>";
	echo "Profile Picture: <br><img src=$userdata[3] width=100 height=100><br>";
	echo "<a href=$userdata[4] download>Transcript</a>";
}

?>
