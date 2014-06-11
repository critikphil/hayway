<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '<?=FB_APPID?>', // App ID
            channelUrl : '<?=PATH?>', // Channel File
            status     : true, // check login status
            cookie     : true, // enable cookies to allow the server to access the session
            xfbml      : true  // parse XFBML
        });

    };

    // Load the SDK asynchronously
    (function(d){
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; js.async = true;
    js.src = "//connect.facebook.net/<?=$lang?>/all.js";
    ref.parentNode.insertBefore(js, ref);
    }(document));
</script>