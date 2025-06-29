<form <?php echo "action=".$_SERVER['PHP_SELF'] ?> method="POST" enctype="multipart/form-data">
    Full name: <input type=text id=name name=name required>    
    <br><br>
    Email address: <input type=email id=email name=email required>    
    <br><br>
    Phone number: <input type=tel id=phone name=phone required>    
    <br><br>
    Profile Picture: <input type=file id=picture name=picture accept="image/png,image/jpeg" required>    
    <br><br>
    Transcript: <input type=file id=transcript name=transcript accept="application/pdf" required>
    <br><br>
    <button type=submit>Submit</button>
</form>
<br><br>
<a href=view_registration.php>View all submissions</a>
