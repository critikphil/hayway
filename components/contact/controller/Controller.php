<?php

class ContactController  extends Controller  {

    function index()
    {
        if(self::getMode()=='ajax') {
            $this->_View->disableTemplate();
        }
        
        $this->_View->setTitle('Contact');
        
        $this->_View->_subject = self::getVars('subject', false);
        
        switch ($this->_View->_subject) {
            
            case 'decouverte':
                
                $this->_View->addMeta('Faites vos premiers pas sur internet. Commandez notre pack découverte dès maintenant ou consultez-nous pour toutes demandes de renseignements supplémentaires', 'description');
                $this->_View->_subject      = 'Formulaire de commande<br />du Pack Découverte';
                $this->_View->_color        = 'rgba(145, 200, 241, 1)';
                $this->_View->_description  = 'N\'hésitez plus et lancez vous sur internet grâce à notre pack Découverte ! <br /> 
                                               Vous pourrez à tous moments changer votre offre sans frais supplémentaires';
                break;

            case 'activite':
                
                $this->_View->addMeta('Site administrable bien référencé. Commandez notre pack activité dès maintenant ou consultez-nous pour toutes demandes de renseignements supplémentaires', 'description');
                $this->_View->_subject      = 'Formulaire de commande<br />du Pack Activité';
                $this->_View->_color        = 'rgba(254, 183, 58, 1)';
                $this->_View->_description  = 'Commandez dès maintenant notre pack Activité ou demandez simplement des renseigments supplémentaires. <br /> 
                                               Site entièrement sur mesure, n\'hésitez pas à demander des dévis pour les préstations spéciales.';
                break;

            case 'vitrine':
                
                $this->_View->addMeta('Site vitrine professionnel. Commandez notre pack vitrine dès maintenant ou consultez-nous pour toutes demandes de renseignements supplémentaires', 'description');
                $this->_View->_subject      = 'Formulaire de commande<br />du Pack Vitrine';
                $this->_View->_color        = 'rgba(52, 142, 138, 1)';
                $this->_View->_description  = 'Commandez dès maintenant notre pack Vitrine ou demandez simplement des renseigments supplémentaires. <br /> 
                                               Site entièrement sur mesure, n\'hésitez pas à demander des dévis pour les préstations spéciales.';
                break;

            default:
                
                $this->_View->addMeta('Commandez ou demandez un devis gratuit pour votre projet. Nous garantissons une réponse rapide.', 'description');
                $this->_View->_subject      = 'Formulaire de contact';
                $this->_View->_description  = 'N\'hésitez pas à demander des renseignements supplémentaires auprès de nos équipes <br /> 
                                               et choisissez parmi <a href="'.PATH.'packages/">nos packs</a>, la solution qui vous correspond.';
                break;
        }
        $this->_View->addMeta('pack '.$this->_View->_subject.', contact, formulaire, mail, e-mail, ton site internet, tonsiteinternet, tonsiteinternet.fr', 'keywords');       
    }
    
    function form()
    {
        $this->_View->disableTemplate();
    }
    
    function send()
    {
        $mailFrom = $this->_View->_mail    = self::getVars('mail');
        $subject  = $this->_View->_subject = 'Envoyé depuis le formulaire tonsiteinternet.fr';
        $body     = $this->_View->_message = 'tonsite Contact-Page : '.self::getVars('message');
        
        if(!self::hasEmptyValues(array($this->_View->_mail, $this->_View->_subject, $this->_View->_message))) {
            $nameFrom = $this->_View->_name = self::getVars('name', 'John Doe');
            //echo 'MAIL_FROM='.MAIL_FROM .'MAIL_NAME='.MAIL_NAME .'$this->_View->_subject='.$this->_View->_subject .'$this->_View->_message='.$this->_View->_message.'$this->_View->_mail='.$this->_View->_mail. '$this->_View->_name='.$this->_View->_name;
            try {
                self::loadComponent('mail', 'contact', array('subject' => $subject, 'body' => $body, 'mailFrom' => $mailFrom, 'nameFrom' => $nameFrom));
                $notification = array('type'=>'success', 'message'=>'Votre message à bien été envoyé, il sera étudié dans les meilleurs délais');
            }
            catch (Exception $e) {
                $notification = array('type'=>'error', 'message'=>'Une erreur s\'est produite, veuillez verifier tous les champs et recommencer');
            }
        }
        else {
            $notification = array('type'=>'info', 'message'=>'Veuillez remplir tous les champs marqué d\'une étoile et recommencer');
        }
        
        if(self::getMode() == 'ajax') {
            exit(json_encode($notification));
        }
        else {
            self::loadComponent('notification', $notification['type'], $notification['message']);
            if($notification['type'] == 'success') {
                header('Location:'.PATH.'contact/');
            }
            $this->_View->setAction('index');
            $this->index();
        }
        
    }
}
?>