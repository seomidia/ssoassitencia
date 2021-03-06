


function currencyFormatted(value, str_cifrao) {
    return str_cifrao + ' ' + value.formatMoney(2, ',', '.');
}

Number.prototype.formatMoney = function (c, d, t) {
    var n = this,
        c = isNaN(c = Math.abs(c)) ? 2 : c,
        d = d == undefined ? "." : d,
        t = t == undefined ? "," : t,
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

function addCart(){
    var prod = [];
    var table;
    var total = 0;
    $('input[type="checkbox"]:checked').each(function(){
        checked = $(this).val();
        prod.push(checked);
    });

    $.ajax({
        url: window.location.origin +'/json/getproduto',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            'id': prod
        },
        type:'post',
        dataType:'json',
        success: function (response) {
            $('table#cart').html('');
            table = '<tr><th>Exame</th><th>QTD</th><th>Valor</th></tr>';
            if(response.length == 0){
                table += '<tr><td colspan="3" style="text-align: center"> Não existe exames selecionados </td></tr>';
            }else{
                for (var i = 0; i < response.length;i++){
                    total = total + response[i].price;
                    table +='<tr><td>'+response[i].product_name+'</td><td>1x</td><td>'+currencyFormatted(response[i].price, 'R$')+'</td></tr>'
                }
            }
            table += '<tr><td colspan="2" style="text-align: right;padding: 5px 5px;font-weight: bold">TOTAL | </td><td style="padding: 5px 0px">'+currencyFormatted(total, 'R$')+'</td></tr>';
            table += '<tr><td colspan="2" style="padding-top: 10px;font-weight: bold"> <img src="//assets.pagseguro.com.br/ps-integration-assets/banners/pagamento/todos_animado_550_50.gif" alt="Logotipos de meios de pagamento do PagSeguro" title="Este site aceita pagamentos com as principais bandeiras e bancos, saldo em conta PagSeguro e boleto."> </td><td style="text-align: right;padding-right: 170px;padding-top: 15px"> <button class="btn btn-success" type="submit">Pagar agora</button> </td></tr>';

            $('table#cart').append(table);
        }
    });

}
jQuery(document).ready(function($){
    addCart();

    // criar sessão -----------------------------------
    if(Cookies.get('session_key')  == undefined)
        Cookies.set('session_key', Math.floor((Math.random() * 1000000000000000000) + 1)) ;


    $('#cart-update').click(function(){
        $(".update-card").trigger("click");
    })


    $('input[type="checkbox"]').click(function(){
        addCart();
    });

    $('form[name="exames-complementares"]').on('submit',function (event) {
        event.preventDefault();
        var text = 'Após a compra, encaminhe o exame para seu respectivo paciente!';


        Swal.fire({
            title: 'Atenção',
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não',
        }).then((result) => {
            if(result.isConfirmed){
                    Swal.fire({
                        title: 'Dados para Pagamento',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Finalizar',
                        cancelButtonText: 'Cancelar',
                        html:
                            '<input id="cep"   type="text"  class="form-control my-1" placeholder="Seu CEP">' +
                            '<input id="nome"  type="text"  class="form-control my-1" placeholder="Seu Nome">' +
                            '<input id="email" type="email" class="form-control my-1" placeholder="Seu E-mail">' +
                            '<input id="cpf"   type="text"  class="form-control my-1" placeholder="Seu CPF"> ' +
                            '<input id="tel"   type="tel"   class="form-control my-1" placeholder="Seu Telefone">' +
                            '<input id="nasc"  type="date"  class="form-control my-1" placeholder="Seu Nascimento">',
                        preConfirm: () => {
                            return [
                                document.getElementById('cep').value,
                                document.getElementById('nome').value,
                                document.getElementById('email').value,
                                document.getElementById('cpf').value,
                                document.getElementById('tel').value,
                                document.getElementById('nasc').value
                            ]
                        }
                    }).then((preConfirm) => {
                        console.log(preConfirm.value);
                        if(preConfirm.isConfirmed){
                            $.ajax({
                                url: window.location.origin + '/finalizar',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    'prod':$(this).serializeArray(),
                                    'comprador':preConfirm.value
                                },
                                type: 'post',
                                dataType: 'json',
                                success: function (response) {
                                    window.open (
                                        response,
                                        "_blank" );
                                    setTimeout(function (){
                                        window.location.href = '/obrigado';
                                    },2000);
                                }

                            }).fail(function (jqXHR, textStatus) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: jqXHR.responseJSON.message,
                                    // footer: '<a href>Why do I have this issue?</a>'
                                })
                            })
                        }
                    })
        }
    });

});

})
