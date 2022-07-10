$('body').on('click', "a[href='#delete-btn']", function(e) {
    e.preventDefault();

    let id = $(this).closest('.product-card').attr(`id`);
    let src = $(this).closest('.product-card').find('img').attr('src')

    $.ajax({
        url: 'http://project/api/estate/delete.php',
        method: 'POST',
        dataType: 'JSON',
        data: {id: id, src: src},
    }).done(function(content){
        $('#' + id).parent().remove();
    });
});
