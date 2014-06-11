
<h2 style="background-color: #EFEFEF;border: 1px solid #DFDFDF;font-size: 1em;font-weight: 300;margin: 0;padding: 2%;text-align: center;">Vous avez reçu un nouveau message de la part de <span style="font-weight: 400;text-decoration: underline;"><?=$this->_user->first_name?> <?=$this->_user->last_name?></span> :</h2>

<div style="">
    <div style="font-size: 0.8em;font-weight: 300;text-align: center;line-height: 1em;margin: 30px 0;">
        <p>REMOTE_ADDR : <?=$this->_userIp?></p>
        <a href="http://www.localiser-IP.com/?ip=<?=$this->_userIp?>">Localiser cette IP</a>
    </div>
    <p style="font-size: 1em;font-weight: 300;text-align: center;line-height: 1.5em;"><?=$this->_message?></p>
    <p style="font-size: 0.8em;font-weight: 300;text-align: center;line-height: 1.5em;">Pour y répondre, veuillez suivre ce lien : <a href="<?=PATH?>chatbox/"><?=PATH?>chatbox/</a></p>
</div>
