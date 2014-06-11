<?php

class Bootstrap
{
    function __construct() 
    {
        /*
        if(!Controller::loadModel('auth')->hasAuth(ADMIN))
        {
            header('Location:'.WEBSITE_PATH);
        }
         */
        $this->initView();
        $this->initComponents();
        $this->initExceptionTranslator();
        $this->auth();
    }
    
    function auth ()
    {
        $params = array('facebook' => true, 'e-mail' => true, 'redirect_uri' => CURRENT_PATH, 'registration' => false, 'necessary_auth' => 0);
        $auth = new Auth($params);
        $auth->checkUser();
    }
    
    function initView()
    {
        $View = View::getInstance(Controller::getOption(), Controller::getAction());
        $View->setMainTitle('Ton Site Internet');
        $View->addLink(PATH.'template/default/images/logo16x16.ico' , 'shortcut icon'   , 'image/x-icon', 'prepend');
        $View->addLink(PATH.'template/default/images/logo16x16.png' , 'icon'            , 'image/png'   , 'prepend');
        $View->addLink(PATH.'template/default/images/logo_apple.png', 'apple-touch-icon', 'image/png'   , 'prepend');
        
        $View->addMeta('width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no', 'viewport');
        $View->addMeta('Toulon, Var, France', 'geo.placename');

        //$View->addMeta('copyright', 'tonsiteinternet.fr');
        $View->addMeta('tonsiteinternet.fr',    'dcterms.rightsHolder');
        $View->addMeta('All Right Reserved',    'dcterms.rights');
        $View->addMeta('2013',                  'dcterms.dateCopyrighted');
        
        $View->addMeta('fr_FR',    null, 'og:locale');
        $View->addMeta(PATH,       null, 'og:url');
        $View->addMeta('article' , null, 'og:type');
        $View->addMeta('tonsiteinternet.fr', null, 'og:site_name');
        $View->addMeta(PATH.'template/default/images/logo.png' ,         null, 'og:image');
        $View->addMeta('tonsiteinternet.fr : Création de site internet', null, 'og:title');
        $View->addMeta('Spécialistes dans la création de site, nous vous proposons un site unique à votre image qui vous assurera une présence optimale sur internet', null, 'og:description');

        
        $View->addScript(MOTOR_PATH.'lib/js/jquery.cookie.js', '', 'prepend');
        $View->addScript(MOTOR_PATH.'lib/js/jquery.fullscreen-min.js', '', 'prepend');
        $View->addScript(MOTOR_PATH.'lib/js/jquery-ui-1.10.4.custom.min.js', '', 'prepend');
        $View->addScript(MOTOR_PATH.'lib/js/jquery-2.1.1.min.js', '', 'prepend');
        
        if(Utils::isMobile())
        {
            $View->addMeta('true', 'HandheldFriendly');
            $View->addMeta('true', 'apple-mobile-web-app-capable');
            $View->addMeta('yes' , 'apple-touch-fullscreen');
            $View->addLink(PATH.'template/default/css/mobile.css');
            //$View->addScript(MOTOR_PATH.'lib/js/jquery.mobile-1.3.2.min.js');
        }
        
        $View->addLink(PATH.'template/default/css/reset.css');
        $View->addLink(PATH.'template/default/css/style.css');
        $View->addLink(PATH.'template/default/css/responsive.css');
        $View->addLink(PATH.'template/default/css/fonts.css');
        
        $View->addScript(PATH.'template/default/js/script.js');
        
        if(Utils::isInternetExplorer())
        {
            //$View->setTemplateName('ie');
            $View->addLink(PATH.'template/default/css/ie.css');
        }
    }
    
    function initExceptionTranslator()
    {
        $translator = STranslator::getTranslator('exception');
        $translator->addTranslate('Le nom ou le mot de passe est incorrect', 700);
        $translator->addTranslate('Cet e-mail est déjà utilisé', 23000);
        
    }
    
    function initComponents()
    {
        Controller::initComponent('header');
        Controller::initComponent('notification');
        Controller::initComponent('footer');
        
    }
}

