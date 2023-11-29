<?php

const TITLE_PLACEHOLDER = "#TITLE#";
const DESCRIPTION_PLACEHOLDER = "#DESCRIPTION#";
const IMAGE_PLACEHOLDER = "https://via.placeholder.com/150";
const AUTHOR_NAME_PLACEHOLDER = "#AUTHOR_NAME#";
const AUTHOR_AVATAR_PLACEHOLDER = "https://via.placeholder.com/64";

const PROGRESS_PLACEHOLDER = "#PROGRESS_VALUE#";
const LIKES_PLACEHOLDER = "#LIKES_VALUE#";
const LIKED_PLACEHOLDER = "#LIKED_CLASS#";
const LIKED_CLASS = "liked";
const LIKED_ICON_CLASS = "las la-heart";
const NOT_LIKED_ICON_CLASS = "lar la-heart";

const LIKED_ICON_CLASS_PLACEHOLDER = "#LIKED_ICON#";


/*echo renderPathwayCard(
    "Pathway Title",
    "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.",
    "https://via.placeholder.com/150",
    "Author Name",
    "https://via.placeholder.com/64",
    50,
    100,
    true
);*/

function renderPathwayCard($title, $description, $image, $authorName, $authorAvatar, $progress, $likes, $liked)
{
    ob_start();
    include 'templates/pathway-card.template.php';
    $template = ob_get_clean();
    $template = str_replace(TITLE_PLACEHOLDER, $title, $template);
    $template = str_replace(DESCRIPTION_PLACEHOLDER, $description, $template);
    $template = str_replace(IMAGE_PLACEHOLDER, $image, $template);
    $template = str_replace(AUTHOR_NAME_PLACEHOLDER, $authorName, $template);
    $template = str_replace(AUTHOR_AVATAR_PLACEHOLDER, $authorAvatar, $template);
    $template = str_replace(PROGRESS_PLACEHOLDER, $progress, $template);
    $template = str_replace(LIKES_PLACEHOLDER, $likes, $template);
    $template = str_replace(LIKED_PLACEHOLDER, $liked ? LIKED_CLASS : "", $template);
    $template = str_replace(LIKED_ICON_CLASS_PLACEHOLDER, $liked ? LIKED_ICON_CLASS : NOT_LIKED_ICON_CLASS, $template);
    return $template;
}