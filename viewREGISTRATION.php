<?php
	$data = file_get_contents('data.txt.');

	//displaying all the fields that user inpuit
	echo "Full Name = ". $_POST["fullName"];
	echo "<br/>";
	echo "Email = ". $_POST["email"];
	echo "<br/>";
	echo "Phone Number = ". $_POST["phoneNumber"];
	echo "<br/>";

?>
