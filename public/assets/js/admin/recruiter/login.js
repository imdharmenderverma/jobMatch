$(document).ready(function () {
    $("#form-login").parsley();
    $("#form-login").on("submit", function (event) {
        event.preventDefault();
        $("#submit").attr("disabled", true);
        if ($("#form-login").parsley().isValid()) {
            myButton.className = myButton.className + ' loading';
            $.ajax({
                url: loginURL,
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function () {
                    $("#submit").val("Submitting...");
                },
                success: function (data) {
                    if (data.success) {
                        toastr.success(data.message, "", { timeOut: 5000 });
                        setTimeout(() => {
                            window.location.href = dashboard;
                            myButton.className = myButton.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                        }, 5000);
                    } else {
                        toastr.error(data.message, "", { timeOut: 5000 });
                    }
                },
                error: function (response) {
                    $("#email").val("");
                    $("#password").val("");
                    myButton.className = myButton.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                    $("#submit").attr("disabled", false);
                    toastr.error(response.responseJSON.message);
                },
            });
        } else {
            $("#submit").attr("disabled", false);
            return false;
        }
    });
});

$("#email, #password").on("keyup", function () {
    $("#email_valid_error").html("");
    $("#password_valid_error").html("");
});
