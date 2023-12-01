<?php


const TITLE_PLACEHOLDER = "#TITLE#";
const DISPLAY_NAME_PLACEHOLDER = "#DISPLAY_NAME#";

const HIDDEN_CLASS = "hidden";

const LOGGED_IN_HIDDEN_CLASS = "#LOGGED_IN_HIDDEN_CLASS#";
const LOGGED_OUT_HIDDEN_CLASS = "#LOGGED_OUT_HIDDEN_CLASS#";

function getHeader($title, $is_logged_in, $display_name = "Guest"){
    ob_start();
    include 'templates/header.template.php';
    $template = ob_get_clean();
    $template = str_replace(TITLE_PLACEHOLDER, $title, $template);
    $template = str_replace(DISPLAY_NAME_PLACEHOLDER, $display_name, $template);
    $template = str_replace(LOGGED_IN_HIDDEN_CLASS, $is_logged_in ? "" : HIDDEN_CLASS, $template);
    $template = str_replace(LOGGED_OUT_HIDDEN_CLASS, $is_logged_in ? HIDDEN_CLASS : "", $template);
    return $template;
}