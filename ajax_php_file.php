<?php
    if(isset($_FILES["file"]["type"])) {

        $validextensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        
        if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
        ) && ($_FILES["file"]["size"] < 10000000)//Approx. 10mb files can be uploaded.
        && in_array($file_extension, $validextensions)) {

            if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";

        } else {

            if (file_exists("img/" . $_FILES["file"]["name"])) {
            echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";

        } else {

            $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
            $targetPath = "img/".$_FILES['file']['name']; // Target path where file is to be stored
            move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
            echo "<span id='success'>Success!!</span><br/>";

            require_once('db_con.php');
            
            $sql = 'INSERT INTO image(id, url) VALUES (?,?)';
            $stmt = $con->prepare($sql);
            $stmt->bind_param('is', $id, $target_file);
            $stmt->execute();
            if ($stmt->affected_rows > 0){
                //echo 'Filedata added to the database :-)';
            } else {
                echo 'Could not add the file to the database';
            }

        }}} else {

        echo "<span id='invalid'>***Invalid file Size or Type***<span>";

        }
    }

?>

