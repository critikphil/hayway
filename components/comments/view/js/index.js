/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(function(){
    $('#comment_add_form').on('submit', function(){
        sendForm(this, 'text', function(data){
            $('#comments').append(data);
            $('#comments').find('.info').remove();
            clearForm('#comment_add_form');
        })
        return false;
    })
    
    $('#comments').on('click', '.delete', function(){
        if(confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')) {
            var $comment = $(this).parent();
            ajaxLink(this, 'json', function(data){
                if(data.success) {
                    $comment.remove();
                }
            })
        }
        return false;
    })
});