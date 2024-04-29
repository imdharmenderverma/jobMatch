$(document).ready(function() {
    $("#form-register").parsley();

    $("#form-register").on("submit", function(event) {
        event.preventDefault();
        $("#submit").attr("disabled", true);

        if ($("#form-register").parsley().isValid()) {
            $.ajax({
                url: registerURL,
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $("#submit").val("Submitting...");
                },
                success: function(data) {
                    if (data.success) {
                        $("#form-register")[0].reset();
                        $("#form-register").parsley().reset();
                        if (data.message != '') {
                            setTimeout(window.location.href = nextURL, 2000)
                            toastr.success(data.message)
                        } else {
                            window.location.href = nextURL;
                        }
                    } else {
                        toastr.error(data.message);
                        window.location.href = redirectURL;
                    }
                },
                error: function(response) {
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