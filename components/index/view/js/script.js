
var showTime = function(){
    var d = new Date();
    var localTime = d.getTime();
    var localOffset = d.getTimezoneOffset() * 60000;
    var utc = localTime + localOffset;
    var offsetARM = 4; //armenia timezone
    var newTime = utc + (3600000*offsetARM);
    var nd = new Date(newTime);

    $('#arm_clock').html((nd.getHours()<10?'0':'') + nd.getHours() + ' : ' + (nd.getMinutes()<10?'0':'') + nd.getMinutes())
};
    
$(function(){
    
    showTime();
    setInterval(function() {
        showTime();
    }, 30000);
});

