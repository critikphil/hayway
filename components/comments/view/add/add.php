
<li class="comment">
    <img class="user_picture" src="<?=file_exists(COM_ABS_PATH.'../template/default/images/profile/'.Utils::hashStr($this->_user->id).'.png')?(PATH.'template/default/images/profile/'.Utils::hashStr($this->_user->id).'.png'):(!empty($this->_fbUserPicture)?$this->_fbUserPicture:PATH.'template/default/images/male50x50.png')?>" />
    <p class="user_name"><?=User::getIdentity()->first_name?> <?=User::getIdentity()->last_name?></p>
    <p class="content"><?=$this->_comment?></p>
    <a class="delete" href="<?=PATH?>comments/delete/?commentId=<?=$this->_commentId?>">Supprimer</a>
</li>