jQuery(document).ready(function($) {

    // if(window.location.pathname == '/carrinho' ){
    //     document.getElementById('cnpj').addEventListener('input', function (e) {
    //         var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,4})(\d{0,2})/);
    //         e.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + '.' + x[3] + '/' + x[4] + (x[5] ? '-' + x[5] : '');
    //     });
    // }
    $(".cep_company").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#company_endereco").val("...");
                $("#company_cidade").val("...");
                $("#company_estado").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#company_endereco").val(dados.logradouro);
                        $("#company_bairro").val(dados.bairro);
                        $("#company_cidade").val(dados.localidade);
                        $("#company_estado").val(dados.uf);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });

    $('form[name="company_store"]').submit(function(event){
        event.preventDefault()

        $.ajax({
            url: window.location.origin + $(this).attr('action'),
            type: 'post',
            dataType: 'json',
            data: $(this).serializeArray(),
            success: function(response){
                $('#exampleModal').modal('hide');
                if(!response.success)
                Swal.fire({
                    title: 'Atenção',
                    text: response.message,
                    icon: response.icon,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Não',
                }).then((result) => {

                    if(result.isConfirmed){
                        $('#exampleModal').modal('show');
                    }

                });

            }
    }).fail(function(jqXHR, textStatus){

        });
    });

});
