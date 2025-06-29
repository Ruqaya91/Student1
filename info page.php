<?php>
<html lang="en">
<head>   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>School Page</title>
</head>
<body>  
    <h2>School Form</h2>   
<form action="process.php" method="POST">
	Name: <input type=text name="name">
	<br/>
	email: <input type=email name="email">
	<br/>
    Phone Number: <input type=text number name="phonenumber">
    <br/>
    Profile Picture: <input type=file picture="picture" >
    <br/>
    Transcripts:<input type=file Ttanscripts="transcripts">
    <br/>
	<input type=submit value=submit>    
</form>
</body>
</html>
<?>
