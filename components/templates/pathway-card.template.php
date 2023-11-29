<style>
    <?php 
    require_once "assets/css/components/pathway-card.css"; //TODO: Change to relative path of index.php
    ?>    
</style>
<!--TODO: Remove this below and place it in main php/html pages-->
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

<div class="pathway-card">
    <div class="top">
        <img src="https://via.placeholder.com/150" alt="img">
        <button>...</button>
    </div>
    
    <a href="#" class="author"><img src="https://via.placeholder.com/64" alt="">#AUTHOR_NAME#'s</a>
    <div class="title">#TITLE#</div> 
    <div class="progress-control">
        <div class="progress">
            <div class="progress-bar" style="width: #PROGRESS_VALUE#%"></div>
        </div>
        <div class="progress-text">#PROGRESS_VALUE#%</div>
        <button> <i class="las la-play"></i> Continue</button>
    </div>
    <p class="description">
        #DESCRIPTION#
    </p>
    <div class="bottom">
        <button class="like-btn #LIKED_CLASS#"><i class="#LIKED_ICON#"></i> #LIKES_VALUE#</button>
<!--        <button class="like-btn"><i class="lar la-heart"></i> Like</button> -->
        <button class="share-btn"><i class="las la-share"></i> Share</button>
    </div>
</div>
