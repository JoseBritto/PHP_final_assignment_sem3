<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/reset-all.css">
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/components/pathway-card.css">
    
  <title>Home</title>
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
    <div class="grid-container">

        <?php
         include_once "components/pathway-card.php";
         /*for ($i = 0; $i < 12; $i++) {
             if($i == 2){
                 echo renderPathwayCard(
                     "Becoming a meme of the 21st century hahahhhahaha moreeeeeeeeeeeeeeeeeeee weeeeeeeeeeeeeeeeee nnnnnnnnnnnedddddddddddd more",
                        "There is nothing much to say about this pathway. It is just a meme.OR IS IT? We will never know. OH  MY GOOOOOOOOOOD IT KEEPS GOING!!!! Damn this is super looooooooooooooong",
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
         }*/
        require_once "models/Database.php";
        $db = Database::getInstance();
        $pathways = $db->getOwnedPathways(getUserId(getUsername()));
        $userId = getUserId(getUsername());
        if(empty($pathways)){
            echo "<h1 style='text-align: center'>You have not created any pathways yet</h1>";
        }
        foreach($pathways as $pathway){
            $lastSectionOrder = $db->getLastCompletedSection($userId, $pathway->pathway_id);
            $maxSectionOrder = $db->getNumSections($pathway->pathway_id);
            if($lastSectionOrder == $maxSectionOrder){
                $nextOrder = 1;
            }
            else{
                $nextOrder = $lastSectionOrder + 1;
            }
            echo renderPathwayCard(
                $pathway->pathway_title,
                $pathway->pathway_description,
                $pathway->pathway_image,
                getDisplayName(),
                null,
                $pathway->progress,
                0,
                false,
                0,
                0,
                false,
                "pathway.php?pathway_id=$pathway->pathway_id&section=$nextOrder"
            );
        }
        ?>
  </div>


 
</body>
</html>
