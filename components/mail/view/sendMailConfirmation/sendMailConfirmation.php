
<h2 style="background-color: #EFEFEF;border: 1px solid #DFDFDF;font-size: 1em;font-weight: 300;margin: 0;padding: 2%;text-align: center;">Bienvenue sur <?=DOM_NAME?></h2>

<div style="">
    <h3 style="font-size: 1em;font-weight: 300;text-align: center;line-height: 1em;margin: 30px 0;">Confirmez votre adresse Email :</h3>
    <p style="font-size: 1em;font-weight: 300;text-align: center;line-height: 1.5em;">Pour confirmer cette adresse mail, veuillez suivre ce lien : <br/><a href="<?=PATH?>users/confirmMail/?mail=<?=$this->_mail?>&token=<?=$this->_token?>"><?=PATH?>users/confirmMail/?mail=<?=$this->_mail?>&token=<?=$this->_token?></a></p>
    <p style="font-size: 0.8em;font-weight: 300;text-align: center;line-height: 1.5em;">Si vous n'avez pas envoyé cette demande, merci d'ignorer ce message.</p>
</div> 

