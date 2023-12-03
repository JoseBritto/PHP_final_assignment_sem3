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
<br>
<!--<div class="headleft">
  <nav class="leftnav">
    <h2 class="my_stuff">MY STUFF</h2>
    <ul>
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">Pathways</a></li>
      <li><a href="#">Badges</a></li>
    </ul>
    <h2 class="my_stuff">EXPLORE</h2>
    <ul>
      <li><a href="#">Job Offers</a></li>
    </ul>
  </nav>
  </div>

  
    <div class="mid_nav">
    <ul>
      <li><a href="#" class="all">All</a></li>
      <li><a href="#" class="in_progress">In progress</a></li>
      <li><a href="#" class="Finished">Finished</a></li>
    </ul>

      
    
    </div>
--> 
<div class="grid-container">
    <!-- Grid item 1 -->
    <!--<div class="pathway-card">
      <div class="dropdown">
        <button onclick="myFunction('dropdown1')" class="dropbtn">&vellip;</button>
        <div id="dropdown1" class="dropdown-content">
          <a href="#" class="completed">Completed</a>
          <a href="#" class="remove">Remove</a>
        </div>
      </div>
      <img src="https://ichef.bbci.co.uk/news/976/cpsprodpb/16620/production/_91408619_55df76d5-2245-41c1-8031-07a4da3f313f.jpg" alt="img">
      <h4>PATHWAY</h4>
      <h2>Getting a job</h2>
      <progress value="20" max="100"></progress>
      <div>
        <p> In a quaint town nestled between rolling hills, Sarah discovered an ancient bookshop that seemed untouched by time. Intrigued, she entered and found a mysterious tome bound in worn leather. As she opened it, the pages whispered forgotten tales of mystical lands, unveiling a world of enchantment and adventure she never imagined.</p>
      </div>
    </div>-->

        <?php
         include_once "components/pathway-card.php";
         for ($i = 0; $i < 12; $i++) {
             echo renderPathwayCard(
                 "Becoming a meme",
                 "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.",
                 "https://ichef.bbci.co.uk/news/976/cpsprodpb/16620/production/_91408619_55df76d5-2245-41c1-8031-07a4da3f313f.jpg",
                 "Pepe Frog",
                 "https://ui-avatars.com/api/?background=random&name=Pepe+Frog&rounded=true&size=64",
                  max(($i * 10 - 10), 0),
                 ($i + 5) * 120,
                 $i%4 == 0,
                 3,
                 17,
                 $i%2 == 0
             );
         }
        ?>
  </div>
  <!--<script>
    // Keep track of the currently open dropdown
    var openDropdown = null;

    function myFunction(id) {
      var dropdown = document.getElementById(id);
      if (openDropdown && openDropdown !== dropdown) {
        openDropdown.classList.remove('show');
      }

      dropdown.classList.toggle('show');
      openDropdown = dropdown;
    }

    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function (event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName('dropdown-content');
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    };
  </script>-->
</body>
</html>
