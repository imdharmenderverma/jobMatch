$(document).ready(function(){

    $(document).on('click', '.pagination a', function(event){
     event.preventDefault(); 
     var page = $(this).attr('href').split('page=')[1];
     fetch_data(page);
    });
   
    function fetch_data(page)
    {
     $.ajax({
      url:jobPostPagination + "?page="+page,
      success:function(data)
      {
       $('#job-listing').html(data);
      }
     });
    }
    
   });
   $(document).on("click", ".showMessageFullContent", function() {
    var message = $(this).data("message");
    var name = $(this).data("name");
    $('#modelWindow').modal('show');
    $('#addText').html(message);
    $(".title").text(name);
});