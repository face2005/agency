jQuery(document).ready(function ($) {

    // валидация 
    $("form[data-form-validate='true']").each(function () {
        $(this).validate({
            errorClass: "novalid",
            errorElement: "span",
            success: function (label) {
                label.addClass("valid");
            },
            errorPlacement: function (error, element) {
                error.appendTo($('#invalid'));
            }
        });

    })




    // полчаем токен от reCaptcha 
    grecaptcha.ready(function () {
        grecaptcha.execute('6LeS8ygmAAAAAHevT7-0kqokA8gd4n8e2pOxYnvI', { action: 'homepage' }).then(function (token) {
            console.log(token);
            document.getElementById('g-recaptcha-response').value = token;
        });
    });

    // обновляем токен от reCaptcha 
    $("[type='submit00']").on("click", function () {
        grecaptcha.execute('6LeS8ygmAAAAAHevT7-0kqokA8gd4n8e2pOxYnvI', { action: 'homepage' }).then(function (token) {
            console.log(token);
            document.getElementById('g-recaptcha-response').value = token;
        });
    });

    // выполняем обработку формы
    $("#ajax-contact-form").submit(function () {
        var str = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "contact.php",
            data: str,
            success: function (msg) {
                if (msg == 'OK') {
                    result = '<div class="notification_ok">Ваше сообщение было отправлено</div>';
                    $("#fields").hide();
                } else {
                    result = msg;
                    grecaptcha.execute('6LeS8ygmAAAAAHevT7-0kqokA8gd4n8e2pOxYnvI', { action: 'homepage' }).then(function (token) {
                        console.log(token);
                        document.getElementById('g-recaptcha-response').value = token;
                    });
                }
                $('#note').html(result);
            }
        });
        return false;
    });





});/* //jQuery(document).ready  */