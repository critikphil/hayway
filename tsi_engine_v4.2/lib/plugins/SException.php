<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * SException
 *
 * @author nicolascramail
 */
class SException extends Exception {
    
  public function __construct($message, $code = 0, Exception $previous = null) {

    // traitement personnalisé que vous voulez réaliser ...

    // assurez-vous que tout a été assigné proprement
    parent::__construct($message, (int)$code, $previous);
  }

  public function getTranslate() {
      $translator = STranslator::getTranslator('exception');
      $message = $translator->getTranslate($this->code);
      return !empty($message) ? $message : $this->message;
  }
}

?>
