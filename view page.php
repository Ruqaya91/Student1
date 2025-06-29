<!DOCTYPE html>
<html>
<head>
    <style>
        span {
            display: flex;
            align-items: center;
        }
        img {
            display: inline-block;
            height: 75px;
        }
    </style>
</head>
<body>
<a href=index.php>Return to main page</a>
<br><br>
<?php
    $data = file_get_contents('data.txt');
    if (!$data) {
        echo "An error occured.";
        exit();
    }
    $lines = explode("\n", $data);
    foreach ($lines as $line) {
        if ($line == '') continue;
        $fields = explode(" | ", $line);
        echo '<span>';
        echo 'Name: '.$fields[0].', ';
        echo 'Email: '.$fields[1].', ';
        echo 'Phone number: '.$fields[2].' ';
        echo '<img src="'.$fields[3].'"> ';
        echo '<a href="'.$fields[4].'">Transcript</a>';
        echo '</span><br>';
    }
?>
</body>
</html>
