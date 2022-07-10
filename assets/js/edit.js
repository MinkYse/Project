$('body').on('click', "a[href='#edit-btn']", function(e) {
    e.preventDefault();

    let card = $(this).closest('.product-card');
    let id =  card.attr('id');
    let name = card.find('.item-name').text();
    let description = card.find('.item-description').text();
    let street = card.find('.street').text().split(':')[1].trim();
    let houseNumber = card.find('.house-number').text().split(':')[1].trim();
    let apartmentNumber = card.find('.apartment-number').text().split(':')[1].trim();
    let src = card.find('img').attr('src');
    let price = card.find('.product-price').text().trim().replace(/\s+/g, '');

    $('#editProduct').modal('show');
    $('#edited-title').val(name);
    $('#edited-description').val(description);
    $('#edited-street').val(street);
    $('#edited-apartment_number').val(apartmentNumber);
    $('#edited-house_number').val(houseNumber);
    $('#edited-price').val(price);

    $('.edited-btn').click(function(e) {
        e.preventDefault();

        let editedName = $('input[name="edited-title"]').val();
        let editedDescription = $('textarea[name="edited-description"]').val();
        let editedStreet = $('input[name="edited-street"]').val();
        let editedHouseNumber = $('input[name="edited-house_number"]').val();
        let editedApartmentNumber = $('input[name="edited-apartment_number"]').val();
        let editedPrice = $('input[name="edited-price"]').val();

        let file_data = $('#edited-img-path').prop('files')[0];
        if (file_data) {
            let form_data = new FormData();

            form_data.append('file', file_data);
            form_data.append('id', id);
            form_data.append('src', src)
            form_data.append('name', editedName);
            form_data.append('description', editedDescription);
            form_data.append('street', editedStreet);
            form_data.append('house_number', editedHouseNumber);
            form_data.append('apartment_number', editedApartmentNumber);
            form_data.append('price', editedPrice);

            $.ajax({
                url: 'http://project/api/estate/update.php',
                method: 'POST',
                contentType: false,
                processData: false,
                data: form_data,
            }).done(function(content){
                location.reload();
            });
        } else {
            $.ajax({
                url: 'http://project/api/estate/update.php',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                    name: editedName,
                    description: editedDescription,
                    street: editedStreet,
                    house_number: editedHouseNumber,
                    apartment_number: editedApartmentNumber,
                    price: editedPrice,
                    src: src
                },
            }).done(function(content){
                location.reload();
            });
        }
    });
});