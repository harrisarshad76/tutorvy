<script>

$(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
});

    function showMessage() {
        var message = 'Your Profile is under verfication process...';
        toastr.error( message,{
                position: 'top-end',
                icon: 'error',
                showConfirmButton: false,
                timer: 2500
            });
    }
    function getSubSubject(id){

        for(var i=0; i<= $(".tablinks").length; i++){
            $(".tablinks").removeClass('active')
        }

        $("#defaultOpen_"+id).addClass('active')

        $.ajax({
            url: "{{url('tutor/subjects-all')}}"+"/"+id,
            type:"get",
            success:function(response){
                $("#subSubjects").html('')
                if(response){
                for(var i=0; i<=response.length; i++){
                    var html = `<div class="col-md-5">
                                    <div class="card-deck">
                                        <div class="card h-auto card-shadow p-0">
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <p class="heading-fifth mr-3 pt-2 mb-0 ">
                                                            `+response[i].name+`
                                                        </p>
                                                    </div>
                                                    <div class="col-md-3">

                                                    <a href="{{ url('tutor/assessment/') }}`+`/`+response[i].id+`">
                                                        <p class="view-bookings mb-0">Add</p>
                                                    </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`

                        $('#subSubjects').append(html)
                    }

                }
            },
            error:function(e) {
                console.log(e);
                toastr.error('Something Went Wrong',{
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
        });



    }

$('#subjects-list').on("change", function(e) {

    let subject = $("#subjects-list").val();
    let text = $(this).find(':selected').text();
    var a = $(this).find(':selected').attr('data-myval');
    $('.tablinks').removeClass('active');
    $('#defaultOpen_'+a).addClass('active')
    $('#subSubjects').html('');

    var html = `<div class="col-md-5">
                    <div class="card-deck">
                        <div class="card h-auto card-shadow p-0">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-9">
                                        <p class="heading-fifth mr-3 pt-2 mb-0 ">
                                            `+text+`
                                        </p>
                                    </div>
                                    <div class="col-md-3">

                                    <a href="{{ url('tutor/assessment/') }}`+`/`+subject+`">
                                        <p class="view-bookings mb-0">Add</p>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`

                $('#subSubjects').append(html)

});
</script>
