
function openMenu(elem)
{
    $(elem).addClass('opening');
    $(elem).removeClass('closed');
    $('#header').animate({marginLeft:0}, 1000, 'easeOutExpo', function(){
        $(elem).removeClass('opening');
        $(elem).addClass('opened');
        $(this).on('mouseleave', function(){
            if($(elem).hasClass('opened')) {
                closeMenu(elem);
            }
        });
    });
    $('#main').animate({marginLeft:240}, 1000, 'easeOutExpo');
    $('#footer').animate({marginLeft:240}, 1000, 'easeOutExpo');
    $(elem).animate({marginLeft:240}, 1000, 'easeOutExpo');
}

function closeMenu(elem)
{
    $(elem).addClass('closing');
    $(elem).removeClass('opened');
    $('#header').animate({marginLeft:-240}, 1000, 'easeOutExpo', function(){
        $(elem).removeClass('closing');
        $(elem).addClass('closed');
    });
    $('#main').animate({marginLeft:0}, 1000, 'easeOutExpo');
    $('#footer').animate({marginLeft:0}, 1000, 'easeOutExpo');
    $(elem).animate({marginLeft:0}, 1000, 'easeOutExpo');
}

$(function(){
    
    $('#sidePanelToggle').on('click', function(){
        if($(this).hasClass('opening') || $(this).hasClass('closing')) {
            return false;
        }
        
        if($(this).hasClass('opened')) {
            closeMenu(this);
        }
        else {
            openMenu(this);
        }
    });
});