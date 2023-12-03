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
require_once "controllers/login-controller.php";
if(isLoggedIn()) {
    echo getHeader("Becoming a meme", true, getDisplayName());
} else {
    echo getHeader("Becoming a meme", false);
}
?>

<br>
<br>


<section id="top">
    <div class="image">
        <img src="assets/css/img/web-design.png" alt="alt">
    </div>
    <div class="main-area">
        <h1>Getting a job</h1>
        <div class="progress-control">
            <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
            </div>
            <div class="progress-text">50%</div>
            <button class="cancel-btn"> <i class="las la-trash-alt"></i> Remove</button>
        </div>
</section>

<hr>

<main>
    <section id="description">
        <h2>Section 1 - Lorem Ipsum</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, adipisci alias aliquid amet
            architecto asperiores atque autem blanditiis consequatur cumque cupiditate delectus deleniti dicta
            dignissimos dolor doloremque doloribus ducimus ea earum eius eligendi eos error esse est et eum
            exercitationem explicabo facere fugiat fugit harum hic id illum impedit in incidunt ipsa ipsum
            laboriosam laborum laudantium libero magnam magni maiores maxime minima minus molestiae mollitia
            necessitatibus nemo neque nihil nisi nobis non nostrum nulla numquam obcaecati odio officia officiis
            omnis optio pariatur perferendis perspiciatis placeat porro possimus praesentium provident quae quas
            quasi quia quibusdam quisquam quod quos ratione recusandae rem repellat repellendus reprehenderit
            repudiandae rerum saepe sapiente sequi similique sint sit soluta sunt suscipit tempora temporibus
            tenetur totam ullam unde ut vel veniam veritatis voluptas voluptate voluptatem voluptates voluptatum
            voluptatibus voluptatum.
        </p>
    </section>
    
    <section class="links">

        <div class="not-done link-box">
            <div class="checkbox">
                <input type="checkbox" class="completed-check">
            </div>
            <a href="https://youtube.com" target="_blank">
                <span>How to market yourself (video) <i class="las la-external-link-alt"></i> </span>
            </a>
        </div>
        
        <div class="not-done link-box">
            <div class="checkbox">
                <input type="checkbox" class="completed-check">
            </div>
            <a href="https://youtube.com" target="_blank">
                <span>How to market yourself <i class="las la-external-link-alt"></i> </span>
            </a>
        </div>
    </section>
    
    <section class="bottom">
        <div class="buttons">
            <button class="btn">
                Previous
            </button>
            <button class="btn">
                Next
            </button>
        </div>
    </section>
</main>


<script type="application/javascript">
    addEventListener("load", (event) => {
        
        let isLinkBoxBeingClicked = false;
        
        // Add event listeners to all checkboxes
        const checkboxes = document.querySelectorAll(".completed-check");
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", (event) => {
                const parent = event.target.parentElement.parentElement;
                if(event.target.checked) {
                    parent.classList.add("done");
                    parent.classList.remove("not-done");
                } else {
                    parent.classList.add("not-done");
                    parent.classList.remove("done");
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