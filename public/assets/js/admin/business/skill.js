$(document).ready(function () {
    var table = $(".skill-table").DataTable({
        searching: false,
        processing: true,
        dom: "rtip",
        serverSide: true,
        pageLength: 10,
        ajax: {
            url: skills,
            data: function (d) {
                d.search = $(".search-skill").val();
            },
        },
        drawCallback: function () {
            var pagination = $(this)
                .closest(".dataTables_wrapper")
                .find(".dataTables_paginate");
            pagination.toggle(
                this.api().page.info().recordsTotal >
                this.api().page.info().length
            );
            var paginationNumber = $(this)
                .closest(".dataTables_wrapper")
                .find(".dataTables_info");
            paginationNumber.toggle(
                this.api().page.info().recordsTotal >
                this.api().page.info().length
            );
        },
        language: { // Customize the language options
            emptyTable: "No data available",
            // Add other language customizations here if needed
        },
        columns: [
            { data: "id", name: "id" },
            { data: "title", name: "title" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    $(".search-skill").keyup(function () {
        table.draw();
    });

    $(".add-btn-modal").on("click", function () {
        $("#id").val("");
        $("#sub-error").html("");
        $("#industry-error").html("");
        $("#industry_id").val(null).trigger("change");
        $("#title").val("");
        // $(".modalHeader").html("Add Skill");
        $(".save-btn").val("Save");
        $("#add-skill-modal").modal("show");
    });

    $("#skill-form").on("submit", function (e) {
        e.preventDefault();
        $(".save-btn").attr("disabled", true);
        var temp = 0;
        var title = $("#title").val();
        var industry = $("#industry_id").val();
        var skill_id = $("#id").val();

        if (title.trim() == "") {
            $("#title-error").html("Please Enter Skill Name.");
            temp++;
        } else {
            $("#title-error").html("");
        }

        if (industry == "") {
            $("#industry-error").html("Please Select Industry.");
            temp++;
        } else {
            $("#industry-error").html("");
        }

        if (temp != 0) {
            $(".save-btn").attr("disabled", false);
            return false;
        }
        else {
            myButton.className = myButton.className + ' loading';
        }

        var formData = new FormData(this);
        if (skill_id == "") {
            var url = storeSkill;
        } else {
            var url = skills + "/" + skill_id;
            formData.append("_method", "PUT");
        }
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".save-btn").attr("disabled", false);
                if (data.success) {
                    toastr.success(data.message, "", { timeOut: 3000 });
                    setTimeout(() => {
                        location.reload();
                        $("#add-skill-modal").modal("hide");
                        myButton.className = myButton.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');

                    }, 5000);
                } else {
                    toastr.error(data.message);
                }
            },
            error: function (data) {
                toastr.error(data.responseJSON.message);
                $(".save-btn").attr("disabled", false);
            },
        });
    });

    $("#industry_id").select2({
        placeholder: "Select Industry",
        allowClear: true,
    });

    $("body").on("click", ".edit-skill", function () {
        $("#id").val($(this).data("id"));
        let industry = $(this).data("parent");
        $("#industry_id").select2("val", [industry.split(",")]);
        $("#title").val($(this).data("title"));
        $('#edit-close').html('Edit Skill');
        $(".save-btn").val("Update");
        $("#sub-error").html("");
        $("#industry-error").html("");
        $("#add-skill-modal").modal("show");
    });

    $("body").on("click", ".delete-skill", function () {
        var id = $(this).data("id");
        var formData = new FormData();
        formData.append("user_id", id);
        swal({
            text: "Are you sure you want to delete record?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: storeSkill + "/" + id,
                    type: "DELETE",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        if (data.success) {
                            toastr.success(data.message);
                            table.draw();
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function (data) {
                        toastr.error(data.responseJSON.message);
                    },
                });
            }
        });
    });
});
