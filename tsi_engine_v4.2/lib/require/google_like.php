<!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-href="<?=$pageUrl?>"  data-size="<?=$size?>" <?=!empty($annotation)?'data-annotation="'.$annotation.'"':''?> data-width="<?=$width?>"></div>

<!-- Place this tag after the last +1 button tag. -->
<script type="text/javascript">
  window.___gcfg = {lang: '<?=$lang?>'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
