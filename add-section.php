
<?php
require_once "controllers/login-controller.php";

if(!isLoggedIn()){
    Header("Location: login.php?redirect=".urlencode($_SERVER['REQUEST_URI']));
    exit();
}
/*
$sectionNumber = 1;

if(isset($_GET['section'])){
    $sectionNumber = $_GET['section'];
}

$pathwayId = $_GET['pathway_id'];

$pathway = getPathway(getUserId(getUsername()), $pathwayId);*/

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

    <title>Edit Pathway</title>


    <style>
        body{
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        main{
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
        
        h1{
            color: rgb(180, 175, 175);

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
        
        #links{
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 70%;
        }
        
        #links .link{
            display: flex;
            flex-direction: row;
            align-items: center;
            width: 100%;
            margin-bottom: 20px;
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

<main>
    <h1>Section 1</h1>
    <form>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Title" required>

        <label for="description">Description</label>
        <textarea name="description" id="description" cols="30" rows="10" placeholder="Description" required></textarea>

        <label>Links</label>
        <div id="links">
            <div class="link">
                <input type="text" name="link-url[]" placeholder="URL">
                <input type="text" name="link-text[]" placeholder="Text">
            </div>
            <div class="link">
                <input type="text" name="link-url[]" placeholder="URL">
                <input type="text" name="link-text[]" placeholder="Text">
            </div>
            <div class="link">
                <input type="text" name="link-url[]" placeholder="URL">
                <input type="text" name="link-text[]" placeholder="Text">
            </div>
            <div class="link">
                <input type="text" name="link-url[]" placeholder="URL">
                <input type="text" name="link-text[]" placeholder="Text">
            </div>
            
            <div class="link">
                <input type="text" name="link-url[]" placeholder="URL">
                <input type="text" name="link-text[]" placeholder="Text">
            </div>
        </div>
        <input type="submit" value="Add Section">
    </form>
</main>

<script>
   // When submit is clicked send a post request to the server
   const submitBtn = document.querySelector("input[type='submit']");
    submitBtn.addEventListener("click", (e) => {
         e.preventDefault();
         const title = document.querySelector("#title").value;
         const description = document.querySelector("#description").value;
         const links = document.querySelectorAll("#links .link");
         const linkUrls = [];
         const linkTexts = [];
         links.forEach(link => {
              const url = link.querySelector("input[type='text']").value;
              const text = link.querySelector("input[type='text']").value;
              if(url === "" || text === "")
                  return;
              linkUrls.push(url);
              linkTexts.push(text);
         });
         const data = {
              title: title,
              description: description,
              linkUrls: linkUrls,
              linkTexts: linkTexts
         };
         console.log(data);
         const xhr = new XMLHttpRequest();
         xhr.open("POST", "add-section-api", true);
         xhr.setRequestHeader("Content-Type", "application/json");
         xhr.onreadystatechange = function() {
              if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                console.log(this.responseText);
              }
         }
         xhr.send(JSON.stringify(data));
    });
   
</script>

</body>