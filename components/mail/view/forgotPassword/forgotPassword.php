

<h2 style="background-color: #EFEFEF;border: 1px solid #DFDFDF;font-size: 1em;font-weight: 300;margin: 0;padding: 2%;text-align: center;">La réinitialisation du mot de passe de votre compte a été récemment demandé.</h2>

<div style="">
    <h3 style="font-size: 1em;font-weight: 300;text-align: center;line-height: 1em;margin: 30px 0;">Pour continuer cette action, veuillez suivre ce lien : <a href="<?=PATH?>users/resetPassword/?mail=<?=$this->_user->mail?>&token=<?=$this->_token?>"><?=PATH?>users/resetPassword/?mail=<?=$this->_user->mail?>&token=<?=$this->_token?></a></h3>
    <p style="font-size: 0.8em;font-weight: 300;text-align: center;line-height: 1.5em;">Si vous ne souhaitez pas changer le Mot de passe ou si vous n'avez pas envoyé cette demande, merci d'ignorer ce message.</p>
</div> 
