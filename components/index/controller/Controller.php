<?php

class IndexController  extends Controller  {

    function index()
    {
        $this->_View->setTitle('Création de site internet');
        $this->_View->addMeta('Création de site internet avec tonsiteinternet.fr. Spécialistes dans la création de site, nous vous proposons un site unique à votre image qui vous assurera une présence optimale sur internet', 'description');
        $this->_View->addMeta('création de site, creation de site, création site, creation site, création de site internet, creation de site internet, création site internet, creation site internet, ton site internet, tonsiteinternet, tonsiteinternet.fr', 'keywords');
        
        self::initComponent('slideshow', 'iosslider');
        self::initComponent('lastevents', 'previews');
        self::initComponent('weather', 'weatherslider');
    }
}
?>