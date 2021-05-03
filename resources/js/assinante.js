$(document).ready(function (){
    $('form[name="login-assiante"]').submit(function(event){
        event.preventDefault();
        var url = window.location.origin +'/admin/login';
        $.post(url,$(this).serializeArray(),function(response){

            $('p#message').hide('slow');
            $('p#message').removeClass('alert-danger');
            $('p#message').addClass('alert-success');
            $('p#message').html('');
            $('p#message').append('Você esta sendo redirecionado para seu painel.');
            $('p#message').show('slow');



            if(response.tipo_user != 3){
                $('button[type="button"]').prop('disabled', false);
                $('#login-assinante').hide();
                $('#login-sucesso').show()
            }else{
                setTimeout(function (){
                    window.location.href = window.location.origin +'/admin/';
                },2000);
            }

        }).fail(function(jqXHR, textStatus){
            console.log(jqXHR.responseJSON.message);
            $('p#message').hide('slow');
            $('p#message').html('');
            $('p#message').append(jqXHR.responseJSON.message);
            $('p#message').show('slow');
        });
    })
})
