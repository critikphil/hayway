<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=<?=GOOGLE_MAP_KEY?>&amp;sensor=false&amp;callback=googleMapInitialize"></script>
<script type="text/javascript">
    
    function googleMapInitialize() {
        var mapOptions = {
            zoom: <?=$zoom?>,
            center: new google.maps.LatLng(<?=$latitude?>, <?=$longitude?>),
            mapTypeId: google.maps.MapTypeId.<?=$type?>
        }
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        
        <? if($marker): ?>
            var marker = new google.maps.Marker({
                position: map.getCenter(),
                map: map
            });
            map.panTo(marker.getPosition());
        <? endif; ?>
    }

    function loadGoogleMapScript() {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "";
        document.body.appendChild(script);
    }

    $(function(){
    });
</script>


<div id="map-canvas" style="width: 100%; height: 100%"></div>