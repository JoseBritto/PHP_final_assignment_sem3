<?php


echo "Link: " . $_POST['link_id']. "<br>" ;
echo "Section ID: " . $_POST['section_id'] . "<br>";
echo "User ID: " . $_POST['user_id'] . "<br>";
echo "Action: " . $_POST['action'] . "<br>";

/* Validate login status and user id using session variables */
session_start();
if(!isset($_SESSION['username'])){
    echo "Not logged in";
    exit();
}

/* Validate user id */
if(!is_numeric($_POST['user_id'])){
    echo "Invalid user id";
    exit();
}

/* Validate action */
if($_POST['action'] != "checked" && $_POST['action'] != "unchecked"){
    echo "Invalid action";
    exit();
}

/* Validate link id */
if(!is_numeric($_POST['link_id'])){
    echo "Invalid link id";
    exit();
}

/* Validate section id */
if(!is_numeric($_POST['section_id'])){
    echo "Invalid section id";
    exit();
}

/* Get user id, link id, and section id from POST request */
$userId = $_POST['user_id'];
$linkId = $_POST['link_id'];
$sectionId = $_POST['section_id'];

/* Update database */
require_once "models/Database.php";

$db = Database::getInstance();

// Check if link exists
if(!$db->linkExists($linkId, $sectionId)){
    echo "Link does not exist";
    exit();
}

// Check if user exists
if($db->getUser($userId) == null){
    echo "User does not exist";
    exit();
}

// Check if user is who they say they are
if($db->getUser($userId)->getUsername() != $_SESSION['username']){
    echo "User is not who they say they are";
    exit();
}

$db->notifyLinkCompletion($userId, $linkId, $_POST['action'] == "checked" ? 1 : 0);

echo "Success";