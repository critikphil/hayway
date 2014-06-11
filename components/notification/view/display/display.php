<div class="notification" style="display: none;">
    <a class="hide_button" href="javascript:;">
        <img alt="close" src="<?=NOTIFICATION_PATH?>view/images/close.png" />
    </a>
    <img alt="<?=$this->_notification['type']?>" src="<?=NOTIFICATION_PATH?>view/images/msg_<?=$this->_notification['type']?>.png" />
    <p><?=$this->_notification['message']?></p>
</div>