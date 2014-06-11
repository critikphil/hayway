<?php

if(!file_exists(MOTOR_ABS_PATH.'lib/plugins/DBUser.php')) {
    throw new Exception('User class : Require DBUser class');
}
/**
 * User class
 *
 * @author nicolascramail
 */
class User{
    
    public function __construct( $_user ) {
        
        $this->createInstance($_user);
    }
    
    public static function getIdentity()
    {
        if(!empty($_SESSION['user'])) {
            return unserialize($_SESSION['user']);
        }
        return false;
    }
    
    public static function getUser( $_userId )
    {
        $DBUser = new DBUser();
        return new self($DBUser->getUser($_userId));
    }
    
    public static function getUserByMail( $_mail )
    {
        $DBUser = new DBUser();
        return new self($DBUser->getUserByMail($_mail));
    }
    
    public static function getUserByMailToken( $_mail, $_token )
    {
        $DBUser = new DBUser();
        return new self($DBUser->getUserByMailToken($_mail, $_token));
    }
    
    public static function getUserByMailPwd( $_mail, $_password )
    {
        $DBUser = new DBUser();
        return new self($DBUser->getUserByMailPwd($_mail, $_password));
    }
    
    public static function getUserByUserIdSessionId( $_userId, $_sessionId )
    {
        $DBUser = new DBUser();
        return new self($DBUser->getUserByUserIdSessionId($_userId, $_sessionId));
    }
    
    public static function getUserByFbId( $_userFbId, $_facebookRegistration )
    {
        $DBUser = new DBUser();
        
        if($_facebookRegistration)
        {
            return new self($DBUser->getUserByFbId($_userFbId));
        }
        else
        {
            return new self($DBUser->getUserActiveByFbId($_userFbId));
        }
    }
    
    public function disableSession( $_sessionId )
    {
        $DBUser = new DBUser();
        return $DBUser->disableSession($this->id, $_sessionId);
    }
    
    private function createInstance ( $user )
    {
        if(empty($user))
            throw new SException('User doesn\'t exist', 700);
        
        foreach ($user as $key=>$value)
        {
            $this->$key = $value;
        }
    }
    
    public function insert()
    {
        $DBUser = new DBUser();
        $userId = $DBUser->insertUser($this);
        if(!empty($userId)) {
            $this->id = $userId;
            return $this;
        }
        return false;
    }
    
    public function activate()
    {
        $DBUser = new DBUser();
        $DBUser->activate($this->id);
        $DBUser->createSession($this->id);
        $DBUser->cleanSession($this->id);
        $DBUser->updateLog($this->id);
        
        $_SESSION['user'] = serialize($this);
    }
    
    public function updateLog()
    {
        $DBUser = new DBUser();
        $DBUser->updateLog($this->id);
    }
        
    public function unactivate()
    {
        $DBUser = new DBUser();
        $DBUser->unactivate($this->id);
    }
    
    public function fbSync($fbid)
    {
        $DBUser = new DBUser();
        $DBUser->setFbId($this, $fbid);
    }

    public static function reload()
    {
        $_SESSION['user'] = serialize(self::getUser(self::getIdentity()->id));
    }
        
    public function isActive()
    {
        return $this->active;
    }
    
    function setToken($token)
    {
        $DBUser = new DBUser();
        $DBUser->setToken($this->id, $token);
    }
    
    function mailVerified()
    {
        $DBUser = new DBUser();
        $DBUser->mailVerified($this->id);
        $this->activate();
    }
    
    function setPassword( $_password )
    {
        $DBUser = new DBUser();
        return $DBUser->setPassword($this->id, $_password);
    }
    
    public static function hasIdentity()
    {
        return !empty($_SESSION['user']);
    }
    
    public function hasAuth($auth_necessary)
    {
        try {
            return ($auth_necessary <= intval($this->auth));
        }
        catch (SException $e) {
            return false;
        }
        
    }
}

?>
