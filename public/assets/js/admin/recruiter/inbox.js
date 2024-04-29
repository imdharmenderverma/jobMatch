$("#inboxForm").on("submit", function (e) {
    e.preventDefault();
    $('.save-btn').attr("disabled", true);
    var temp = 0;
    var question = $("#question").val();

    var answer = $("#answer").val();

    if (question.trim() == "") {
        $("#question-error").html("Please Enter Question.");
        temp++;
    } else {
        $("#question-error").html("");
    }

    if (answer.trim() == "") {
        $("#answer-error").html("Please Enter Answer.");
        temp++;
    } else {
        $("#answer-error").html("");
    }

    if (temp != 0) {
        $('.save-btn').attr("disabled", false);
        return false;
    }
    else {
        myButton6.className = myButton6.className + ' loading';
    }
    var formData = new FormData(this);
    formData.append('question', question);
    formData.append('answer', answer);

    var url = storeInbox;

    $.ajax({
        url: url,
        type: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('.save-btn').attr("disabled", false);
            if (data.success) {
                toastr.success(data.message, "", { timeOut: 5000 });
                setTimeout(() => {
                    myButton6.className = myButton6.className.replace(new RegExp('(?:^|\\s)loading(?!\\S)'), '');

                    location.reload();
                    table.draw();
                }, 5000);
            } else {
                toastr.error(data.message);
            }
        },
        error: function (data) {
            toastr.error(data.responseJSON.message);
            $('.save-btn').attr("disabled", false);
        }
    });

    $('#start_date').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
});




