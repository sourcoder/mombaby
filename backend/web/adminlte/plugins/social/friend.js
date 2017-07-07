/**
 * Created by xq on 16-8-6.
 */

        // To make Pace works on Ajax calls
$(function(){
    /*var folllow = function(id){
        alert('result');
        $.ajax({url: '/social/friend/create',
            data:'id='+id,
            success: function(result){
                alert('result');
            }});
    };*/
    $('.follow').click(function() {
        var id = $(this).attr('data-user');


        $.ajax({
            url: '/social/friend/follow',
            data: 'id=' + id,
            //type:'json',
            dataType: "json",
            success: function (result) {

                //alert(result['name']);
                followButton(result);
            }
        });
    });

    var followButton =function(result){
        if(result['status']=='success'){
            var btn = $('.follow');

            if(result['name']=='followed'){

                btn.attr('class','follow btn btn-defualt btn-block');
                btn.text('已关注');
            }else if(result['name']=='follow'){
                btn.attr('class','follow btn btn-primary btn-block');
                btn.text('关注');
            }

        }

    }

});



