$(document).ready(function() {
    $("#forgot-form").parsley();
    $("#forgot-form").on("submit", function(event) {
        event.preventDefault();
        $("#submit").attr("disabled", true);
        if ($("#forgot-form").parsley().isValid()) {
            $.ajax({
                url: emailURL,
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $("#submit").val("Submitting...").attr("disabled", true);
                },
                success: function(data) {
                    if (data.success) {
                        toastr.success(data.message,"",{timeOut: 5000});
                        setTimeout(() => {
                        location.reload();
                    }, 5000);
                    } else {
                        toastr.error(data.message);
                    }
                    $("#submit").attr("disabled", false);
                },
                error: function(response) {
                    $("#submit").attr("disabled", false);
                    $("#email_invalid_error").html(''); 
                    $("#email").val('');
                    if (response.responseJSON.message == 'Email Not Exist') {
                        $("#email_invalid_error").html('<ul class="parsley-errors-list filled" id="parsley-id-5" aria-hidden="false"><li class="parsley-type">Invalid Email.</li></ul>');
                    }else{
                        toastr.error(response.responseJSON.message,"",{timeOut: 5000});
                    }
                },
            });
        } else {
            $("#submit").attr("disabled", false);
            return false;
        }
    });
});

$("#email").on("keyup", function () {
    $("#email_invalid_error").html("");
});