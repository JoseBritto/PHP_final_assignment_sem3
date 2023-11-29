<?php
session_start(); // We need to start the session in order to access session variables
require_once "models/User.php";
require_once "models/Database.php";

/*
 * Call this function to log in a user.
 * Returns true if successful, false otherwise.
 */
function login($username, $password, $remember = false)
{
    // 1. Check if username exists in database
    // 2. If it does, check if the password matches
    // 3. If it does, log in the user
    // 4. Return true if successful, false otherwise
    $user = Database::getInstance()->tryGetUser($username);
    if($user == null){
        return false;
    }
    $storedPasswordHash = $user->getPassword();
    if (password_verify($password, $storedPasswordHash)) {
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['display_name'] = $user->getDisplayName();
        if($remember) {
            setcookie('username', $user->getUsername(), time() + (100 * 86400 * 30), "/"); // 100 * 86400 = 100 days
            setcookie('password', $storedPasswordHash, time() + (100 * 86400 * 30), "/");
        }
        return true;
    }
    return false;
}

/*
 * Call this function to log out a user.
 * Returns true if successful, false otherwise.
 */
function logout($force = false){
    if($force){
        unset($_SESSION['username']);
        unset($_SESSION['display_name']);
        unset($_COOKIE['username']);
        unset($_COOKIE['password']);
        return true;
    }
    
    if(isLoggedIn()){
        unset($_SESSION['username']);
        unset($_SESSION['display_name']);
        unset($_COOKIE['username']);
        unset($_COOKIE['password']);
        return true;
    }
    return false;
}

/*
 * Call this function to check if a user is logged in.
 * Returns true if they are, false otherwise.
 */
function isLoggedIn(){
    if(isset($_SESSION['username'])){
        return true;
    }
    return false;
}

/*
 * Call this function to get the username of the logged in user.
 * Returns the username if they are logged in, false otherwise.
 */
function getUsername(){
    // 1. Check if user is logged in
    // 2. If they are, return their username
    // 3. Return false otherwise
    
    if(isLoggedIn()){
        return $_SESSION['username'];
    }
    return false;
}

/*
 * Call this function to sign up a new user.
 * Returns true if successful, false otherwise.
 */
function signup($username, $password, $displayName)
{
    // TODO
    // 1. Check if username exists in database
    // 2. If it does, return false
    // 3. If it doesn't, create a new user
    // 4. Return true if successful, false otherwise
    if(!isValidNewUsername($username)){
        return false;
    }
    if(!isValidPassword($password)){
        return false;
    }
    if(!isValidDisplayName($displayName)){
        return false;
    }
    return Database::getInstance()->addUser($username, password_hash($password, PASSWORD_DEFAULT), $displayName);
}

/*
 * Call this function to get the display name of the logged in user.
 * Returns the display name if they are logged in, false otherwise.
 */
function getDisplayName()
{
    // 1. Check if user is logged in
    // 2. If they are, return their display name
    // 3. Return false otherwise
    if(isLoggedIn()){
        return $_SESSION['display_name'];
    }
    return false;
}


/*
 * Call this function to check if a username is valid.
 * Returns true if it is, false otherwise.
 */
function isValidExistingUsername($username)
{
    $user = Database::getInstance()->tryGetUser($username);
    if($user == null){
        return false;
    }
    return true;
}


/*
 * Call this function to check if a new username is available.
 * Returns true if it is, false if its unavailable or invalid.
 */
function isValidNewUsername($username){
    
    if(!isPermittedUsername($username)){
        return false;
    }
    
    return !isValidExistingUsername($username);
}

function isPermittedUsername($username)
{
    return getUsernameErrorMessage($username, false) == "";
}

function getUsernameErrorMessage($username, $checkExisting = true)
{
    if(empty($username)){
        return "Username cannot be empty";
    }
    if(strlen($username) > MAX_USERNAME_LENGTH){
        return "Username cannot be longer than " . MAX_USERNAME_LENGTH . " characters";
    }
    if(strlen($username) < MIN_USERNAME_LENGTH){
        return "Username cannot be shorter than " . MIN_USERNAME_LENGTH . " characters";
    }
    if(!preg_match(USERNAME_REGEX, $username)){
        return "Username can only contain lowercase letters, numbers and underscores";
    }
    if($checkExisting && isValidExistingUsername($username)){
        return "Username is already taken";
    }
    return "";
}

function getDisplayNameErrorMessage($displayName)
{
    if(empty($displayName)){
        return "Display name cannot be empty";
    }
    if(strlen($displayName) > MAX_DISPLAY_NAME_LENGTH){
        return "Display name cannot be longer than " . MAX_DISPLAY_NAME_LENGTH . " characters";
    }
    if(strlen($displayName) < MIN_DISPLAY_NAME_LENGTH){
        return "Display name cannot be shorter than " . MIN_DISPLAY_NAME_LENGTH . " characters";
    }
    if(!preg_match(DISPLAY_NAME_REGEX, $displayName)){
        return "Display name can only contain letters, numbers, underscores and spaces";
    }
    return "";
}

/*
 * Call this function to check if a display name is valid.
 * Returns true if it is, false otherwise.
 */
function isValidDisplayName($displayName)
{
    return getDisplayNameErrorMessage($displayName) == "";
}


function getPasswordErrorMessage($password)
{
    if(empty($password)){
        return "Password cannot be empty";
    }
    if(strlen($password) > MAX_PASSWORD_LENGTH){
        return "Password cannot be longer than " . MAX_PASSWORD_LENGTH . " characters";
    }
    if(strlen($password) < MIN_PASSWORD_LENGTH){
        return "Password cannot be shorter than " . MIN_PASSWORD_LENGTH . " characters";
    }
    return "";
}

/*
 * Call this function to check if a password is valid.
 * Returns true if it is, false otherwise.
 */
function isValidPassword($password){
    return getPasswordErrorMessage($password) == "";
}


/*
 * Call this function to check if logged-in user is an admin.
 * Returns true if they are, false otherwise.
 */
function isAdmin()
{
    // TODO
    // 1. Check if user is logged in
    // 2. If not, return false
    // 3. Check if user is an admin
    // 4. Return true if they are, false otherwise
    return false;
}