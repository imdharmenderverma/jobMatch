$(document).ready(function() {
    var table = $('.statement-skill-table').DataTable({
        searching: false,
        processing: true,
        "dom": 'rtip',
        serverSide: true,
        pageLength: "10",
        ajax: {
            url: statementSkill,
            data: function(d) {
                d.search = $('.search-statement-skill').val()
            }
        },
        language: { // Customize the language options
            emptyTable: "No data available",
            // Add other language customizations here if needed
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    $(".search-statement-skill").keyup(function() {
        table.draw();
    });

    $(".add-btn-modal").on('click', function() {
        $("#id").val('');
        $("#title").val('');
        $(".modalHeader").html('Add Statement Skill');
        $(".save-btn").val('Save');
        $("#add-statement-skill-modal").modal('show');
    });

    $("#skill-form").on("submit", function(e) {
        e.preventDefault();
        $('.save-btn').attr("disabled", true);
        var temp = 0;
        var title = $("#title").val();
        var skill_id = $("#id").val();

        if (title.trim() == "") {
            $("#title-error").html("Please Enter Title.");
            temp++;
        } else {
            $("#title-error").html("");
        }

        if (temp != 0) {
            $('.save-btn').attr("disabled", false);
            return false;
        }

        var formData = new FormData(this);
        if (skill_id == '') {
            var url = storeStatementSkill;
        } else {
            var url = statementSkill + "/" + skill_id;
            formData.append('_method', 'PUT');
        }
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $('.save-btn').attr("disabled", false);
                if (data.success) {
                    toastr.success(data.message);
                    $("#add-statement-skill-modal").modal('hide');
                    table.draw();
                } else {
                    toastr.error(data.message);
                }
            },
            error: function(data) {
                toastr.error(data.responseJSON.message);
                $('.save-btn').attr("disabled", false);
            }
        });
    });

    $('#parent_id').select2({
        placeholder: "Select Skill",
        allowClear: true
    });

    $("body").on("click", ".edit-statement-skill", function() {
        $("#id").val($(this).data('id'));
        $("#title").val($(this).data('title'));
        $(".modalHeader").html('Edit Statement Skill');
        $(".save-btn").val('Update');
        $("#title-error").html("");
        $("#add-statement-skill-modal").modal('show');
    })

    $("body").on("click", ".delete-statement-skill", function() {
        var id = $(this).data("id");
        var formData = new FormData();
        formData.append('user_id', id);
        swal({
            text: "Are you sure you want to delete record?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: storeStatementSkill + "/" + id,
                    type: "DELETE",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if (data.success) {
                            toastr.success(data.message);
                            table.draw();
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function(data) {
                        toastr.error(data.responseJSON.message);
                    },
                });
            }
        });
    });
})