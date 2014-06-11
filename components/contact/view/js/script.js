
$(function(){
    
    $('#contact-form').on('submit', 'form', function(){
        if(verifForm(this)) {
            
            sendForm(this, 'json', function(data){
                
                addNotification(data.type, data.message)
                if(data.type == 'success') {
                    clearForm('#contact-form');
                }
            });
        }
        return false;
    });

});