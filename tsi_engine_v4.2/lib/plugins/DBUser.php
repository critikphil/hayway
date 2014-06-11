<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of db_user
 *
 * @author nicolascramail
 */
class DBUser extends Model{
    
    public function __construct() {
        parent::__construct();
        $this->_db->setTable('users');
    }
    
    public function getUser ($_id)
    {
        $query = "SELECT 
                                *
                        FROM 
                                users
                        WHERE 
                                users.id = :id
                    ";
        return $this->_db->doQueryOne($query, array('id' => $_id));
    }
    
    public function getUserByMail ($_mail)
    {
        $query = "SELECT 
                                *
                        FROM 
                                users
                        WHERE 
                                users.mail = :mail
                    ";
        return $this->_db->doQueryOne($query, array('mail' => $_mail));
    }
    
    public function getUserByMailToken ($_mail, $_token)
    {
        $query = "SELECT 
                                *
                        FROM 
                                users
                        WHERE 
                                users.mail = :mail
                        AND
                                pwd_token = :pwd_token
                    ";
        return $this->_db->doQueryOne($query, array('mail' => $_mail, 'pwd_token' => $_token));
    }
    
    public function getUserByMailPwd( $_mail, $_password )
    {
        $query = "SELECT 
                                *
                        FROM 
                                users
                        WHERE 
                                users.mail = :mail
                        AND
                                users.password = :password
                    ";
        return $this->_db->doQueryOne($query, array('mail' => $_mail, 'password' => $this->hashStr($_password)));
    }
    
    public function getUserByUserIdSessionId( $_userId, $_sessionId )
    {
        $query = "SELECT 
                                    users.*
                        FROM 
                                    users
                        JOIN
                                    sessions
                            ON
                                    sessions.user_id = users.id
                            AND
                                    sessions.session_id = :sessionId
                        WHERE
                                    users.id = :userId
                    ";
        return $this->_db->doQueryOne($query, array('sessionId' => $_sessionId, 'userId' => $_userId));
    }
    
    public function getUserActiveByFbId($_userFbId)
    {
        $query = "SELECT 
                                    *
                        FROM 
                                    users
                        WHERE 
                                    users.fbid = :userFbId
                        AND
                                    users.active = 1
                    ";
        return $this->_db->doQueryOne($query, array('userFbId' => $_userFbId));
    }
    
    public function getUserByFbId($_userFbId)
    {
        $query = "SELECT 
                                    *
                        FROM 
                                    users
                        WHERE 
                                    users.fbid = :userFbId
                    ";
        return $this->_db->doQueryOne($query, array('userFbId' => $_userFbId));
    }
    
    public function activate($_userId)
    {
        $query = "UPDATE 
                            users 
                    SET 
                            active = 1
                    WHERE 
                            id = :userId
                ";

        return $this->_db->doQuery($query, array('userId' => $_userId));
    }
    
    public function unactivate($_userId)
    {
        $query = "UPDATE 
                            users 
                    SET 
                            active = 0
                    WHERE 
                            id = :userId
                ";

        return $this->_db->doQuery($query, array('userId' => $_userId));
    }
    
    public function createSession($_userId)
    {
        try 
        {
            $query = "INSERT 
                            INTO 
                                    sessions (user_id, session_id, remote_addr, http_user_agent)
                            VALUES
                                    (:userId, :sessionId, :remote_addr, :http_user_agent)
                    ";
            return $this->_db->doQuery($query, array('userId' => $_userId, 'sessionId' => session_id(), 'remote_addr' => $_SERVER['REMOTE_ADDR'], 'http_user_agent' => $_SERVER['HTTP_USER_AGENT']));
        }
        catch (ErrorException $e)
        {
            echo $e->getMessage();
        }
    }
    
    public function disableSession($_userId, $_sessionId)
    {
        try {
            return $this->update('sessions', array('active'=>0), array('user_id'=>$_userId, 'session_id'=>$_sessionId));
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    public function cleanSession($_userId)
    {
        try {
            $query = "UPDATE 
                                sessions 
                        SET 
                                active = 0 
                        WHERE 
                                user_id = :userId
                        AND
                                remote_addr = :remote_addr
                        AND
                                http_user_agent = :http_user_agent
                        AND
                                session_id != :sessionId
                    ";

            return $this->_db->doQuery($query, array('userId' => $_userId, 'sessionId' => session_id(), 'remote_addr' => $_SERVER['REMOTE_ADDR'], 'http_user_agent' => $_SERVER['HTTP_USER_AGENT']));
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    public function hasActiveSession($_userId)
    {
        $query = "SELECT 
                                session_id 
                        FROM 
                                sessions
                        WHERE
                                user_id = :userId
                        AND
                                active = 1
                ";
        return $this->_db->doQueryColumn($query, array('userId' => $_userId));
    }
    
    public function updateLog( $_userId )
    {
        $query = "UPDATE 
                            users 
                    SET 
                            lastlog = NOW() 
                    WHERE 
                            id = :userId
                ";

        return $this->_db->doQuery($query, array('userId' => $_userId));
    }
    
    public function setToken($_userId, $_token)
    {
        $query = "UPDATE
                                users
                        SET
                                pwd_token = :token
                        WHERE
                                id = :userId
                    ";
        return $this->_db->doQuery($query, array('userId' => $_userId, 'token' => $_token));
    }
    
    public function mailVerified($_userId)
    {
        $query = "UPDATE
                                users
                        SET
                                verified = 1
                        WHERE
                                id = :userId
                    ";
        return $this->_db->doQuery($query, array('userId' => $_userId));
    }
    
    public function setPassword($_userId, $_password)
    {
        $query = "UPDATE
                                users
                        SET
                                password = :password
                        WHERE
                                id = :id
                    ";
        return $this->_db->doQuery($query, array('id' => $_userId, 'password' => Utils::hashStr($_password)));
    }
    
    public function insertUser( $_user )
    {
        $_user = get_object_vars($_user);
        return $this->_db->insert( $_user );
    }
    
    public function setFbId($user, $fbid)
    {
        $this->update('users', array('fbid'=>$fbid), array('id'=>$user->id));
    }
}

?>
