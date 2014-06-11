<?php

if(!file_exists(MOTOR_ABS_PATH.'lib/plugins/User.php')) {
    throw new Exception('Auth class : Require User class');
}

/*
 * Auth Class
 * 
 * define salt for passwords
 * define("SALT", "ANYTHING_YOU_WANT_AS_A_PASSWORD_KEY");
 * 
 */

class Auth {

    private $_params;
    private $_User;
    
    function  __construct( $_params = array('facebook' => true, 'e-mail' => true) ){
        
        $this->_params = $_params;
    }

    /*
     * Take the exception declared before and check if there is an exeption
     * 
     * $auth_exceptions   = array();
     * $auth_exceptions[] = array('option' => 'auth', 'action' => 'logout');
     * $auth_exceptions[] = array('option' => 'exemple', 'action' => 'exemple');
     * define('AUTH_EXCEPTIONS', serialize($auth_exceptions));
     */
    
    private function authException()
    {
        if(defined('AUTH_EXCEPTIONS'))
        {
            $exceptions = unserialize(AUTH_EXCEPTIONS);
            foreach ($exceptions as $exception)
            {
                if($exception['option'] == Controller::getOption() && ($exception['action'] == Controller::getAction() || $exception['action'] == 'all'))
                {
                    //case of true exception
                    return true;
                }
            }
        }
        return false;
    }
    
    /*
     * Check the user access
     * 
     * need to be call at the beggining of each page
     */
    
    function checkUser()
    {   
        if($this->authException())
        {
            /*
             * exception case
             */
            $option = Controller::getOption();
            $action = Controller::getAction();
            Controller::initComponent($option, $action);
            Controller::loadComponent($option, $action);
            exit();
        }
        
        if ( !User::hasIdentity() ) 
        {
            
            /*
             * CookieConnexion
             * 
             * if there is a cookie session active
             * we don't need to continue the end of the authentification
             */
            
            if($this->cookieAuth())
            {
                return true;
            }
            
            if(!empty($this->_params['facebook']))
            {
                /*
                 * FacebookConnexion
                 */
                if(Controller::getVars ("facebookRegistration", false))
                {
                    if($this->facebookAuth(true))
                    {
                        return true;
                    }
                }
                else 
                {
                    if($this->facebookAuth(false))
                    {
                        return true;
                    }
                }
            }
        }
        else
        {
            //active user
            return true;
        }
        //case of auth fail
        return false;
    }
    
    /*
     * Check the user form validation
     * 
     * need to be call at the beggining of each page
     */
    
    function checkUserValidation()
    {   
        if(!empty($this->_params['e-mail']))
        {
            /*
                * MailConnexion
                * 
                * if there the user is trying to log with email and if it fail
                * we need to check if there is a facebook active user for to take picture and name
                * but if the mail authentification is ok
                * we don't need to continue till the end
                */

            $mail       = Controller::getVars ("mail", false);
            $password   = Controller::getVars ("password", false);
            $rememberme = Controller::getVars ("rememberme", false);
            $token      = Controller::getVars ('token', false);

            if( !empty($mail) && (!empty($password) || !empty($token))) 
            {
                if($this->mailAuth($mail, $password, $rememberme, $token))
                {
                    return true;
                }
                else
                {
                    throw new SException('User doesn\'t exist', 700);
                }
            }
        }
            
        if(!empty($this->_params['facebook']))
        {
               /*
                * FacebookConnexion
                */

            if(Controller::getVars ("facebookRegistration", false))
            {
                if($this->facebookAuth(true))
                {
                    return true;
                }
                else
                {
                    throw new SException('User doesn\'t exist', 700);
                }
            }
        }
        //case of auth fail
        
    }
    
    private function cookieAuth()
    {
        $CookieManager = new CookieManager();
        $sessionId = $CookieManager->getCookieValue('act');
        $userId = $CookieManager->getCookieValue('cono');
        if(!empty($sessionId) && !empty($userId))
        {
            try {
                //mail password auth
                $this->_User = User::getUserByUserIdSessionId($userId, $sessionId);
                $this->_User->disableSession($sessionId);
                session_regenerate_id(true);
                $this->_User->activate();
                $this->setCookieSession();
                return true;
            }
            catch (SException $e) {
                
                return false;
            }
        }
        return false;
    }
    
    private function mailAuth($mail, $password, $rememberme, $token)
    {
        if(!empty($password))
        {
            try {
                //mail password auth
                $this->_User = User::getUserByMailPwd($mail, $password);
                session_regenerate_id(true);
                $this->_User->activate();
        
                if($rememberme)
                {
                    $this->setCookieSession();
                }
                return true;
            }
            catch (SException $e)
            {
                return false;
            }
        }
        else
        {
            try {
                //mail password auth
                $this->_User = User::getUserByMailToken($mail, $token);
                session_regenerate_id(true);
                $this->_User->activate();
        
                $this->setCookieSession();
                return true;
            }
            catch (SException $e)
            {
                return false;
            }
        }
    }
    
    private function facebookAuth($facebookRegistration)
    {
        $Model = new Model();
        $userFbId = $Model->getFbUser();
        if ( !empty($userFbId) ) 
        {
            try {
                //mail password auth
                $this->_User = User::getUserByFbId($userFbId, $facebookRegistration);
                session_regenerate_id(true);
                $this->_User->activate();
                
                $this->setCookieSession();
                return true;
            }
            catch (SException $e)
            {
                return false;
            }
        }
        return false;
    }
    
    /*
     * User registration
     */
    
    function registration(array $_user = array() )
    {   
        try {
            $this->_User = new User( $_user );
            $this->_User = $this->_User->insert();
            if(!empty($this->_User)) {
                $this->setCookieSession();
            }
            return $this->_User;
        }
        catch (SException $e) {
            throw $e;
        }
        
    }
    
    /*
     * Logout
     * 
     * Logout of all sessions facebook and mail actives
     * 
     * Params :
     *      facebook     : to force the loggout on facebook even if the user is not synchronized
     *      redirect_uri : the redirection after the logout by the user
     */
    
    public static function logout()
    {	
        if(!empty($_SESSION['user']))
        {
            $User = User::getIdentity();
            $CookieManager = new CookieManager();
            $sessionId = $CookieManager->getCookieValue('act');
            $User->disableSession($sessionId);
            $User->unactivate();
            session_destroy();
            setcookie('act', '', 0, '/', '.'.DOM_NAME);
            setcookie('cono', '', 0, '/', '.'.DOM_NAME);
            unset($_SESSION['user']);
        }
    }
    
    /*
     * @param auth necessary
     * @return true if the user has auth
     */
    public static function hasAuth($auth_necessary)
    {
        try {
            return User::getIdentity()->hasAuth($auth_necessary);
        }
        catch (SException $e) {
            return false;
        }
        
    }
    
    private function setCookieSession()
    {
        $CookieManager = new CookieManager();
        $CookieManager->setCookie('act', session_id(), sha1($this->_User->id), time()+(60*60*24*30), '/', '.'.DOM_NAME);
        $CookieManager->setCookie('cono', $this->_User->id, sha1($this->_User->id), time()+(60*60*24*30), '/', '.'.DOM_NAME);
    }
}
?>