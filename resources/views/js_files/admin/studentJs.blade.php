<script>
  $(document).ready(function() {
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
  });

// Admin CoStudenturse Script Blade
$(".s_status").click(function(){
  var id = $(this).attr("val_id");
  var st = $(this).attr("val_st");
  let reason = null;

  if(st == 3){
    reason = $('#c_reject_reason').val();
  }
    if($(this).is(':checked')){
      st = 1;
      // alert(st);
      $.ajax({
          url: "{{route('admin.studentStatus')}}",
          type:"POST",
          data:{
            id:id,
            status:st,
            reason:reason
          },
          success:function(response){
            // console.log(response);
            if(response.status == 200) {

              toastr.success(response.message,{
                  position: 'top-end',
                  icon: 'success',
                  showConfirmButton: false,
                  timer: 2500
              })
              setInterval(function(){
                  window.location.reload();
                }, 1500);
            }

          },
          error:function(e) {
            toastr.error('Something went wrong',{
                position: 'top-end',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
          }
      });

    }
    else{
      st=0;
      $.ajax({
          url: "{{route('admin.studentStatus')}}",
          type:"POST",
          data:{
            id:id,
            status:st,
            reason:reason
          },
          success:function(response){
            // console.log(response);
            if(response.status == 200) {

              toastr.success(response.message,{
                  position: 'top-end',
                  icon: 'success',
                  showConfirmButton: false,
                  timer: 2500
              })
              setInterval(function(){
                  window.location.reload();
                }, 1500);

            }
          },
          error:function(e) {
              toastr.error('Something went wrong',{
                  position: 'top-end',
                  icon: 'error',
                  showConfirmButton: false,
                  timer: 2500
              });
          }
      });

    }
})

function deleteStudent(id){
    var id = id;
  $("#deleteStudentModal").modal('show');
  $("#Yes").click(function(){
    // alert(id);
    $.ajax({
          url: "{{route('admin.deleteStudent')}}",
          type:"POST",
          data:{
            id:id,
          },
          success:function(response){
            console.log(response);
            if(response.status == 200) {
              toastr.success(response.message,{
                  position: 'top-end',
                  icon: 'success',
                  showConfirmButton: false,
                  timer: 2500
              })
              $("#deleteStudentModal").modal('hide');
              setInterval(function(){
                  window.location.reload();
                }, 1500);

            }
          },
          error:function(e) {
              toastr.error('Something went wrong',{
                  position: 'top-end',
                  icon: 'error',
                  showConfirmButton: false,
                  timer: 2500
              });
          }
      });

  });
}


var tutor_id = null;

function assignStudentModal(user_id) {
     $("#assignModal").modal('show');
     tutor_id = user_id
 }
 function assign(id) {

     $.ajax({
         url: "{{ route('admin.tutor.assign') }}",
         type: "POST",
         data: {
             _token: "{{ csrf_token() }}",
             tutor: tutor_id,
             staff:id
         },

         beforeSend: function(data) {
             $("#assignModal").modal('hide');
         },
         success: function(response) {
             if (response.status == 200) {
                 toastr.success(response.message, {
                     position: 'top-end',
                     icon: 'success',
                     showConfirmButton: false,
                     timer: 2500
                 });

                 setInterval(function() {}, 1500);

             } else if (response.status == 400) {
                 toastr.error(response.message, {
                     position: 'top-end',
                     icon: 'error',
                     showConfirmButton: false,
                     timer: 2500
                 });

                 setInterval(function() {}, 1500);
             }
         },
         error: function(e) {
             toastr.error('Something Went Wrong', {
                 position: 'top-end',
                 icon: 'error',
                 showConfirmButton: false,
                 timer: 2500
             });
         }
     });

 }
 //filter
 $(document).ready(function() {
     $("#search").on("keyup", function() {
         var value = $(this).val().toLowerCase();
         $("#record div").filter(function() {
             $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
         });
     });
 });

</script>
