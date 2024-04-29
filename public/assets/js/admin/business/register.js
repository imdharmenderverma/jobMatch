$(document).ready(function () {
    $("#form-register").parsley();

    $("#form-register").on("submit", function (event) {
        event.preventDefault();
        $("#submit").attr("disabled", true);

        if ($("#form-register").parsley().isValid()) {
            var valval = $('.state').val();
            if (valval == undefined) {
                myButtonReset.className = myButtonReset.className + ' loading';
            }
            else if (valval == 1) {
                myButtonTermOfUse.className = myButtonTermOfUse.className + ' loading';
            }
            else {
                myButtonV1.className = myButtonV1.className + ' loading';
            }
            $.ajax({
                url: registerURL,
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function () {
                    $("#submit").val("Submitting...");
                },
                success: function (data) {
                    if (data.success) {
                        $("#form-register")[0].reset();
                        $("#form-register").parsley().reset();
                        if (data.message != "") {
                            toastr.success(data.message, "", { timeOut: 10000 });
                            setTimeout(() => {
                                if (valval == undefined) {
                                    myButtonReset.className = myButtonReset.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                                }
                                else if (valval == 1) {
                                    myButtonTermOfUse.className = myButtonTermOfUse.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                                }
                                else {
                                    myButtonV1.className = myButtonV1.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                                }
                                window.location.href = nextURL
                            }, 10000);
                        } else {
                            window.location.href = nextURL;
                        }
                    } else {
                        toastr.error(data.message, "", { timeOut: 10000 });
                        setTimeout(() => {
                            window.location.href = redirectURL;
                        }, 10000);
                    }
                },
                error: function (response) {
                    $("#phone_error").html('');
                    $("#email_error").html('');
                    $("#confirm_password_error").html('');
                    if (
                        response.responseJSON.message ==
                        "This phone number already exists."
                    ) {
                        $("#phone_error").html(response.responseJSON.message);
                    } else if (
                        response.responseJSON.message ==
                        "This email already exists."
                    ) {
                        $("#email_error").html(response.responseJSON.message);
                    } else if (
                        response.responseJSON.message ==
                        "The password confirm password does not match."
                    ) {
                        $("#confirm_password_error").html(
                            response.responseJSON.message
                        );
                    } else {
                        toastr.error(response.responseJSON.message);
                    }

                    $("#submit").attr("disabled", false);
                },
            });
        } else {
            $("#submit").attr("disabled", false);
            return false;
        }
    });

    $("#business_name").keypress(function (e) {
        var charCode = e.which ? e.which : event.keyCode;
        if (!String.fromCharCode(charCode).match(/^[a-zA-Z !@#$%^&*()_+{}\[\]:;<>,.?~]+$/)) return false;
    });
    $("#trading_name").keypress(function (e) {
        var charCode = e.which ? e.which : event.keyCode;
        if (!String.fromCharCode(charCode).match(/^[a-zA-Z !@#$%^&*()_+{}\[\]:;<>,.?~]+$/)) return false;
    });
    $("#abn").keypress(function (e) {
        var charCode = e.which ? e.which : event.keyCode;
        if (!String.fromCharCode(charCode).match(/^[0-9]+$/)) return false;
    });
    $("#phone_number").keypress(function (event) {
        var charCode = event.which;
        if (
            charCode != 46 &&
            charCode > 31 &&
            (charCode < 48 || charCode > 57)
        ) {
            event.preventDefault();
        }
    });

    // $(document).ready(function () {
    //     $("#industry_id").select2({
    //         placeholder: "Select Industry",
    //         allowClear: true,
    //     });
    // });
});
