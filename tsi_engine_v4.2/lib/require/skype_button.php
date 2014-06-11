<?php
    if($call && $chat)
    {
        $action = 'Dropdown';
    }
    elseif($chat)
    {
        $action = 'Chat';
    }
    else
    {
        $action = 'Call';
    }
?>
<script type="text/javascript" src="<?=MOTOR_PATH . 'lib/js/skype-uri.js'?><?/*//www.skypeassets.com/i/scom/js/skype-uri.js*/?>"></script>
<div id="SkypeButton_<?=$action?>_<?=$skypeName?>_1" class="skype_button">
  <script type="text/javascript">
    Skype.ui({
      "name"        : "<?=strtolower($action)?>",
      "element"     : "SkypeButton_<?=$action?>_<?=$skypeName?>_1",
      "participants": ["<?=$skypeName?>"],
      "imageSize"   : <?=$imageSize?>
    });
  </script>
</div>