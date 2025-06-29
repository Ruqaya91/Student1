<?php
    $name = $_POST['name'];
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $phone = $_POST['phone'];
    $picture = $_FILES['picture'];
    $transcript = $_FILES['transcript'];

    $pictures_dir = 'uploads/profile_pictures/';
    $transcripts_dir = 'uploads/transcripts/';
    if (!is_dir($pictures_dir)) {
        if (!mkdir($pictures_dir, 755, true)) {
            echo 'An error occured: Could not create pictures folder.';
            exit();
        }
    }
    if (!is_dir($transcripts_dir)) {
        if (!mkdir($transcripts_dir, 755, true)) {
            echo 'An error occured: Could not create transcripts folder.';
            exit();
        }
    }

    $time = time();
    $picture_path = $pictures_dir.$time.'_'.$picture['name'];
    $transcript_path = $transcripts_dir.$time.'_'.$transcript['name'];
    file_put_contents($picture_path, file_get_contents($picture['tmp_name']));
    file_put_contents($transcript_path, file_get_contents($transcript['tmp_name']));

    file_put_contents('data.txt', $name.' | '.$email.' | '.$phone.' | '.$picture_path.' | '.$transcript_path."\n", FILE_APPEND);

    echo 'Successfully submitted form!<br>';
    echo '<a href=index.php>Return to main page</a>';
?>
