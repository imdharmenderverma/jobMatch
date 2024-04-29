$(document).ready(function () {
    $("#form-login").parsley();

    $("#form-login").on("submit", function (event) {
        event.preventDefault();
        $("#submit").attr("disabled", true);
        myButton.className = myButton.className + ' loading';
        if ($("#form-login").parsley().isValid()) {
            $.ajax({
                url: loginURL,
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function () {
                    $("#submit").val("Submitting...");
                },
                success: function (data) {
                    setTimeout(() => {
                        location.reload();
                        myButton.className = myButton.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                    }, 5000);
                },
                error: function (response) {
                    $('#email').val("");
                    $('#password').val("");
                    // $('#email_error').html("Email is Invalid");
                    // $('#password_error').html("Password is Invalid");
                    $("#submit").attr("disabled", false);
                    myButton.className = myButton.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                    toastr.error(response.responseJSON.message);
                },
            });
        } else {
            $("#submit").attr("disabled", false);
            return false;
        }
    });
});