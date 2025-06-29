<!DOCTYPE html>
<html>
    <head>
        <title> operation.php </title>
    </head>

    <body>
        <?php
$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$university = $_REQUEST['university'];
$notes = $_REQUEST['notes'];
$rating = $_REQUEST['rating'];

// Validate input fields
if (empty($name) || empty($notes) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
echo "Please fill all required fields and ensure the email is valid.";
exit();
}

// Redirect based on rating
if ($rating == "excellent" || $rating == "good") {
header("Location: acknowledgment.php");
exit();
} elseif ($rating == "poor") {
header("Location: dejected.php");
exit();
} else {
echo "Thank you for your feedback!";
}
?>
    </body>
</html>
