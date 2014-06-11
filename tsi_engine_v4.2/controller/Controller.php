<?php

/**
 * principal Controller
 *
 * @author cartman
 */

class Controller {
    
    protected $_View;

    function  __construct( $_option, $_action = 'index' )
    {
        $modelName = $_option . 'Model';
        $this->_Model = new $modelName();
        $this->_View  = View::getInstance($_option, $_action);
    }
    
    public static function __init() {
        
        $option = self::getOption();
        $action = self::getAction();
        
        self::loadBootstrap();
        self::initComponent($option, $action);
        self::loadComponent($option, $action);
    }
    
    public static function loadBootstrap( ) {
        
        include_once ABS_PATH.'application/Bootstrap.php';
        new Bootstrap();
    }
    
    public static function initComponent( $_option, $_action = 'index' )
    {
        try 
        {
            defined(strtoupper($_option).'_ABS_PATH') or define(strtoupper($_option).'_ABS_PATH',ABS_PATH.'components/'.$_option.'/');
            defined(strtoupper($_option).'_PATH')     or define(strtoupper($_option).'_PATH',PATH.'components/'.$_option.'/');
            
            $View = View::getInstance(self::getOption(), self::getAction());
            
            //load bootstrap for recursive components inits
            if(file_exists(ABS_PATH.'components/'.$_option.'/bootstrap/bootstrap.php')) {
                require_once ABS_PATH.'components/'.$_option.'/bootstrap/bootstrap.php';
            }
            if(file_exists(ABS_PATH.'components/'.$_option.'/bootstrap/'.$_action.'.php')) {
                require_once ABS_PATH.'components/'.$_option.'/bootstrap/'.$_action.'.php';
            }
            
            //load all defaults srcipts and styles
            if(file_exists(ABS_PATH.'components/'.$_option.'/css/style.css')) {
                $View->addLink(PATH.'components/'.$_option.'/css/style.css');
            }
            elseif(file_exists(ABS_PATH.'components/'.$_option.'/view/css/style.css')) {
                $View->addLink(PATH.'components/'.$_option.'/view/css/style.css');
            }
            if(file_exists(ABS_PATH.'components/'.$_option.'/js/script.js'))
            {
                $View->addScript(PATH.'components/'.$_option.'/js/script.js');
            }
            elseif(file_exists(ABS_PATH.'components/'.$_option.'/view/js/script.js')) {
                $View->addScript(PATH.'components/'.$_option.'/view/js/script.js');
            }
            
            //load all specifics scripts and styles
            if(file_exists(ABS_PATH.'components/'.$_option.'/view/css/'.$_action.'.css')) {
                $View->addLink(PATH.'components/'.$_option.'/view/css/'.$_action.'.css');
            } 
            elseif(file_exists(ABS_PATH.'components/'.$_option.'/css/'.$_action.'.css')) {
                $View->addLink(PATH.'components/'.$_option.'/css/'.$_action.'.css');
            }
            if(file_exists(ABS_PATH.'components/'.$_option.'/view/js/'.$_action.'.js')) {
                $View->addScript(PATH.'components/'.$_option.'/view/js/'.$_action.'.js');
            }
            elseif(file_exists(ABS_PATH.'components/'.$_option.'/js/'.$_action.'.js')) {
                $View->addScript(PATH.'components/'.$_option.'/js/'.$_action.'.js');
            }
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
    }
    
    public static function loadComponent( $_option, $_action = 'index', $_params = array() )
    {
        try 
        {
            defined(strtoupper($_option).'_ABS_PATH') or define(strtoupper($_option).'_ABS_PATH',ABS_PATH.'components/'.$_option.'/');
            defined(strtoupper($_option).'_PATH')     or define(strtoupper($_option).'_PATH',PATH.'components/'.$_option.'/');

            if(file_exists(ABS_PATH.'components/'.$_option.'/controller/Controller.php'))
            {
                require_once(ABS_PATH.'components/'.$_option.'/controller/Controller.php');
                require_once(ABS_PATH.'components/'.$_option.'/model/Model.php');
                if(file_exists(ABS_PATH.'components/'.$_option.'/view/View.php')) {
                    require_once(ABS_PATH.'components/'.$_option.'/view/View.php');
                }
                
                $controlerName  = $_option . 'Controller';
                $controler = new $controlerName($_option, $_action);

                /*
                * if $params is empty, we try the ajax way
                */
                if(empty($_params))
                {
                    $_params = self::getVars('params', $_params);
                }

                if(!empty($_params))
                {
                    $_SESSION['params'][$_option][$_action] = $_params;
                }
                else
                {
                    if( !empty($_SESSION['params'][$_option][$_action]) )
                    {
                        $_params = $_SESSION['params'][$_option][$_action];
                    }
                }

                /*
                * we don't pass variable if $params don't exist for not to breack the default one
                */
                !empty($_params) ? $controler->$_action($_params) : $controler->$_action();

                $View = View::getInstance($_option, $_action);
                $View->display();
            }
            elseif(file_exists(ABS_PATH.'components/'.$_option.'/'.$_action.'.php'))
            {
                View::displayFile( $_option, $_action );
            }
            else
            {
                exit(ABS_PATH.'components/'.$_option.'/'.$_action.'.php');
                header('Location:'.BASE_PATH.'404.html');
            }
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
    }
    
    public static function loadComponentFile( $_option, $_action="index" )
    {
        try 
        {
            defined(strtoupper($_option).'_ABS_PATH') or define(strtoupper($_option).'_ABS_PATH',ABS_PATH.'components/'.$_option.'/');
            defined(strtoupper($_option).'_PATH')     or define(strtoupper($_option).'_PATH',PATH.'components/'.$_option.'/');
            
            View::displayFile( $_option, $_action="index");
            
            /*
             
                $View = View::getInstance($_option, $_action);
                if($template) {
                    $View->setTemplateName($template);
                }
                else {
                    $View->disableTemplate();
                }
                $View->displayFile();
             
            */
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }   
    }
    
    public static function loadController( $_option )
    {
        try 
        {
            defined(strtoupper($_option).'_ABS_PATH') or define(strtoupper($_option).'_ABS_PATH',ABS_PATH.'components/'.$_option.'/');
            defined(strtoupper($_option).'_PATH')     or define(strtoupper($_option).'_PATH',PATH.'components/'.$_option.'/');

            require_once(ABS_PATH.'components/'.$_option."/controller/Controller.php");
            require_once(ABS_PATH.'components/'.$_option."/model/Model.php");
            require_once(ABS_PATH.'components/'.$_option."/view/View.php");

            $controlerName  = $_option . 'Controller';
            return new $controlerName($_option);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
    }
    
    public static function loadModel( $_option )
    {
        try 
        {
            require_once(ABS_PATH.'components/'.$_option."/model/Model.php");

            $modelName = $_option.'Model';
            return new $modelName();
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
            return false;
        }
        return true;
    }
    
    /*
     * $return escape vars form POST or GET method
     */
    public static function getVars($_data, $_default = false, $_type = false) 
    {
        if ( isset($_REQUEST[$_data]) )
        {
            return self::escape($_REQUEST[$_data], $_default, $_type);
        }
        else 
        {
            return $_default;
        }
    }

    public static function escape($_data, $_default, $_type) 
    {
        if(is_array($_data))
        {
            $escapeArray = array();
            foreach($_data as $key=>$value)
            {
                $value = self::escape($value, $_default, $_type);
                $escapeArray[$key] = $value;
            }
            return $escapeArray;
        }
        else
        {
            //htmlentities after first trim
            if( $_type != 'html')
                $_data = trim((strip_tags($_data)));
            else
                $_data = trim((htmlentities($_data)));
            if (get_magic_quotes_gpc())
                    $_data = stripslashes($_data);
            if ( $_type == 'str')
                    $_data = mysql_real_escape_string($_data);
            return $_data;
        }
    }
    
    public static function hasEmptyValues($_content)
    {
        $emptyValues = 0;
        foreach ($_content as $value)
        {
            if(empty($value))
                ++$emptyValues;
        }
        
        return $emptyValues;
    }
    
    public static function setHtmlParams($_params)
    {
        return http_build_query(
                    array('params' => $_params)
                    , 'flags_'
               );
    }

    public static function getOption($_default = 'index')
    {
        return self::getVars('option', $_default);
    }	

    public static function getAction($_default = 'index')
    {
        return self::getVars("action", $_default);
    }

    public static function getMode($_default = false)
    {
        return self::getVars("mode", $_default);
    }

    public static function getLanguage($_default = false)
    {
        return self::getVars("lang", $_default);
    }
}
?>