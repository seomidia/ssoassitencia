
function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
};


if(window.location.pathname == '/admin/products/create'){
    jQuery('input[name="name"]').on('blur',function(){
        var slug = convertToSlug(jQuery('input[name="name"]').val());
        jQuery('input[name="slug"]').val(slug);
    });
}

