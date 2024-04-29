$(document).ready(function () {
    let sortBy = 1;
    var table = $(".user-table").DataTable({
        searching: false,
        processing: true,
        dom: "rtip",
        order: [],
        serverSide: true,
        pageLength: 10,
        ajax: {
            url: users,
            data: function (d) {
                d.search = $(".search-user").val();
                d.industry = $(".industry-type").val();
                d.location = $(".cus-op-left").val();
                d.sort_by = sortBy;
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
            { data: "business_name", name: "business_name" },
            { data: "location", name: "location" },
            { data: "industry_name", name: "industry_name" },
            { data: "total_job_count", name: "total_job_count" },
            { data: "total_active_job_count", name: "total_active_job_count" },
            { data: "matches_count", name: "matches_count" },
            { data: "status", name: "status", orderable: false, searchable: false, },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    $(document).on("click", "#pills-tab", function () {
        $(this)
            .find("li")
            .each(function () {
                var liElement = $(this).find("a");
                if (liElement.hasClass("show")) {
                    sortBy = liElement.data("id");
                }
            });
        table.draw();
    });

    $("body").on("click", ".action-btn-icon", function () {
        let id = $(this).data("id");
        document.getElementById("myDropdown" + id).classList.toggle("show");
    });

    $(".search-user").keyup(function () {
        table.draw();
    });

    $("body").on("change", ".industry-type", function () {
        table.draw();
    });

    $("body").on("change", ".cus-op-left", function () {
        table.draw();
    });


    $("body").on("change", ".recruiter-status", function () {
        var id = $(this).data("id");
        var status = $(this).data("val");
        var formData = new FormData();
        formData.append("id", id);
        formData.append("status", status == 1 ? 0 : 1);
        $.ajax({
            type: "POST",
            url: statusRoute,
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
    });

    $("body").on("click", ".delete-user", function () {
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
                    url: storeUser + "/" + id,
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
