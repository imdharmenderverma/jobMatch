$(document).ready(function(e){
    userLocationAjax('week');
})

function userLocationAjax(type){
    $('#user_location_button_text').html('Weekly')
    if(type == "month"){
        $('#user_location_button_text').html('Monthly')
    }
    if(type == "year"){
        $('#user_location_button_text').html('Annually')
    }
    $.ajax({
        url: ajax,
        type: "get",
        data: {
            type:type
        },
        success: function (res) {
            $('#user_location_total_user').html(res.data.totalCount);
            $('#qld_total_user').html(res.data.qldStateCount);
            $('#nsw_total_user').html(res.data.nswStateCount);
            $('#wa_total_user').html(res.data.waStateCount);
            $('#vic_total_user').html(res.data.vicStateCount);
            $('#tas_total_user').html(res.data.tasStateCount);
            $('#sa_total_user').html(res.data.saStateCount);
            $('#act_total_user').html(res.data.actStateCount);
            $('#nt_total_user').html(res.data.ntStateCount);

            var qldPer = 0;
            if(res.data.qldStateCount > 0){
                qldPer = (res.data.qldStateCount *100)/res.data.totalCount;
            }
            $('#qld_user_per').html(qldPer.toFixed(2));
            $('#qld_progress_bar').css('width',qldPer+"%");

            var nswPer = 0;
            if(res.data.nswStateCount > 0){
                nswPer = (res.data.nswStateCount *100)/res.data.totalCount;
            }
            $('#nsw_user_per').html(nswPer.toFixed(2));
            $('#nsw_progress_bar').css('width',nswPer+"%");
 
            var waPer = 0;
            if(res.data.waStateCount > 0){
                waPer = (res.data.waStateCount *100)/res.data.totalCount;
            }
            $('#wa_user_per').html(waPer.toFixed(2));
            $('#wa_progress_bar').css('width',waPer+"%");

            var vicPer = 0;
            if(res.data.vicStateCount > 0){
                vicPer = (res.data.vicStateCount *100)/res.data.totalCount;
            }
            $('#vic_user_per').html(vicPer.toFixed(2));
            $('#vic_progress_bar').css('width',vicPer+"%");

            var tacPer = 0;
            if(res.data.tasStateCount > 0){
                tacPer = (res.data.tasStateCount *100)/res.data.totalCount;
            }
            $('#tas_user_per').html(tacPer.toFixed(2));
            $('#tas_progress_bar').css('width',tacPer+"%");

            var saPer = 0;
            if(res.data.saStateCount > 0){
                saPer = (res.data.saStateCount *100)/res.data.totalCount;
            }
            $('#sa_user_per').html(saPer.toFixed(2));
            $('#sa_progress_bar').css('width',saPer+"%");

            var actPer = 0;
            if(res.data.actStateCount > 0){
                actPer = (res.data.actStateCount *100)/res.data.totalCount;
            }
            $('#act_user_per').html(actPer.toFixed(2));
            $('#act_progress_bar').css('width',actPer+"%");

            var ntPer = 0;
            if(res.data.ntStateCount > 0){
                ntPer = (res.data.ntStateCount *100)/res.data.totalCount;
            }
            $('#nt_user_per').html(ntPer.toFixed(2));
            $('#nt_progress_bar').css('width',ntPer+"%");
            
            $('#qld_down_arrow').css('display','none');
            $('#qld_up_arrow').css('display','');
            if(res.data.qldStateCount < res.data.qldLastStateCount){
                $('#qld_down_arrow').css('display','');
                $('#qld_up_arrow').css('display','none');
            }
            
            $('#nsw_down_arrow').css('display','none');
            $('#nsw_up_arrow').css('display','');
            if(res.data.nswStateCount < res.data.nswLastStateCount){
                $('#nsw_down_arrow').css('display','');
                $('#nsw_up_arrow').css('display','none');
            }
            
            $('#wa_down_arrow').css('display','none');
            $('#wa_up_arrow').css('display','');
            if(res.data.waStateCount < res.data.waLastStateCount){
                $('#wa_down_arrow').css('display','');
                $('#wa_up_arrow').css('display','none');
            }

            $('#vic_down_arrow').css('display','none');
            $('#vic_up_arrow').css('display','');
            if(res.data.vicStateCount < res.data.vicLastStateCount){
                $('#vic_down_arrow').css('display','');
                $('#vic_up_arrow').css('display','none');
            }

            $('#tas_down_arrow').css('display','none');
            $('#tas_up_arrow').css('display','');
            if(res.data.tasStateCount < res.data.tasLastStateCount){
                $('#tas_down_arrow').css('display','');
                $('#tas_up_arrow').css('display','none');
            }

            $('#sa_down_arrow').css('display','none');
            $('#sa_up_arrow').css('display','');
            if(res.data.saStateCount < res.data.saLastStateCount){
                $('#sa_down_arrow').css('display','');
                $('#sa_up_arrow').css('display','none');
            }

            $('#act_down_arrow').css('display','none');
            $('#act_up_arrow').css('display','');
            if(res.data.actStateCount < res.data.actLastStateCount){
                $('#act_down_arrow').css('display','');
                $('#act_up_arrow').css('display','none');
            }

            $('#nt_down_arrow').css('display','none');
            $('#nt_up_arrow').css('display','');
            if(res.data.ntStateCount < res.data.ntLastStateCount){
                $('#nt_down_arrow').css('display','');
                $('#nt_up_arrow').css('display','none');
            }
        },
    });
}
Circles.create({
    id: 'circles-1',
    radius: 45,
    value: feMaleCount,
    maxValue: 100,
    width: 7,
    colors: ['#f1f1f1', '#FF9E27'],
    duration: 400,
    wrpClass: 'circles-wrp',
    textClass: 'circles-text',
    styleWrapper: true,
    styleText: true
})
Circles.create({
    id: 'circles-2',
    radius: 45,
    value: maleCount,
    maxValue: 100,
    width: 7,
    colors: ['#f1f1f1', '#FF9E27'],
    duration: 400,
    wrpClass: 'circles-wrp',
    textClass: 'circles-text h6',
    styleWrapper: true,
    styleText: true
})

