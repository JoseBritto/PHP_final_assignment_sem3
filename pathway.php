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
    /*Header("Lo
    cation: login.php?redirect=".urlencode($_SERVER['REQUEST_URI']));
    exit();*/
}

$isEditMode = isset($_GET['edit']);
$editModeType = "none";
if($isEditMode){
    $editModeType = $_GET['edit'];
}

const TITLE_EDIT_MODE = "title";
const DESCRIPTION_EDIT_MODE = "description";
const LINK_EDIT_MODE = "link";

if($editModeType == TITLE_EDIT_MODE){
    if(isset($_POST['new_title'])){
        if(isset($_POST['action']) && ($_POST['action'] == "save")){
            $newTitle = $_POST['new_title'];
            if($newTitle != $pathwayTitle){
                $pathwayTitle = $newTitle;
                updatePathwayTitle($userId, $pathwayId, $newTitle);
            }
        }
        if(isset($_POST['action'])){
            $url = strtok($_SERVER['REQUEST_URI'], '?');
            Header("Location: $url?pathway_id=$pathwayId&section=$currentSectionNumber");
        }
        $editModeType = "none";
    }
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
        
        <?php if($pathway->pathway_image != null): ?>
            <img src="<?php echo $pathway->pathway_image ?>" alt="alt">
        <?php else: ?>
            <img src="assets/css/img/web-design.png" alt="alt">
        <?php endif; ?>
    </div>
    <div class="main-area">
        <?php if($editModeType == TITLE_EDIT_MODE): ?>
            <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="title-edit">
                <input type="hidden" name="pathway_id" value="<?php echo $pathwayId ?>">
                <input type="text" name="new_title" value="<?php echo $pathwayTitle ?>">
                <div class="buttons">
                    <button class="cancel-btn" type="submit" name="action" value="discard">Discard</button>
                    <button type="submit" name="action" value="save">Save</button>
                </div>
            </form>
        <?php else: ?>
        <div class="title">
            <h1><?php echo $pathwayTitle ?></h1>
            <?php if(isOwner($userId, $pathwayId)): ?>
                <button class="edit-btn" onclick="window.location.href = '<?php echo $_SERVER['REQUEST_URI'] ?>&edit=title'"> <i class="las la-edit"></i></button>
            <?php endif; ?>
        </div>
            <div class="progress-control">
                <div class="progress">
                    <div class="progress-bar" style="width: <?php echo getProgress($userId, $pathwayId) ?>%"></div>
                </div>
                <div class="progress-text"><?php echo getProgress($userId, $pathwayId) ?>%</div>
                <button class="cancel-btn"> <i class="las la-trash-alt"></i> Remove</button>
                <button class="fork-btn"> <i class="las la-code-branch"></i> Fork</button>
            </div>
        <?php endif; ?>
</section>

<hr>

<main>
    <section id="description">
        <?php
        $order = $currentSection->order;
        if(empty($order))
            $order = $currentSectionNumber;
        ?>
        <?php if($editModeType == DESCRIPTION_EDIT_MODE): ?>
            <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" class="description-edit">
                <input type="hidden" name="pathway_id" value="<?php echo $pathwayId ?>">
                <div class="section-title-edit">
                    <h2>Section <?php echo $order." -"?></h2>
                    <input type="text" name="new_section_title" value="<?php echo $currentSection->section_title ?>">
                </div>
                <textarea name="new_description" id="" cols="100" rows="50"><?php echo $currentSection->section_description ?></textarea>
                <div class="buttons">
                    <button class="cancel-btn" type="submit" name="action" value="discard">Discard</button>
                    <button type="submit" name="action" value="save">Save</button>
                </div>
            </form>
        <?php else: ?>
            <?php if(empty($currentSection)): ?>
                <h2>404 - Content Not Found!</h2>
                <p>The author hasn't provided any content for this section yet! <br>
                    While you wait, why not check out this cool cat pic that I found? <br>
                    <img class="random-cat-pic" src="https://api.thecatapi.com/v1/images/search?format=src" alt="A random cat pic" width="350">
                </p>
            <?php else: ?>
                <h2>Section <?php echo "$order - $currentSection->section_title"?></h2>
                <p> <?php echo $currentSection->section_description ?> </p>
            <?php endif; ?>
        <?php endif; ?>
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