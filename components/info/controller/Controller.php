<?php

class InfoController  extends Controller  {

    function mentions()
    {
        $this->_View->setTitle('Mentions Légales');
        $this->_View->addMeta('Les mentions légales', 'description');
        $this->_View->addMeta('mentions, legales, mentions legales', 'keywords');
        
    }

    function plan()
    {
        $this->_View->setTitle('Plan du site');
        $this->_View->addMeta('Le plan du site', 'description');
        $this->_View->addMeta('plan, site, plan site, plan du site', 'keywords');
        
        $this->_View->_achievements = $this->_Model->selectAll('achievements', array('visible'=>1), array('id'=>'ASC'));
        $this->_View->_tutorials = $this->_Model->selectAll('tutorials', array('visible'=>1), array('id'=>'DESC'));
    }
}
?>