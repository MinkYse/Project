$('.create-btn').click(function(e) {
    e.preventDefault();

    let name = $('input[name="title"]').val();
    let description = $('textarea[name="description"]').val();
    let street = $('input[name="street"]').val();
    let house_number = $('input[name="house_number"]').val();
    let apartment_number = $('input[name="apartment_number"]').val();
    let price = $('input[name="price"]').val();

    let file_data = $('#img-path').prop('files')[0];
    let form_data = new FormData();

    form_data.append('file', file_data);
    form_data.append('name', name);
    form_data.append('description', description);
    form_data.append('street', street);
    form_data.append('house_number', house_number);
    form_data.append('apartment_number', apartment_number);
    form_data.append('price', price);

    $.ajax({
        url: 'http://project/api/estate/post.php',
        method: 'POST',
        contentType: false,
        processData: false,
        data: form_data,
    }).done(function(content){
        location.reload();
    });

})
