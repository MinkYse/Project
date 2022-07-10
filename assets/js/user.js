$('.login-btn').click(function (e){
    e.preventDefault()

    let username = $('input[name="uname"]').val()
    let password = $('input[name="psw"]').val()

    $.ajax({
        url: 'http://project/api/estate/login.php',
        type: 'POST',
        dataType: 'JSON',
        data: {
            username: username,
            password: password
        },
        success (data) {
           if (data.status) {
               document.location.href = '/index.php';
           } else {
               $(".hide").removeClass('hide').find('.msg').text(data.message);
           }
        }
    });
});