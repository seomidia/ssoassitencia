jQuery(document).ready(function($) {
    $('#logout').click(function (event){
        event.preventDefault();
        var csrf = $("meta[name='csrf-token']").attr("content")
        $.ajax({
            url: window.location.origin +'/logout',
            data: { '_token': csrf },
            type: 'post',
            dataType: 'json',
            success: function(response){
                setTimeout(function (){
                    window.location.href = window.location.origin;
                },0);
            }
        }).fail(function (jqXHR, textStatus) {
            console.log(jqXHR.responseJSON.message);
        })
    })
})
