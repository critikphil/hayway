<? if(!empty($this->_success)): ?>
    <div class="message_success">
        <img alt="" src="<?=PATH?>template/default/images/msg_info.png" />
        <p><?=$this->_msg?></p>
    </div>
<? else: ?>
    <? if(!empty($this->_msg)): ?>
        <div class="message_err">
            <img alt="" src="<?=PATH?>template/default/images/msg_error.png" />
            <p><?=$this->_msg?></p>
        </div>
    <? endif; ?>
    <form method="post" action="/contact/send/">
        <div class="input_block half left">
            <label for="name">Votre Nom</label>
            <input id="name" class="text" name="name" type="text" placeholder="Votre nom" value="<?=!empty($this->_name)?$this->_name:''?>" />
        </div>
        <div class="input_block half right">
            <label for="mail">Votre e-Mail :*</label>
            <input id="mail" class="text mandatory" name="mail" type="email" placeholder="E-mail..." value="<?=!empty($this->_mail)?$this->_mail:''?>" />
        </div>
        <div class="input_block">
            <label for="message">Votre demande :*</label>
            <textarea id="message" class="mandatory" name="message" placeholder="Expliquez très précisément votre demande"><?=!empty($this->_message)?$this->_message:''?></textarea>
        </div>
        <input type="submit" class="button submit" value="Envoyer"/>
    </form>
<? endif; ?>