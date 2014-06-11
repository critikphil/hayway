<?php

class MailModel extends Model {

    function  __construct(){
        parent::__construct();
    }
    
    function newCustomerConnexion($_user)
    {
        $mailFrom   = MAIL_FROM;
        $nameFrom   = 'Service client ' . MAIL_NAME;
        $mailTo     = $_user->mail;
        $nameTo     = MAIL_NAME;
        $subject    = 'Notification de connexion à votre espace d\'administration';
        $body       = file_get_contents(PATH.'mail/newCustomerConnexion/?view=1&'.Controller::setHtmlParams(array('userIp'=>$_SERVER['REMOTE_ADDR'])));
        
        return $this->sendMail($mailTo, $nameTo, $subject, $body, $mailFrom, $nameFrom);
    }
    
    function sendContactMail($_nameFrom, $_mailFrom, $_subject, $_body)
    {
        $mailFrom   = $_mailFrom;
        $nameFrom   = $_nameFrom;
        $mailTo     = MAIL_FROM;
        $nameTo     = MAIL_NAME;
        $subject    = $_subject;
        $body       = file_get_contents(PATH.'mail/contact/?view=1&'.Controller::setHtmlParams(array('body'=>$_body, 'userIp'=>$_SERVER['REMOTE_ADDR'])));
        
        return $this->sendMail($mailTo, $nameTo, $subject, $body, $mailFrom, $nameFrom);
    }
    
    function sendMailConfimation($_mail, $_name, $_pwdId)
    {
        $mailFrom   = MAIL_FROM;
        $nameFrom   = MAIL_NAME;
        $mailTo     = $_mail;
        $nameTo     = $_name;
        $subject    = 'Bienvenue sur le site de '.DOM_NAME;
        $body       = file_get_contents(PATH.'mail/sendMailConfirmation/?view=1&'.Controller::setHtmlParams(array('mail'=>$_mail, 'token'=>$_pwdId)));
        
        return $this->sendMail($mailTo, $nameTo, $subject, $body, $mailFrom, $nameFrom);
    }
    
    function messageAdmin($_user)
    {
        $mailFrom   = MAIL_FROM;
        $nameFrom   = MAIL_NAME;
        $mailTo     = $_user->mail;
        $nameTo     = $_user->first_name . ' ' . $_user->last_name;
        $subject    = 'Nouveau message';
        $body       = file_get_contents(PATH.'mail/messageAdmin/?view=1&'.Controller::setHtmlParams(array('user_to'=>$_user->id)));
        
        return $this->sendMail($mailTo, $nameTo, $subject, $body, $mailFrom, $nameFrom);
    }
    
    function messageCustomer($_user, $_message)
    {
        $mailFrom   = $_user->mail;
        $nameFrom   = $_user->first_name . ' ' . $_user->last_name;
        $mailTo     = MAIL_FROM;
        $nameTo     = MAIL_NAME;
        $subject    = 'Nouveau message';
        $body       = file_get_contents(PATH.'mail/messageCustomer/?view=1&'.Controller::setHtmlParams(array('userIp'=>$_SERVER['REMOTE_ADDR'], 'message'=>$_message, 'user_from'=>$_user->id)));
        
        return $this->sendMail($mailTo, $nameTo, $subject, $body, $mailFrom, $nameFrom);
    }
    
    function forgotPassword($_user, $_pwdId)
    {
        $mailFrom   = MAIL_FROM;
        $nameFrom   = MAIL_NAME;
        $mailTo     = $_user->mail;
        $nameTo     = $_user->first_name . ' ' . $_user->last_name;
        $subject    = 'Réinitialisation du mot de passe';
        $body       = file_get_contents(PATH.'mail/forgotPassword/?view=1&'.Controller::setHtmlParams(array('user_to'=>$_user->id, 'token'=>$_pwdId)));

        $this->sendMail($mailTo, $nameTo, $subject, $body, $mailFrom, $nameFrom);
    } 
}
?>