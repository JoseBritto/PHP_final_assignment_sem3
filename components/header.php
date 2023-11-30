<?php


const TITLE_PLACEHOLDER = "#TITLE#";
const DISPLAY_NAME_PLACEHOLDER = "#DISPLAY_NAME#";
function getHeader($title, $is_logged_in, $display_name = "Guest"){
    ob_start();
    include 'templates/header.template.php';
    $template = ob_get_clean();
    $template = str_replace(TITLE_PLACEHOLDER, $title, $template);
    $template = str_replace(DISPLAY_NAME_PLACEHOLDER, $display_name, $template);
    return $template;
}