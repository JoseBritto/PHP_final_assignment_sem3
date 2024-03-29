<?php
require_once "models/Database.php";


function getPathway($userId, $pathwayId)
{
    return Database::getInstance()->getPathway($userId, $pathwayId);
}

function getProgress($userId, $pathwayId)
{
    $p = Database::getInstance()->getProgress($userId, $pathwayId);
    if($p == null){
        return 0;
    }
    return $p;
}

function getSections($pathwayId)
{
    return Database::getInstance()->getSections($pathwayId);
}

function getSection($pathwayId, $sectionNumber)
{
    return Database::getInstance()->getSection($pathwayId, $sectionNumber);
}

/**
 * @param $sectionId
 * @return Link[]
 */
function getLinks($sectionId, $userId = null)
{
    return Database::getInstance()->getLinks($sectionId, $userId);
}

function updatePathwayTitle($userId, $pathway, $newTitle)
{
    if(!isOwner($userId, $pathway)){
        return false;
    }
    return Database::getInstance()->updatePathwayTitle($pathway, $newTitle);
}

function isOwner($userId, $pathwayId)
{
    return Database::getInstance()->isOwner($userId, $pathwayId);
}
{
    
}
