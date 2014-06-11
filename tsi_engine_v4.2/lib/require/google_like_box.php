<!-- Place this tag where you want the widget to render. -->
<div class="g-page" data-href="<?=$pageUrl?>" data-width="<?=$width?>" data-showtagline="<?=$tagline?'true':'false'?>" <?$layout == 'landscape' ? 'data-layout="landscape"' : ''?> data-rel="publisher"></div>

<!-- Place this tag after the last widget tag. -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
