$(document).ready(function () {
    $("#subscription-form").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: storeSubscribe,
            type: "POST",
            dataType: "json",
            data: $("#subscription-form").serializeArray(),
            success: function (response) {
                if (response.status == true) {
                    resetValidation("#plan_name");
                    resetValidation("#plan_type");
                    resetValidation("#plan_price");
                    resetValidation("#plan_description");

                    window.location.href = Subscribe;
                    // console.log("form sumbited subscription");
                } else {
                    var errors = response.errors;
                    handleValidation("#plan_name", errors.plan_name);
                    handleValidation("#plan_type", errors.plan_type);
                    handleValidation("#plan_price", errors.plan_price);
                    handleValidation(
                        "#plan_description",
                        errors.plan_description
                    );
                }
            },
        });
    });

    function resetValidation(elementId) {
        $(elementId)
            .removeClass("is-invalid")
            .siblings("p")
            .removeClass("invalid-feedback")
            .html("");
    }

    function handleValidation(elementId, error) {
        $(elementId)
            .toggleClass("is-invalid", !!error)
            .siblings("p")
            .toggleClass("invalid-feedback", !!error)
            .html(error);
    }
});



// Delete Ajax logic
function deleteSubscription(subscriptionId) {
    if (confirm('Are you sure you want to delete?')) {
        $.ajax({
            url: subscribeDelete,
            type: 'post',
            data: {
                subscriptionId: subscriptionId
            },
            dataType: 'json',
            success: function(response) {
                window.location.href = Subscribe;
            }
        });
    }
}