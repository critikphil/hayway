<?php

class CommentsController extends Controller  {

    function index ()
    {
        $this->_View->disableTemplate();
        $this->_View->_achievementId = self::getVars('achievementId', 0);
        
        $this->_View->_comments = $this->_Model->getComments($this->_View->_achievementId);
        for ($i = 0; $i < count($this->_View->_comments); ++$i) {
            if(!empty($this->_View->_comments[$i]['user_fbid'])) {
                $this->_View->_comments[$i]['user_fb_picture'] = $this->_Model->getFbUserProfilePicture($this->_View->_comments[$i]['user_fbid']);
            }
        }
        
        $this->_View->_user = User::getIdentity();
        if(!empty($this->_View->_user->fbid)) {
            $this->_View->_fbUserPicture = $this->_Model->getFbUserProfilePicture($this->_View->_user->fbid);
        }
    }
    
    function preview ($params = array('achievementId'=>0))
    {
        $this->_View->disableTemplate();
        $this->_View->_achievementId = $params['achievementId'];
        
        $this->_View->_user = User::getIdentity();
        if(!empty($this->_View->_user->fbid)) {
            $this->_View->_fbUserPicture = $this->_Model->getFbUserProfilePicture($this->_View->_user->fbid);
        }
        $this->_View->_comments = $this->_Model->getComments($this->_View->_achievementId);
        for ($i = 0; $i < count($this->_View->_comments); ++$i) {
            if(!empty($this->_View->_comments[$i]['user_fbid'])) {
                $this->_View->_comments[$i]['user_fb_picture'] = $this->_Model->getFbUserProfilePicture($this->_View->_comments[$i]['user_fbid']);
            }
        }
    }
    
    function add ()
    {
        $this->_View->disableTemplate();
        $achievementId = self::getVars('achievementId', 0);
        $this->_View->_comment = self::getVars('content', false);
        try {
            if(User::hasIdentity()) {
                
                $this->_View->_user = User::getIdentity();
                if(!empty($this->_View->_comment) && !empty($achievementId)) {

                    $this->_View->_commentId = $this->_Model->insert('achievements_comments', array('achievement_id'=>$achievementId, 'user_id'=>$this->_View->_user->id, 'content'=>$this->_View->_comment));
                    self::loadComponent('notification', 'success', 'Votre commentaire à bien été sauvegardé');
                    
                    if(!empty($this->_View->_user->fbid)) {
                        $this->_View->_fbUserPicture = $this->_Model->getFbUserProfilePicture($this->_View->_user->fbid);
                    }
                }
                else {
                    throw new Exception('Vous devez remplir tous les champs');
                }
            }
            else {
                throw new Exception('Vous devez être connecté pour rédiger un commentaire');
            }
        }
        catch (Exception $e) {
            self::loadComponent('notification', 'error', $e->getMessage());
            exit();
        }
    }
    
    function update ()
    {
        $this->_View->disableView();
        $commentId = self::getVars('commentId', 0);
        $comment = self::getVars('comment', false);
        try {
            if(User::hasIdentity()) {
                if(!empty($comment) && !empty($commentId)) {

                    $this->_Model->update('achievements_comments', array('content'=>$comment), array('id'=>$commentId, 'user_id'=>User::getIdentity()->id));
                    self::loadComponent('notification', 'success', 'Votre commentaire à bien été mis à jour');
                    exit(json_encode(array('success'=>true)));
                }
                throw new Exception('Une erreur s\'est produite, merci de réessayer');
            }
            else {
                throw new Exception('Vous devez être connecté pour mettre à jour un commentaire');
            }
        }
        catch (Exception $e) {
            self::loadComponent('notification', 'error', $e->getMessage());
            exit(json_encode(array('success'=>false)));
        }
    }
    
    function delete ()
    {
        $this->_View->disableView();
        $commentId = self::getVars('commentId', 0);
        try {
            if(User::hasIdentity()) {
                if(!empty($commentId)) {

                    $this->_Model->delete('achievements_comments', array('id'=>$commentId, 'user_id'=>User::getIdentity()->id));
                    self::loadComponent('notification', 'success', 'Votre commentaire à bien été supprimé');
                    exit(json_encode(array('success'=>true)));
                }
                throw new Exception('Une erreur s\'est produite, merci de réessayer');
            }
            else {
                throw new Exception('Vous devez être connecté pour supprimer un commentaire');
            }
        }
        catch (Exception $e) {
            self::loadComponent('notification', 'error', $e->getMessage());
            exit(json_encode(array('success'=>false)));
        }
    }
}
?>