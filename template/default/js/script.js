
$(function(){
    $('#overlay').on('click', function (e) {
        $('#content-overlay').slideUp(500, function(){
            $('#content-overlay').html('');
        });
        $('#overlay').fadeOut(500);
    });

    $('#content-overlay').on('click', function (e) {
        e.stopPropagation();
    });
});

