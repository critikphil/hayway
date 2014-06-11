<?php

class NotificationController  extends Controller  {

    private $_Model;

    function  __construct( $_option, $_action )
    {
        $this->_Model  = new NotificationModel();
        $this->_View  = View::getInstanceCopy($_option, $_action, self::getOption(), self::getAction());
    }

    function success($message)
    {
        $this->_View->disableView();
        $_SESSION['params']['notification']['type'] = 'success';
        $_SESSION['params']['notification']['message'] = $message;
    }

    function error($message)
    {
        $this->_View->disableView();
        $_SESSION['params']['notification']['type'] = 'error';
        $_SESSION['params']['notification']['message'] = $message;
    }

    function info($message)
    {
        $this->_View->disableView();
        $_SESSION['params']['notification']['type'] = 'info';
        $_SESSION['params']['notification']['message'] = $message;
    }
    
    function display()
    {
        $this->_View->disableTemplate();
        
        if(!empty($_SESSION['params']['notification'])) {
            
            $this->_View->_notification['message']  = $_SESSION['params']['notification']['message'];
            $this->_View->_notification['type']     = $_SESSION['params']['notification']['type'];
            
            unset($_SESSION['params']['notification']);
        }
        else {
            
            $this->_View->disableView();
        }
    }
}
?>