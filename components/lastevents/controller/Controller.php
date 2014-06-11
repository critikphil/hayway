<?php

class LasteventsController  extends Controller  {

    function index()
    {
        $this->_View->setTitle('Les derniers événements en Arménie');
        $this->_View->addMeta('Tourisme', 'description');
        
    }
    
    function previews()
    {
        $this->_View->disableTemplate();
    }
}
?>