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
                    $("#submit").attr("disabled", true);
                    $("#submit").val("Submitting...");
                },
                success: function(data) {
                    $("#forgot-form")[0].reset();
                    $("#forgot-form").parsley().reset();
                    $("#submit").val("Submit");
                    toastr.success(data.message,"",{timeOut: 10000});
                    $("#submit").attr("disabled", false);

                },
                error: function(response) {
                    $("#submit").attr("disabled", false);
                    $("#email").val('');
                    $("#email_invalid_error").html(''); 
                    if (response.responseJSON.message == 'Email Not Exist') {
                        $("#email_invalid_error").html('<ul class="parsley-errors-list filled" id="parsley-id-5" aria-hidden="false"><li class="parsley-type">Invalid Email.</li></ul>');
                    }else{
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