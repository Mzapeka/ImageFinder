/**
 * Created by Администратор on 19.11.15.
 */

$(document).ready(function(){
    $('.checkbox').click(function(){
        var id = $(this).data('id');
        var link = $('#' + id).find('.img-rounded').attr('src');
        //alert (id +" "+ link);
        $.post(
            'http://ImageFinder/main/writeImg',
            {'link': link,
            'imgId': id},
            function result(data){
                if (data == 'false'){
                    alert('error');
                }
            }
        )
            .error(function(){
                alert('Ошибка соединения. Данные не переданы');
            })
    })
})