<?php

/*
 * Call this function to attempt to log in a user.
 * Returns true if successful, false otherwise.
 */
function login($username, $password)
{
    // TODO
    // 1. Check if username exists in database
    // 2. If it does, check if the password matches
    // 3. If it does, log in the user
    // 4. Return true if successful, false otherwise
    return false;
}

/*
 * Call this function to log out a user.
 * Returns true if successful, false otherwise.
 */
function logout($force = false){
    // TODO
    // 1. Check if user is logged in
    // 2. If they are, log them out
    // 3. Return true if successful, false otherwise
    return false;
}

/*
 * Call this function to check if a user is logged in.
 * Returns true if they are, false otherwise.
 */
function isLoggedIn(){
    // TODO
    // 1. Check if user is logged in
    // 2. Return true if they are, false otherwise
    return false;
}

/*
 * Call this function to get the username of the logged in user.
 * Returns the username if they are logged in, false otherwise.
 */
function getUsername(){
    // TODO
    // 1. Check if user is logged in
    // 2. If they are, return their username
    // 3. Return false otherwise
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
    // TODO
    // 1. Check if user is logged in
    // 2. If they are, return their display name
    // 3. Return false otherwise
    return false;
}


/*
 * Call this function to check if a username is valid.
 * Returns true if it is, false otherwise.
 */
function isValidExistingUsername($username)
{
    // TODO
    // 1. Check if username exists in database
    // 2. Return true if it does, false otherwise
    return false;
}


/*
 * Call this function to check if a new username is available.
 * Returns true if it is, false if its unavailable or invalid.
 */
function isValidNewUsername($username){
    // TODO
    // 1. Check if username is permitted
    // 2. Return false if it isn't
    // 3. Check if username exists in database
    // 4. Return false if it does, true otherwise
    return false;
}

/*
 * Call this function to check if a display name is valid.
 * Returns true if it is, false otherwise.
 */
function isValidDisplayName($displayName)
{
    // TODO
    // 1. Check if display name is permitted
    // 2. Return false if it isn't
    // 3. Return true otherwise
    return false;
}

// Password strength check should be done client-side

/*
 * Call this function to check if a password is valid.
 * Returns true if it is, false otherwise.
 */
function isValidPassword($password){
    // TODO
    // 1. Check if password is permitted
    // 2. Return false if it isn't
    // 3. Return true otherwise
    return false;
}

/*
 * Call this function to check if a password matches the user's password.
 * Returns true if it does, false otherwise.
 */
function isValidPasswordForUser($username, $password)
{
    // TODO
    // 1. Check if password matches the user's password
    // 2. Return true if it does, false otherwise
    return false;
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