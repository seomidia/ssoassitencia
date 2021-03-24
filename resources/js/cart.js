jQuery(document).ready(function($){
    // criar sessão -----------------------------------
    if(Cookies.get('session_key')  == undefined)
        Cookies.set('session_key', Math.floor((Math.random() * 1000000000000000000) + 1)) ;


    $('#cart-update').click(function(){
        $(".update-card").trigger("click");
    })


    $('form[name="update-qtd"]').submit(function(event){
        event.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            type:'post',
            data: $(this).serializeArray(),
            dataType:'json',
            success: function (response) {
                window.location = window.location.origin + '/carrinho'
            }
        });
    })

})
