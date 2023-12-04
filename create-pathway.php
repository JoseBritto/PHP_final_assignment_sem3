<?php
require_once "controllers/login-controller.php";

if(!isLoggedIn()){
    Header("Location: login.php?redirect=".urlencode($_SERVER['REQUEST_URI']));
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/reset-all.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/components/pathway-card.css">

    <title>PEPE_OnTop</title>
    
    
    <style>
        main{
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
        
        form{
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
            margin-left: 25%;
        }
        
        form input[type="text"], form textarea{
            width: 70%;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #525252;
            margin: 10px;
        }
        
        form input[type="file"]{
            width: 70%;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #525252;
            color: rgb(180, 175, 175);
            margin: 10px;
        }
        
        form input[type="submit"]{
            width: 70%;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid #525252;
            margin: 10px;
            background-color: #525252;
            color: white;
            font-weight: 700;
            font-size: 1.2em;
        }
        
        form input[type="submit"]:hover{
            background-color: rgba(83, 83, 83, 0.44);
            border-radius: 8px;
            cursor: pointer;
        }
        
        form label{
            font-size: 1.2em;
            font-weight: 700;
            margin: 10px;
            color: rgb(180, 175, 175);
            text-align: left;
        }
        
        form textarea{
            resize: none;
        }
        
        form input[type="text"]:focus, form textarea:focus{
            outline: none;
            border: 1px solid #FF0000;
        }
    </style>
</head>

<body>


<?php
require_once "components/header.php";
require_once "controllers/login-controller.php";
if(isLoggedIn()) {
    echo getHeader("Home", true, getDisplayName());
} else {
    echo getHeader("Home", false);
}
?>

<br>
<br>
<br>

<?php

$target_dir = "uploads/pathway-images/";
$target_file = $target_dir . basename($_FILES["pathway-image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["pathway-title"]) && isset($_POST["pathway-description"]) && isset($_FILES["pathway-image"])){
    $pathwayTitle = $_POST["pathway-title"];
    $pathwayDescription = $_POST["pathway-description"];
    $pathwayImage = $_FILES["pathway-image"]["name"];
    $userId = getUserId(getUsername());
    if ($_FILES["pathway-image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    } elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    } elseif($pathwayTitle == "" || $pathwayDescription == ""){
        echo "Please fill in all the fields";
        $uploadOk = 0;
    } else {
        $db = Database::getInstance();
        $db->addPathway($userId, $pathwayTitle, $pathwayDescription, $pathwayImage);
        $pathwayId = $db->getPathwayId($userId, $pathwayTitle, $pathwayDescription, $pathwayImage);
        $pathwayImage = $pathwayId.".".$imageFileType;
        $target_file = $target_dir . $pathwayImage;
        $db->updatePathwayImage($pathwayId, $target_file);
        if (move_uploaded_file($_FILES["pathway-image"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["pathway-image"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        header("Location: pathway.php?id=$pathwayId");
    }
}

?>

<main>
    <form action="create-pathway.php" method="POST" enctype="multipart/form-data">
        <label for="pathway-title">Pathway Title</label>
        <input type="text" name="pathway-title" id="pathway-title" placeholder="Enter pathway title" required>
        <label for="pathway-description">Pathway Description</label>
        <textarea name="pathway-description" id="pathway-description" cols="30" rows="10" placeholder="Enter pathway description" required></textarea>
        <label for="pathway-image">Pathway Image</label>
        <input type="file" name="pathway-image" id="pathway-image" required>
        
        <input type="submit" value="Create Pathway" class="create-pathway-btn">
    </form>
</main>

</body>