function loadScriptAsync(src)
{
    jQuery('<script/>', {
        src: src,
        type: 'text/javascript',
        async: true
    }).appendTo('head');
}

function loadScriptsAsync(srcArray)
{
    $.each(srcArray, function(key, src) {
        loadScriptAsync(src);
    });
}

function loadLinkAsync(href)
{
    jQuery('<link/>', {
        href: href,
        rel: 'stylesheet',
        type: 'text/css'
    }).appendTo('head');
}

function loadLinksAsync(hrefArray)
{
    $.each(hrefArray, function(key, href) {
        loadScriptAsync(href);
    });
}

function verifForm(form)
{
    $('span.error').remove();
    var error = 0;
    $(form).find('.mandatory').each(function(){
        if($(this).val() == '' || $(this).val() == 0)
        {
            ++error;
            //$(this).after('<span class="note error">Ce champ est vide !</span>');
            $(this).addClass('error');
        }
    });
    if(error) 
    {
        addNotification('error', 'Veuillez remplir tous les champs marqués d\'une étoile')
        return false;
    }
    else 
    {
        return true;
    }
}

function clearForm(ele) 
{
    $(ele).find(':input').each(function() {
        switch(this.type) 
        {
            case 'password':
            case 'email':
            case 'select-multiple':
            case 'select-one':
            case 'text':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
}

function sendForm(form, dataType, callback)
{
    if(verifForm(form)) {
        var url         = $(form).attr('action');
        var dataForm    = $(form).serialize()+'&mode=ajax';
        //var valForm     = $(form).find('textarea').val();
        //$(form).find('input.submit').hide();
        $.ajax({
                type     : "GET",
                dataType : dataType,
                url      : url,
                data     : dataForm,
                success  : function(data)
                {
                    //$(form).find('input.submit').show();
                    callback(data);
                    checkNotifications();
                }
        });
    }
}

function ajaxLink(link, dataType, callback)
{
    var url = $(link).attr('href');
    var dataForm = 'mode=ajax';
    $.ajax({
            type     : "GET",
            dataType : dataType,
            url      : url,
            data     : dataForm,
            success  : function(data)
            {
                callback(data);
                checkNotifications();
            }
    });
}

function ajaxUrl(url, dataType, callback)
{
    var dataForm = 'mode=ajax';
    $.ajax({
            type     : "GET",
            dataType : dataType,
            url      : url,
            data     : dataForm,
            success  : function(data)
            {
                callback(data);
                checkNotifications();
            }
    });
}

function animateTitle(message)
{
    if((typeof(activeAnimateTitle)!= 'undefined') && (activeAnimateTitle == 1)) {
        return false;
    }
    activeAnimateTitle = 1;
    var oldTitle = document.title;
    var msg = message;
    var timeoutId = setInterval(function() {
        document.title = document.title == msg ? oldTitle : msg;
    }, 1000);
    window.onmousemove = function() {
        clearInterval(timeoutId);
        activeAnimateTitle = 0;
        document.title = oldTitle;
        window.onmousemove = null;
    };
}

function showOverlay(data) {
    $('#content-overlay').html(data);
    $('#content-overlay').show('clip', 'easeOutExpo', 250);
    $('#overlay').fadeIn(250);
}

function hideOverlay() {
    $('#content-overlay').hide('clip', 'easeOutExpo', 250, function(){
        $('#content-overlay').html('');
    });
    $('#overlay').fadeOut(250);
}

$(function(){
    $('#overlay').on('click', function (e) {
        hideOverlay();
    });

    $('#content-overlay').on('click', function (e) {
        e.stopPropagation();
    });
});
