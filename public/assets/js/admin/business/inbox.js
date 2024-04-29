
$(document).on('click', '.user_data', function () {
    $('#id').val('');
    $('#helps_user_id').val('');
    var userId = $(this).attr("data-id");
    var helpuserId = $(this).attr("data-user_id");
    $.ajax({
        url: userInbox,
        type: "get",
        data: {
            user_id: userId,
            help_id: helpuserId,
        },
        success: function (response) {
            if (response) {
                if (response.userData.app_user_data != null) {
                    $('#name').val(response.userData.name);
                    $('#email').val(response.userData.email);
                    $('#date').val(response.userData.date);
                    $('#answer').val(response.userData.message);
                    $('#helps_user_id').val(response.userData.id);
                }
                else {
                    $('#name').val(response.userData.recruiter.business_name);
                    $('#email').val(response.userData.recruiter.email);
                    $('#date').val(response.userData.date);
                    $('#answer').val(response.userData.answer);
                    $('#id').val(response.userData.id);
                }
            }
        },
        error: function (data) {
            toastr.error(data.message);
        }
    });
});

$(document).on("click", ".mark_as_read", function () {
    var helpsUserId = $('.helps_user_id').val();
    var id = $('.helps_id').val();
    if (id || helpsUserId) {
        myButton.className = myButton.className + ' loading';
        $.ajax({
            url: flagUpdate,
            type: "post",
            data: {
                helpsUserId: helpsUserId,
                id: id,
            },
            success: function (response) {
                toastr.success(response.message);
                myButton.className = myButton.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                $('#name').val('');
                $('#email').val('');
                $('#date').val('');
                $('#answer').val('');
                $('.user-orange-dot' + id).hide();
                $('.business-orange-dot' + helpsUserId).hide();
            },
            error: function (error) {
            }
        });
    }
});


$(document).on('click', '.firstPannel,.secondPannel', function () {
    $('#name').val('');
    $('#email').val('');
    $('#date').val('');
    $('#answer').val('');
})
