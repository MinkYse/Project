$( document ).ready(function() {
    hideElements()
    showEstate('DESC')
    $('select').on("change",function() {
        let val = $("select[name='sort'] option:selected").index();
        if (val === 0) {
            showEstate('DESC')
        } else {
            showEstate('ASC')
        }
    });
});

function hideElements() {
    if (session === 'true') {
        $(".hide").removeClass('hide');
    }
}

function showEstate(sort) {
    $.ajax({
        url: 'http://project/api/estate/read.php',
        method: 'POST',
        dataType: 'JSON',
        data: {
            filter: sort
        }
    }).done(function(content){
        if (!content) {
            return;
        }
        $('#cards').empty();
        content.records.forEach(function (item) {
            let i = `<div class="col-lg-4 col-sm-6 mb-3">
                <div class="product-card" id="${item.id}">
                    <div class="container product_edit d-flex justify-content-between hide">
                        <div class="edit">
                            <a class="delete-product" href="#edit-btn"><i class="fa-solid fa-pen"></i></i></a>
                        </div>
                        <div class="delete">
                            <a class="edit-btn" href="#delete-btn"><i class="fa-solid fa-trash-can"></i></a>
                        </div>
                    </div>
                    <div class="product-thumb">
                        <a href="#"><img src="${item.img_path}" alt="${item.name}"></a>
                    </div>
                    <div class="product-details">
                        <h4 class="item-name">${item.name}</h4>
                        <p class="item-description">${item.description}</p>
                        <div class="row">
                            <div class="col-4 street">
                                <p>Улица: ${item.street}</p>
                            </div>
                            <div class="col-4 house-number">
                                <p>Дом: ${item.house_number}</p>
                            </div>
                            <div class="col-4 apartment-number">
                                <p>Квартира: ${item.apartment_number}</p>
                            </div>
                        </div>
                        <div class="product-bottom d-flex justify-content-between">
                            <div class="product-price">
                                ${item.price} <i class="fa-solid fa-ruble-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
            $('#cards').append(i);
            hideElements()
        })
    });
}