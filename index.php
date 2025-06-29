<!DOCTYPE html>
<html>
<body>
    <?php
        $req_method = $_SERVER['REQUEST_METHOD'];
        if ($req_method == 'GET') {
            include_once('./form.php');
        } elseif ($req_method == 'POST') {
            include_once('./process.php');
        }
    ?>
</body>
</html>
