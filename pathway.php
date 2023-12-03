<?php
require_once "controllers/login-controller.php";
require_once "controllers/pathway-controller.php";

$isLoggedIn = isLoggedIn();
$username = getUsername();
$userId = getUserId($username);

$pathway = getPathway($userId, $_GET['pathway_id'] );

if($pathway == null){
    // TODO: Redirect to 404 page
}

$pathwayTitle = $pathway->pathway_title;
$pathwayId = $pathway->pathway_id;

$currentSectionNumber = 1;

if(isset($_GET['section'])){
    $currentSectionNumber = $_GET['section'];
}

$currentSection = getSection($pathwayId, $currentSectionNumber);

if($currentSection == null){
    // TODO: Redirect to 404 page
}

if($isLoggedIn)
    $links = getLinks($currentSection->section_id, $userId);
else{
    Header("Location: login.php?redirect=".urlencode($_SERVER['REQUEST_URI']));
    exit();
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/reset-all.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/pathway.css">
    <title>Becoming a meme</title>
</head>
<body>

<?php
require_once "components/header.php";
if($isLoggedIn) {
    echo getHeader( "Pathway", true, getDisplayName());
} else {
    echo getHeader("Pathway", false);
}
?>

<br>
<br>
<br>
<br>


<section id="top">
    <div class="image">
        <img src="assets/css/img/web-design.png" alt="alt">
    </div>
    <div class="main-area">
        
        <h1><?php echo $pathwayTitle ?></h1>
        <div class="progress-control">
            <div class="progress">
                <div class="progress-bar" style="width: <?php echo getProgress($userId, $pathwayId) ?>%"></div>
            </div>
            <div class="progress-text"><?php echo getProgress($userId, $pathwayId) ?>%</div>
            <button class="cancel-btn"> <i class="las la-trash-alt"></i> Remove</button>
            <button class="fork-btn"> <i class="las la-code-branch"></i> Fork</button>
        </div>
</section>

<hr>

<main>
    <section id="description">
        <h2>Section <?php echo "$currentSection->order - $currentSection->section_title"?></h2>
        <p> <?php echo $currentSection->section_description ?> </p>
    </section>
    
    <section class="links">
        
        
        <?php
        foreach ($links as $link) {
            $done = $link->completed ? "done" : "not-done";
            $checked = $link->completed ? "checked" : "";
            $url = $link->url;
            $text = $link->text;
            $id = $link->id;
            if($text == null)
                $text = $url;
            echo "<div class='$done link-box' id='link-box-$id'>
                        <div class='checkbox'>
                            <input type='checkbox' class='completed-check' $checked>
                        </div>
                        <a href='$url' target='_blank'>
                            <span>$text <i class='las la-external-link-alt'></i> </span>
                        </a>
                    </div>";
        }
        ?>
    </section>
    
    <section class="bottom">
        <div class="buttons">
            <button class="btn prev-btn">
                Previous
            </button>
            <button class="btn next-btn">
                Next
            </button>
        </div>
    </section>
</main>


<script type="application/javascript">
    
    const isLoggedIn = <?php echo $isLoggedIn ? "true" : "false" ?>;
    
    addEventListener("load", (event) => {
        
        // All checkboxes
        const checkboxes = document.querySelectorAll(".completed-check");
        
        // Disable next-btn if all link-boxes are not checked
        const nextBtn = document.querySelector(".next-btn");
        nextBtn.disabled = false;
        checkboxes.forEach((checkbox) => {
            if(!checkbox.checked){
                nextBtn.disabled = true;
                return;
            }
        });


        //Set links for next and previous buttons
        const prevBtn = document.querySelector(".prev-btn");
        const currentSectionNumber = <?php echo $currentSectionNumber ?>;
        if(currentSectionNumber === 1){
            prevBtn.disabled = true;
        } else {
            prevBtn.addEventListener("click", (event) => {
                window.location.href = `pathway.php?pathway_id=<?php echo $pathwayId ?>&section=${currentSectionNumber - 1}`;
            });
        }
        nextBtn.addEventListener("click", (event) => {
            window.location.href = `pathway.php?pathway_id=<?php echo $pathwayId ?>&section=${currentSectionNumber + 1}`;
        });
        

        // Add event listeners to all checkboxes
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", (event) => {

                nextBtn.disabled = false;
                checkboxes.forEach((checkbox) => {
                    if(!checkbox.checked){
                        nextBtn.disabled = true;
                        return;
                    }
                });                
                
                const parent = event.target.parentElement.parentElement;
                if(event.target.checked) {
                    parent.classList.add("done");
                    parent.classList.remove("not-done");
                    
                    // Send request to server saying checkbox was checked using POST request
                    if(isLoggedIn){
                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "notify-link-completion.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send(`action=checked&user_id=<?php echo $userId ?>&section_id=<?php echo $currentSection->section_id ?>&link_id=${parent.id.replace("link-box-", "")}`);
                    }
                    
                } else {
                    parent.classList.add("not-done");
                    parent.classList.remove("done");
                    
                    // Send request to server saying checkbox was unchecked using POST request
                    if(isLoggedIn){
                        const xhr = new XMLHttpRequest();
                        xhr.open("POST", "notify-link-completion.php", true);
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xhr.send(`action=unchecked&user_id=<?php echo $userId ?>&section_id=<?php echo $currentSection->section_id ?>&link_id=${parent.id.replace("link-box-", "")}`);
                    }
                }
                event.stopPropagation();
            });

            // Use mousedown on the checkbox to prevent the click event from reaching the parent. Hopefully solves the double click bug
            checkbox.addEventListener("mousedown", (event) => {
                event.stopPropagation();
            });
            
        });
        
        // Any click anywhere inside a .link-box will activate the checkbox
        const linkBoxes = document.querySelectorAll(".link-box");
        linkBoxes.forEach((linkBox) => {
            linkBox.addEventListener("mousedown", (event) => {
                event.preventDefault(); // RIP double-click bug. Hope you never return
                const checkbox = linkBox.querySelector(".completed-check");
                checkbox.checked = !checkbox.checked;
                checkbox.dispatchEvent(new Event("change"));
            });
        });
        
        // Clicking a link inside a .link-box will always make the checkbox checked
        const links = document.querySelectorAll(".link-box a");
        links.forEach((link) => {
            link.addEventListener("click", (event) => {
                event.stopPropagation();
                const checkbox = link.parentElement.querySelector(".completed-check");
                checkbox.checked = true;
                checkbox.dispatchEvent(new Event("change"));
            });
        });
    });
    
    
</script>

</body>
</html>