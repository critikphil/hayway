<?php

class MailController  extends Controller  {

    function  __construct( $_option, $_action )
    {
        parent::__construct($_option, $_action);
        $this->_View->setTemplate(MAIL_ABS_PATH.'template/');
    }

    function contact($params = array('subject' => 'sans-titre', 'body' => false, 'mailFrom' => false, 'nameFrom' => 'inconnu'))
    {
        
        if(empty($params['body'])) {
            throw new SException('Empty mail message', 788);
        }
        
        $this->_View->_body  = $params['body'];
            
        if(!self::getVars('view', false)) {
            
            if(empty($params['mailFrom'])) {
                throw new SException('Empty mail', 787);
            }
            
            $this->_View->disableView();
            $subject  = !empty($params['subject'])?$params['subject']:'sans-titre';
            $nameFrom = !empty($params['nameFrom'])?$params['nameFrom']:'inconnu';
            $mailFrom = $params['mailFrom'];
            
            $this->_Model->sendContactMail($nameFrom, $mailFrom, $subject, $this->_View->_body);
        }
        else {
            
            $this->_View->_userIp = $params['userIp'];
        }
    }
    
    function newCustomerConnexion ($params = array('userIp'=>'Unknown')){
        if(!self::getVars('view', false)) {
            $this->_View->disableView();
            $this->_Model->newCustomerConnexion(User::getIdentity());
        }
        else {
            $this->_View->_userIp = $params['userIp'];
        }
    }

    function messageAdmin($params = array('user_to'=>'Unknown'))
    {
        $this->_View->_user = User::getUser($params['user_to']);
        if(!self::getVars('view', false)) {
            $this->_View->disableView();
            $this->_Model->messageAdmin($this->_View->_user);
        }
    }

    function messageCustomer($params = array('user_from'=>'Unknown', 'message'=>'Unknown Message', 'userIp'=>'Unknown Ip'))
    {
        $this->_View->_user = User::getUser($params['user_from']);
        if(!self::getVars('view', false)) {
            $this->_View->disableView();
            $this->_Model->messageCustomer($this->_View->_user, $params['message']);
        }
        else {
            $this->_View->_message  = $params['message'];
            $this->_View->_userIp   = $params['userIp'];
        }
    }
    
    function sendMailConfirmation($params = array('user_name'=>'Unknown', 'mail'=>'niko_pacha@hotmail.fr', 'token'=>'valid_number'))
    {
        if(!self::getVars('view', false)) {
            $this->_View->disableView();
            $this->_Model->sendMailConfimation($params['mail'], $params['user_name'], $params['token']);
        }
        else {
            $this->_View->_mail = $params['mail'];
            $this->_View->_token = $params['token'];
        }
    }
    
    function forgotPassword($params = array('user_to'=>'1', 'token'=>'valid_token'))
    {
        $this->_View->_user = User::getUser($params['user_to']);
        if(!self::getVars('view', false)) {
            $this->_View->disableView();
            $this->_Model->forgotPassword($this->_View->_user, $params['token']);
        }
        else {
            $this->_View->_token = $params['token'];
        }
    }
}
?>