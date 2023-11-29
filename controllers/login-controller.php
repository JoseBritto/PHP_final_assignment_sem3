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
    return false;
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
    // 1. Check if username exists in database
    // 2. Return true if it does, false otherwise
    
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
    // 1. Check if username is permitted
    // 2. Return false if it isn't
    // 3. Check if username exists in database
    // 4. Return false if it does, true otherwise
    
    if(!isPermittedUsername($username)){
        return false;
    }
    
    return !isValidExistingUsername($username);
}

function isPermittedUsername($username)
{
    // TODO
    // 1. Check if username is permitted
    // 2. Return false if it isn't
    // 3. Return true otherwise
    return true;
}

/*
 * Call this function to check if a display name is valid.
 * Returns true if it is, false otherwise.
 */
function isValidDisplayName($displayName)
{
    return true;
}

// Password strength check should be done client-side

/*
 * Call this function to check if a password is valid.
 * Returns true if it is, false otherwise.
 */
function isValidPassword($password){
    // TODO: Add other password requirements
    if(empty($password)){
        return false;
    }
    return true;
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