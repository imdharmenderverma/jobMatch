$(document).ready(function() {
    $("#form-reset").parsley();
    $("#form-reset").on("submit", function(event) {
        event.preventDefault();
        $("#submit").attr("disabled", true);
        if ($("#form-reset").parsley().isValid()) {
            $.ajax({
                url: resetURL,
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $("#submit").val("Submitting...");
                },
                success: function(data) {
                    toastr.success(data.message,"",{timeOut: 10000});
                    setTimeout(() => {
                        window.location.href = loginURL;
                    }, 10000);
                },
                error: function(response) {
                    $("#submit").attr("disabled", false);
                    $("#confirm_password_invalid_error, #email_invalid_error").html('');
                    if (response.responseJSON.message == "The password Confirm Password does not match.") {
                        $("#confirm_password_invalid_error").html('<ul class="parsley-errors-list filled" id="parsley-id-5" aria-hidden="false"><li class="parsley-required">The Password Confirm Password does not match.</li></ul>');
                    }else if(response.responseJSON.message == "We can't find a user with that email address."){
                        $("#email_invalid_error").html('<ul class="parsley-errors-list filled" id="parsley-id-5" aria-hidden="false"><li class="parsley-required">Invalid Email.</li></ul>');
                    }
                    else{
                        toastr.error(response.responseJSON.message,"",{timeOut: 10000});
                    }
                },
            });
        } else {
            $("#submit").attr("disabled", false);
            return false;
        }
    });
});

$("#password_confirmation").on("keyup", function () {
    $("#confirm_password_invalid_error").html("");
});
$("#email").on("keyup", function () {
    $("#email_invalid_error").html("");
});