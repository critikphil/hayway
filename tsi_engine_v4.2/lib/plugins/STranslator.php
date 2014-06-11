<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Translator
 *
 * @author nicolascramail
 */
class STranslator {
    
    private static $_instances = array();
    
    private function __construct() {}
    
    public static function getTranslator($_option)
    {
        if (empty(self::$_instances[$_option])) {
            self::$_instances[$_option] = new self();
            /*
             * charge localement la class
             */
            self::$_instances[$_option];
        }

        return self::$_instances[$_option];
    }
    
    public function addTranslate($_message, $_code)
    {
        $this->$_code = $_message;
    }
    
    public function getTranslate($_code)
    {
        return !empty($this->$_code) ? $this->$_code : false;
    }
}

?>
