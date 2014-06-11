<?php

/**
 * principal view
 *
 * @author cartman
 */
class View {
    
    /*
     * @var Singleton
     * @access private
     * @static
     */
    
    protected $_option;
    protected $_action;
    
    protected $_template;
    
    protected $_activeView        = true;
    protected $_activeTemplate    = true;
    
    private $_headMainTitle;
    private $_headTitle;
    
    private $_headLinks    = array();
    private $_headMetas    = array();
    private $_headScripts  = array();
    
    private static $_instances = array();
    
    private function __construct() {
        
        $this->_template = ABS_PATH.'template/default/';
        $this->addScript(MOTOR_PATH.'lib/js/utils.js');
    }

    /*
     * Méthode qui crée l'unique instance de la classe
     * si elle n'existe pas encore puis la retourne.
     *
     * @param void
     * @return Singleton
     */
    
    public static function getInstance($_option, $_action = 'index')
    {
        
        if (empty(self::$_instances[$_option][$_action])) {
            try {
                self::getInstanceCurrentCopy($_option, $_action);
            }
            catch (Exception $e) {
                self::$_instances[$_option][$_action]['instance'] = new self();
            }
            
            /*
             * charge localement la class
             */
            self::$_instances[$_option][$_action]['instance']->setComponent($_option, $_action);
        }

        return self::$_instances[$_option][$_action]['instance'];
    }
    
    public static function getInstanceCurrentCopy($_option, $_action)
    {
        $_forCopyOption = Controller::getOption();
        $_forCopyAction = Controller::getAction();
        
        if (empty(self::$_instances[$_forCopyOption][$_forCopyAction])) {
            throw new Exception('Instance ['.$_forCopyOption.']['.$_forCopyAction.'] doesn\'t exist');
        }
        
        self::$_instances[$_option][$_action]['instance'] = clone self::$_instances[$_forCopyOption][$_forCopyAction]['instance'];
        self::$_instances[$_option][$_action]['instance']->setComponent($_option, $_action);
        
        return self::$_instances[$_option][$_action]['instance'];
    }
    
    public static function getInstanceCopy($_option, $_action, $_forCopyOption, $_forCopyAction)
    {
        
        if (empty(self::$_instances[$_forCopyOption][$_forCopyAction])) {
            throw new Exception('Instance ['.$_forCopyOption.']['.$_forCopyAction.'] doesn\'t exist');
        }
        
        self::$_instances[$_option][$_action]['instance'] = clone self::$_instances[$_forCopyOption][$_forCopyAction]['instance'];
        self::$_instances[$_option][$_action]['instance']->setComponent($_option, $_action);
        
        return self::$_instances[$_option][$_action]['instance'];
    }
    
    public function setComponent($_option, $_action)
    {
        $this->_option = $_option;
        $this->_action = $_action;
    }
    
    public function setOption($_option)
    {
        $this->_option = $_option;
    }
    
    public function setAction($_action)
    {
        $this->_action = $_action;
    }

    public function display()
    {
        if($this->_activeView)
        {
            if($this->_activeTemplate)
            {
                $this->loadTemplate();
            }
            else
            {
                $this->loadView();
            }
        }
    }
    
    public function loadView()
    {
        try 
        {
            require(ABS_PATH.'components/'.$this->_option.'/view/'.$this->_action.'/'.$this->_action.'.php');
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function loadTemplate()
    {
        try 
        {
            require_once($this->_template.'index.php');
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    public function setTemplate($_name)
    {
        $this->_template = $_name;
    }
    
    public function getTemplate()
    {
        return $this->_template;
    }
    
    public function disableTemplate()
    {
        $this->_activeTemplate = false;
    }
    
    public function hasActiveTemplate()
    {
        return $this->_activeTemplate;
    }
    
    public function disableView()
    {
        $this->_activeView = false;
    }
    
    public function hasActiveView()
    {
        return $this->_activeView;
    }
    
    public function setMainTitle($_mainTitle)
    {     
        $this->_headMainTitle = $_mainTitle;
    }
    
    public function setTitle($_title)
    {     
        $this->_headTitle = $_title;
    }
    
    public function getTitle()
    {
        if(!empty($this->_headMainTitle) && !empty($this->_headTitle))
            return '<title>'.$this->_headTitle.' - '.$this->_headMainTitle.'</title>';
        elseif($this->_headMainTitle)
            return '<title>'.$this->_headMainTitle.'</title>';
        else
            return '<title>'.$this->_headTitle.'</title>';
    }

    public function addMeta( $_content, $_name = null, $_property = null )
    {
        $this->_headMetas[$_name.$_property] = array('content'=>$_content, 'name'=>$_name, 'property'=>$_property);
    }
    
    public function getMetas()
    {    
        $metas = '';
        foreach ($this->_headMetas as $meta) {
            $metas .= '<meta' . (!empty($meta['name']) ? ' name="'.$meta['name'].'"' : '') . (!empty($meta['property']) ? ' property="'.$meta['property'].'"' : '') . ' content="'.$meta['content'].'" />';
        }
        return $metas;
    }
    
    public function addLink($_href, $_rel = 'stylesheet', $_type = 'text/css', $_position = 'append')
    {   
        if($_position == 'prepend')
        {
            array_unshift($this->_headLinks, array('href'=>$_href, 'rel'=>$_rel, 'type'=>$_type));
        }
        else
        {
            $this->_headLinks[$_href] = array('href'=>$_href, 'rel'=>$_rel, 'type'=>$_type);
        }
    }
    
    public function getLinks()
    {   
        $links = '';
        foreach ($this->_headLinks as $link)
        {
            $links .= '<link href="'.$link['href'].'" rel="'.$link['rel'].'" type="'.$link['type'].'" />';
        }
        
        return $links;
    }
   
    public function addScript( $_src, $_async = '', $_position = 'append' )
    {
        if($_position == 'prepend')
        {
            array_unshift($this->_headScripts, array('src'=>$_src, 'async'=>$_async));
        }   
        else
        {
            $this->_headScripts[$_src] = array('src'=>$_src, 'async'=>$_async);
        }
    }
    
    public function getScripts()
    {    
        $scripts = '';
        foreach ($this->_headScripts as $script)
        {
            $scripts .= '<script src="'.$script['src'].'" type="text/javascript" '.$script['async'].' ></script>';
        }
        
        return $scripts;
    }

    public static function displayFile( $_option, $_action="index" )
    {
        try 
        {
            require(ABS_PATH.'components/'.$_option.'/'.$_action.'.php');
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
    
    public static function addLinkAsync($_href)
    {
        echo '<script type="text/javascript" >loadLinkAsync(\''.$_href.'\');</script>';
    }
    
    public static function addLinksAsync( array $_hrefs )
    {
        echo '<script type="text/javascript" >loadLinksAsync('.json_encode($_hrefs).');</script>';
    }
    
    public static function addScriptAsync( $_src )
    {
        echo '<script type="text/javascript" >loadScriptAsync(\''.$_src.'\');</script>';
    }
    
    public static function addScriptsAsync( array $_src )
    {
        echo '<script type="text/javascript" >loadScriptsAsync('.json_encode($_src).');</script>';
    }
    
}

?>
