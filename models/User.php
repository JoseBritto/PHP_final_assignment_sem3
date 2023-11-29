<?php
class User{
    
    //TODO: Connect directly to database instead of properties
    
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $displayName;
    /**
     * @var int
     */
    private $userId;
    /**
     * @var string
     */
    private $profilePic;
    /**
     * @var int: UNIX timestamp|false
     */
    private $registeredTimestamp;


    function __construct($userId, $username, $password, $displayName, $profilePic = NULL, $registeredAt = NULL){
        $this->username = $username;
        $this->password = $password;
        $this->displayName = $displayName;
        $this->userId = $userId;
        $this->profilePic = $profilePic;
        $this->registeredTimestamp = strtotime($registeredAt);
    }
    
    /**
     * @return string
     */
    public function getUsername(){
        return $this->username;
    }
    
    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }
    
    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }
    
    /**
     * @return string
     */
    public function getProfilePic()
    {
        return $this->profilePic;
    }
    
    /**
     * @return int|false
     */
    public function getRegisteredTimestamp()
    {
        return $this->registeredTimestamp;
    }
    
}