<?php
if (isset($_POST["submit"])) {
    $targetDir = "../../public/";
    $targetFile = $targetDir . basename($_FILES["profilePicture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES["profilePicture"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "File already exists.";
        $uploadOk = 0;
    }

    // Allow only certain image file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES["profilePicture"]["name"]) . " has been uploaded.";
            // Update the profile picture path in the database
            $userId = 1; // Replace with the actual user's ID
            $profilePicturePath = $targetFile;
            // Perform database update query here
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
