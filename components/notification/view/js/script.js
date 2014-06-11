function displayNotification(data)
{
    $('body').append(data);
    $('body').find('.notification').fadeIn(500).delay(5000).fadeOut(2000);
    $('body').find('.notification').mouseenter(function(){
        $(this).stop( true, true ).show();
    });
    $('body').find('.notification').mouseleave(function(){
        $(this).stop( true, true ).delay(5000).fadeOut(2000);
    });
    $('body').find('.notification a.hide_button').click(function(){
        $(this).parent().stop( true, true ).fadeOut(500);
    });
}
   
function checkNotifications()
{
    var dataForm = 'mode=ajax';
    $.ajax({
            type     : "GET",
            dataType : 'text',
            url      : path + 'notification/display/',
            data     : dataForm,
            success  : function(data)
            {
                displayNotification(data);
            }
    });
}

function addNotification(type, message)
{
    var dataForm = 'mode=ajax';
    $.ajax({
            type     : "GET",
            dataType : 'text',
            url      : path + 'notification/'+type+'/?params='+message,
            data     : dataForm,
            success  : function(data)
            {
                checkNotifications(data);
            }
    });
}

$(function(){
    checkNotifications();
});

