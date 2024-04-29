
$('#formEdit').on('submit', function (e) {
    e.preventDefault();
    $("#btn-save").prop('disabled', true);
    var description = CKEDITOR.instances['description'].getData();
    var id = $('#id-edit').val();
    var cnt = 0;

    if (description.trim() == '') {
        $('#Description_error').html("Please Enter Terms And Use.");
        cnt = 1;
    }

    if (cnt == 1) {
        $("#btn-save").prop('disabled', false);
        return false;
    } else {
        myButton.className = myButton.className + ' loading';
        var formData = $('#formEdit')[0];
        var newform = new FormData(formData);
        newform.append('description', description);
        newform.append('type', 'terms_and_conditions');
        newform.append('_token', csrfToken);
        newform.append('_method', "POST");
        $.ajax({
            type: "POST",
            url: updateTermsOfUse,
            data: newform,
            processData: false,
            contentType: false,
            success: function (data) {
                $('#Description_error').html("")
                $("#btn-save").prop('disabled', false);
                if (data.success) {
                    toastr.success(data.message, "", { timeOut: 5000 });
                    setTimeout(() => {
                        window.location.href = cmsIndexUrl;
                        myButton.className = myButton.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');
                    }, 3000);

                } else {
                    toastr.error(data.message, "", { timeOut: 5000 });
                }
            },
            error: function (data) {
                toastr.error(data.error_msg, "", { timeOut: 5000 });
            }
        });
    }
});
