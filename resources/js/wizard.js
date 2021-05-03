$(document).ready(function(){
    // SmartWizard initialize
    $('#smartwizard').smartWizard({
        theme: 'arrows',
        lang: { // Language variables for button
            next: 'Proximo',
            previous: 'Voltar'
        }
    });

    // create pessoa ---------------------------------

    $('a#create_pessoa').on('click',function(event){
        event.preventDefault();
    });

    $('#search').on('keyup', function() {
        var pattern = $(this).val();
        $('.searchable-container .items').hide();
        $('.searchable-container .items').filter(function() {
            return $(this).text().match(new RegExp(pattern, 'i'));
        }).show();
    });

    // step serviços ----------------------------------------------
});




