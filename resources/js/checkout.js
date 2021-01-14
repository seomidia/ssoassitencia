
jQuery(document).ready(function($) {

    $('#quem').on('change',function () {
       if($(this).val() == 'rh'){
           Swal.fire(
               'Atenção',
               'Para comprar como RH será necessario efetuar sei login no sistema.',
               'warning'
           ).then((result) => {
               window.location = window.location.origin + '/admin/login'
           });
       }
    });


    $( "#c_companyname" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
                url: window.location.origin + "/get-company",
                type: 'post',
                dataType: "json",
                data: {
                    '_token': document.querySelector('meta[name="csrf-token"]').content,
                    search: request.term
                },
                success: function( data ) {
                    response( data );

                    if(!data[0].success){
                        Swal.fire({
                            title: 'Atenção',
                            text: "Empresa não emcontrada, deseja cadastra-la?",
                            icon: 'warning',
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
                }
            });
        },
        select: function (event, ui) {
            // Set selection
            $(this).val(ui.item.label); // display the selected text
            // $('#selectuser_id').val(ui.item.value); // save selected id to input
            return false;
        }
    });

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#rua").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#uf").val("");
        $("#ibge").val("");
    }

    //Quando o campo cep perde o foco.
    $("#cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#endereco").val("...");
                $("#cidade").val("...");
                $("#uf").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#endereco").val(dados.logradouro +' - 12'+ dados.bairro);
                        $("#cidade").val(dados.localidade);
                        $("#uf").val(dados.uf);
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

    $('#c_create_account').click(function (){
        $('#create_an_account').removeClass('hidden');
        $('#create_an_account').addClass('block');
    });


})
