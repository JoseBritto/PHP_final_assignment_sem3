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

const CONTINUE_BUTTON_TEXT = "Continue";
const CONTINUE_TEXT_PLACEHOLDER = "#CONTINUE_TEXT#";
const START_TEXT= "Start";
const RESTART_TEXT= "Restart";
const ENROLL_TEXT= "Enroll";
const PLAY_BUTTON_CLASS = "las la-play";
const PLAY_BUTTON_CLASS_PLACEHOLDER = "#PLAY_BUTTON_CLASS#";

const RESET_BUTTON_CLASS = "las la-redo-alt";
const ENROLL_BUTTON_CLASS = "las la-sign-in-alt";

const HIDDEN_CLASS = "hidden";
const HIDDEN_CLASS_PROGRESS_PLACEHOLDER = "#HIDDEN_CLASS_PROGRESS#";
const HIDDEN_CLASS_INFO_PLACEHOLDER = "#HIDDEN_CLASS_INFO_TEXT#";

const INFO_TEXT_PLACEHOLDER = "#INFO_TEXT#";

const URL_PLACEHOLDER = "#URL#";

/*
echo renderPathwayCard(
    "Pathway Title",
    "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.",
    "https://via.placeholder.com/150",
    "Author Name",
    "https://via.placeholder.com/64",
    0,
    100,
    true,
    5,
    12
);*/

function renderPathwayCard($title, $description, $image, $authorName, 
                           $authorAvatar, $progress, $likes, $liked, 
                           $numCourses, $numChapters, $enrolled, $url)
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
    $template = str_replace(URL_PLACEHOLDER, $url, $template);
    $template = str_replace(LIKED_ICON_CLASS_PLACEHOLDER, $liked ? LIKED_ICON_CLASS : NOT_LIKED_ICON_CLASS, $template);
    if($progress == 0){
        if($enrolled) {
            $template = str_replace(CONTINUE_TEXT_PLACEHOLDER, START_TEXT, $template);
            $template = str_replace(PLAY_BUTTON_CLASS_PLACEHOLDER, PLAY_BUTTON_CLASS, $template);
            $template = str_replace(HIDDEN_CLASS_PROGRESS_PLACEHOLDER, "", $template);
            $template = str_replace(HIDDEN_CLASS_INFO_PLACEHOLDER, HIDDEN_CLASS, $template);
        }else{
            $template = str_replace(CONTINUE_TEXT_PLACEHOLDER, ENROLL_TEXT, $template);
            $template = str_replace(PLAY_BUTTON_CLASS_PLACEHOLDER, ENROLL_BUTTON_CLASS, $template);
            $template = str_replace(HIDDEN_CLASS_PROGRESS_PLACEHOLDER, HIDDEN_CLASS, $template);
            $template = str_replace(HIDDEN_CLASS_INFO_PLACEHOLDER, "", $template);
            $template = str_replace(INFO_TEXT_PLACEHOLDER, "$numCourses Courses &bull; $numChapters Chapters", $template);
        }
    } else if ($progress < 100){
        $template = str_replace(CONTINUE_TEXT_PLACEHOLDER, CONTINUE_BUTTON_TEXT, $template);
        $template = str_replace(PLAY_BUTTON_CLASS_PLACEHOLDER, PLAY_BUTTON_CLASS, $template);
        $template = str_replace(HIDDEN_CLASS_PROGRESS_PLACEHOLDER, "", $template);
        $template = str_replace(HIDDEN_CLASS_INFO_PLACEHOLDER, HIDDEN_CLASS, $template);
    } else {
        $template = str_replace(CONTINUE_TEXT_PLACEHOLDER, RESTART_TEXT, $template);
        $template = str_replace(PLAY_BUTTON_CLASS_PLACEHOLDER, RESET_BUTTON_CLASS, $template);
        $template = str_replace(HIDDEN_CLASS_PROGRESS_PLACEHOLDER, "", $template);
        $template = str_replace(HIDDEN_CLASS_INFO_PLACEHOLDER, HIDDEN_CLASS, $template);
    }
    return $template;
}