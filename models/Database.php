<?php

require "utils/config.php";
require_once "models/User.php";
require_once "models/Pathway.php";
require_once "models/Section.php";
require_once "models/Link.php";

class Database
{

    private static $instance;
    /**
     * @var false|mysqli
     */
    private $conn;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
    
    public function __construct()
    {
        $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        if (!$this->conn) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    public function __destruct()
    {
        $this->conn->close();
    }

    /**
     * @param string $username
     * @return User|null
     */
    public function tryGetUser($username){
        $sql = "SELECT * FROM registered_users WHERE username = '$username'";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            return new User($row['user_id'],$row['username'], $row['password'], $row['display_name'], $row['profile_pic'], $row['registered_at']);
        }
        return null;
    }

    public function addUser($username, $password, $displayName)
    {
        $sql = "INSERT INTO registered_users (username, password, display_name) VALUES ('$username', '$password', '$displayName')";
        $result = $this->conn->query($sql);
        if($result){
            return true;
        }
        return false;
    }


    public function getUser($userId)
    {
        $sql = "SELECT * FROM registered_users WHERE user_id = '$userId'";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            return new User($row['user_id'],$row['username'], $row['password'], $row['display_name'], $row['profile_pic'], $row['registered_at']);
        }
        return null;
    }
    
    public function addPathway($userId, $pathwayName, $pathwayDescription, $pathwayImage)
    {
        $sql = "INSERT INTO pathways (owner_id, pathway_title, pathway_description, pathway_image) VALUES ('$userId', '$pathwayName', '$pathwayDescription', '$pathwayImage')";
        $result = $this->conn->query($sql);
        if($result){
            return true;
        }
        return false;
    }
    
    public function getPathway($userId, $pathwayId)
    {
        // TODO: Check if user has access to pathway
        $sql = "SELECT * FROM pathways WHERE pathway_id = '$pathwayId'";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            return new Pathway($row['pathway_id'], $row['owner_id'], $row['pathway_title'], $row['pathway_description'], $row['pathway_image'], $row['created_at']);
        }
        return null;
    }
    
    public function getOwnedPathways($ownerId)
    {
        $sql = "SELECT * FROM pathways WHERE owner_id = '$ownerId'";
        $result = $this->conn->query($sql);
        $pathways = array();
        while($row = $result->fetch_assoc()){

            $progress = $this->getProgress($ownerId, $row['pathway_id']);
            if($progress == null){
                $progress = 0;
            }
            $newPathway = new Pathway($row['pathway_id'], $row['owner_id'], $row['pathway_title'], $row['pathway_description'], $row['pathway_image'], $row['created_at']);
            $newPathway->setProgress($progress);

            array_push($pathways, $newPathway);

        }
        return $pathways;
    }
    
    public function getProgress($userId, $pathwayId)
    {
        // Progress is calculated by the number of sections completed divided by the total number of sections * 100
        $numSections = $this->getNumSections($pathwayId);
        if($numSections == 0){
            return null;
        }
        $numCompletedSections = $this->getNumCompletedSections($userId, $pathwayId);
        $value = round($numCompletedSections / $numSections * 100);
        if($value > 100){
            $value = 100;
        }
        if($numCompletedSections != $numSections && $value == 100){
            $value = 99;
        }
        return $value;
    }
    
    public function getSections($pathwayId)
    {
        // Assuming access to pathway
        // TODO: Make sure that assumption is correct
        
        $sql = "SELECT * FROM sections WHERE pathway = '$pathwayId' ORDER BY 'order' ASC";
        $result = $this->conn->query($sql);
        $sections = array();
        while($row = $result->fetch_assoc()){
            array_push($sections, new Section($row['id'], $row['pathway'], $row['title'], $row['description'], $row['order']));
        }
        return $sections;
    }
    
    public function getSection($pathwayId, $sectionNumber)
    {
        $sql = "SELECT * FROM sections WHERE pathway = '$pathwayId' AND `order` = '$sectionNumber'";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            return new Section($row['id'], $row['pathway'], $row['title'], $row['description'], $row['order']);
        }
        return null;
    }
    
    public function getLinks($sectionId, $userId = null)
    {
        if($userId == null)
            $sql = "SELECT section_links.id, section, url, text, `order`, '0' AS clicked FROM section_links WHERE section = '$sectionId' ORDER BY `order` ASC;";
        else
            $sql = "SELECT section_links.id, section, url, text, `order`, clicked FROM section_links JOIN link_clicks ON section_links.id = link_clicks.link WHERE section = '$sectionId' AND user = '$userId' ORDER BY `order` ASC;";
/*        $sql = "SELECT section_links.id, section, url, text, `order`, clicked FROM section_links JOIN link_clicks ON section_links.id = link_clicks.link WHERE section = '$sectionId' ORDER BY `order` ASC;";*/
        $result = $this->conn->query($sql);
        $links = array();
        while($row = $result->fetch_assoc()){
            array_push($links, new Link($row['id'], $row['section'], $row['url'], $row['text'], $row['order'], $row['clicked']));
        }
        return $links;
    }

    public function notifyLinkCompletion($userId, $linkId, $checked)
    {
        $sql = "SELECT * FROM link_clicks WHERE user = '$userId' AND link = '$linkId'";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            $sql = "UPDATE link_clicks SET clicked = '$checked' WHERE user = '$userId' AND link = '$linkId'";
            $result = $this->conn->query($sql);
            if($result){
                return true;
            }
            return false;
        } else {
            $sql = "INSERT INTO link_clicks (user, link, clicked) VALUES ('$userId', '$linkId', '$checked')";
            $result = $this->conn->query($sql);
            if($result){
                return true;
            }
            return false;
        }
    }

    public function linkExists($linkId, $sectionId)
    {
        $sql = "SELECT * FROM section_links WHERE id = '$linkId' AND section = '$sectionId'";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            return true;
        }
        return false;
    }
    
    public function getNumSections($pathwayId)
    {
        $sql = "SELECT COUNT(*) AS num_sections FROM sections WHERE pathway = '$pathwayId'";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['num_sections'];
    }
    
    public function getLastCompletedSection($userId, $pathwayId)
    {
        $sql = "SELECT MAX(sections.order) AS max_order FROM section_completes JOIN sections ON section_completes.section = sections.id JOIN pathways ON sections.pathway = pathways.pathway_id WHERE section_completes.user = $userId AND pathways.pathway_id = $pathwayId";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['max_order'];
    }
    
    public function completeSection($userId, $sectionId)
    {
        $sql = "SELECT * FROM section_completes WHERE user = '$userId' AND section = '$sectionId'";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            return true;
        } else {
            $sql = "INSERT INTO section_completes (user, section) VALUES ('$userId', '$sectionId')";
            $result = $this->conn->query($sql);
            if($result){
                return true;
            }
            return false;
        }
    }

    public function getNumCompletedSections($userId, $pathwayId)
    {
        $sql = "SELECT COUNT(*) AS num_completed_sections FROM section_completes JOIN sections ON section_completes.section = sections.id JOIN pathways ON sections.pathway = pathways.pathway_id WHERE section_completes.user = $userId AND pathways.pathway_id = $pathwayId";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['num_completed_sections'];
    }

    public function getPathwayId($ownerId, $pathwayTitle, $pathwayDescription, $pathwayImage)
    {
        $sql = "SELECT pathway_id AS id FROM pathways WHERE owner_id = '$ownerId' AND pathway_title = '$pathwayTitle' AND pathway_description = '$pathwayDescription' AND pathway_image = '$pathwayImage' ORDER BY created_at DESC LIMIT 1";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['id'];
    }

    public function updatePathwayImage(mixed $pathwayId, string $pathwayImage)
    {
        $sql = "UPDATE pathways SET pathway_image = '$pathwayImage' WHERE pathway_id = '$pathwayId'";
        $result = $this->conn->query($sql);
        if($result){
            return true;
        }
        return false;
    }
    
    public function updatePathwayTitle($pathwayId, $newTitle)
    {
        $sql = "UPDATE pathways SET pathway_title = '$newTitle' WHERE pathway_id = '$pathwayId'";
        $result = $this->conn->query($sql);
        if($result){
            return true;
        }
        return false;
    }

    public function isOwner($userId, $pathwayId)
    {
        $sql = "SELECT * FROM pathways WHERE owner_id = '$userId' AND pathway_id = '$pathwayId'";
        $result = $this->conn->query($sql);
        if($result->num_rows == 1){
            return true;
        }
        return false;
    }

}