var doughnutChart = document.getElementById('doughnutChart').getContext('2d');

var myDoughnutChart = new Chart(doughnutChart, {
    type: 'doughnut',
    data: {
        datasets: [{
            data: [50, 50],
           // data: [70, 30],
            backgroundColor: ['#fd7212', '#81c5c7']
        }],

        labels: [
            'Subscription',
            'Ad Ons'
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
            position: 'bottom'
        },
        layout: {
            padding: {
                left: 20,
                right: 20,
                top: 20,
                bottom: 20
            }
        }
    }
});

var lineChart = document.getElementById('lineChart').getContext('2d');

    var myLineChart = new Chart(lineChart, {
        type: 'line',
        data: {
            labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            datasets: [{
                label: "Subscription",
                borderColor: "#fd7212",
                pointBorderColor: "#fd7212",
                pointBackgroundColor: "#fd7212",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: [1650, 1410, 1810, 1410, 1610, 1910, 1410]
                //data: [1600, 1400, 1800, 1400, 1600, 1900, 1400]
            }, {
                label: "Ad Ons",
                borderColor: "#FFF",
                pointBorderColor: "#FFF",
                pointBackgroundColor: "#FFF",
                pointBorderWidth: 2,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 1,
                pointRadius: 4,
                backgroundColor: 'transparent',
                fill: true,
                borderWidth: 2,
                data: [1420, 1120, 1320, 820, 1120, 1620, 1320]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'bottom',
                labels: {
                    padding: 10,
                    fontColor: '#FFF',
                }
            },
            tooltips: {
                bodySpacing: 4,
                mode: "nearest",
                intersect: 0,
                position: "nearest",
                xPadding: 10,
                yPadding: 10,
                caretPadding: 10
            },
            layout: {
                padding: {
                    left: 0,
                    right: 15,
                    top: 25,
                    bottom: 15
                }
            }
        }
    });