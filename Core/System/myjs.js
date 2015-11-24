/**
 * Created by Администратор on 19.11.15.
 */

$(document).ready(function(){
    $('.checkbox').click(function(){
        var id = $(this).data('id');
        var link = $('#' + id).find('.img-rounded').attr('src');
        //alert (id +" "+ link);
        $.post(
            //'http://imagecrawler.azurewebsites.net/main/writeImg',
            'http://imagefinder/main/writeImg',
            {'link': link,
            'imgId': id},
            function result(data){
                //alert(data);
                if (data == 'false'){
                    alert('error');
                }
            }
        )
            .error(function(){
                alert('Connection error. Data dosn\'t transfered');
            })
    })
})