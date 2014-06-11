

<ul id="comments">
    <? if(!empty($this->_comments)) : ?>
        <? foreach ($this->_comments as $comment) : ?>
            <li class="comment">
                <img class="user_picture" src="<?=file_exists(COM_ABS_PATH.'../template/default/images/profile/'.Utils::hashStr($comment['user_id']).'.png')?(PATH.'template/default/images/profile/'.Utils::hashStr($comment['user_id']).'.png'):(!empty($comment['user_fb_picture'])?$comment['user_fb_picture']:PATH.'template/default/images/male50x50.png')?>" />
                <p class="user_name"><?=$comment['first_name']?> <?=$comment['last_name']?></p>
                <p class="content"><?=$comment['content']?></p>
                <? if(User::getIdentity()->id == $comment['user_id']) : ?>
                    <a class="delete" href="<?=PATH?>comments/delete/?commentId=<?=$comment['id']?>">Supprimer</a>
                <? endif; ?>
            </li>
        <? endforeach; ?>
    <? else : ?>
        <li>
            <p class="info">Soyez le premier à rédiger un commentaire</p>
        </li>
    <? endif; ?>
</ul>
<div id="add_comment">
    <? if(User::hasIdentity()) : ?>
        <div class="user_block">
            <img class="user_picture" src="<?=file_exists(COM_ABS_PATH.'../template/default/images/profile/'.Utils::hashStr($this->_user->id).'.png')?(PATH.'template/default/images/profile/'.Utils::hashStr($this->_user->id).'.png'):(!empty($this->_fbUserPicture)?$this->_fbUserPicture:PATH.'template/default/images/male50x50.png')?>" />
            <p class="user_name"><?=$this->_user->first_name?> <?=$this->_user->last_name?></p>
        </div>
        <div class="comment_block">
            <form id="comment_add_form" action="<?=PATH?>comments/add/?achievementId=<?=$this->_achievementId?>" method="POST">
                <textarea name="content" placeholder="Ajouter un commentaire ..."></textarea>
                <input class="button submit" type="submit" />
            </form>
        </div>
    <? else : ?>
        <li class="comment">
            <img class="user_picture" src="<?=PATH.'template/default/images/male50x50.png'?>" />
            <p class="user_name">Bienvenue sur le site</p>
            <p class="content"><a class="info" href="<?=PATH?>users/login/?<?=Controller::setHtmlParams(array('facebook' => true, 'e-mail' => true, 'redirect_uri' => CURRENT_PATH.'#comments', 'registration' => true, 'necessary_auth' => USER));?>">Connectez-vous pour rédiger un commentaire</a></p>
        </li>
    <? endif; ?>
</div>