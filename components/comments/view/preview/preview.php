
<div class="comments">
    <h5><span class="fa fa-comments"></span>Avis et commentaires</h5>
    <ul>
        <? if(!empty($this->_comments)) : ?>
            <? foreach ($this->_comments as $comment) : ?>
                <li class="comment">
                    <img class="user_picture" src="<?=file_exists(COM_ABS_PATH.'../template/default/images/profile/'.Utils::hashStr($comment['user_id']).'.png')?(PATH.'template/default/images/profile/'.Utils::hashStr($comment['user_id']).'.png'):(!empty($comment['user_fb_picture'])?$comment['user_fb_picture']:PATH.'template/default/images/male50x50.png')?>" />
                    <p class="user_name"><?=$comment['first_name']?> <?=$comment['last_name']?></p>
                    <p class="content"><?=$comment['content']?></p>
                </li>
            <? endforeach; ?>
        <? else : ?>
            <li class="comment">
                <img class="user_picture" src="<?=file_exists(COM_ABS_PATH.'../template/default/images/profile/'.Utils::hashStr($this->_user->id).'.png')?(PATH.'template/default/images/profile/'.Utils::hashStr($this->_user->id).'.png'):(!empty($this->_fbUserPicture)?$this->_fbUserPicture:PATH.'template/default/images/male50x50.png')?>" />
                <p class="user_name">Soyez le premier à donner votre avis <br/> (rendez-vous sur la page de la réalisation en suivant lien ci-dessous)</p>
            </li>
        <? endif; ?>
    </ul>
</div>