<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-signin-client_id" content="{{ env('GOOGLE_CLIENT_ID') }}">

    <title>Tutorvy</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <!--favicon --->
    <link href="{{ asset('assets/images/ico/side-icons.png') }}" rel="icon">
    <!-- bootstrap link -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <!-- fonawsome -->
    <link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">
    <!-- jquery animation libaray -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('assets/css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/asset.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/tutor.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/modal.css') }}" rel="stylesheet">
    <script src="assets/js/jquery.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets/css/ion.rangeSlider.css')}}"/>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <!-- iGuider Plugin -->
        <link rel="stylesheet" href="{{ asset('assets/css/iGuider.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/material/iGuider-theme-material.css') }}">
    <!-- iGuider Plugin -->

 


<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    font-size: 18px;
    line-height: 40px;
}
.select2-selection__arrow
{
    display:none;
}
.select2-container--default .select2-selection--single{
    height:43px !important;
}
.select2-selection__rendered{
    float:left;
}

</style>
</head>
<body>
    <section>
        <!-- navbar -->
        @include('layouts.navbar')
        <!-- navbar end -->
        <!-- Main-->
        @yield('content')
        <!--End Main-->
        @include('layouts.footer')
    </section>
<script>


    $(document).ready(function(){
        $(".input-subject").select2();
        $(".form-select").select2();
        $("#subjects").select2();
        $('.start-tour').on('click',function(){
		iGuider({
			tourTitle:'continue.enable',
			continue:{
				enable:true,
				cover:'../doc_files/images/hello.gif',
				overlayColor:'#000',
				overlayOpacity:0.5
			},
			steps:[{
				title:'Step 1',
				content:'Step 1 Description',	
				target:'el-1'
			},{
				title:'Step 2',
				content:'Step 2 Description',	
				target:'el-2'
			},{
				title:'Step 3',
				content:'Step 3 Description',	
				target:'el-3'
			}]
            });
            return false;
        });
    })
    function getSubSubject(id){

        for(var i=0; i<= $(".tablinks").length; i++){
            $(".tablinks").removeClass('active')
        }

        $("#defaultOpen_"+id).addClass('active')

        $.ajax({
            url: "{{url('subjects-all')}}"+"/"+id,
            type:"get",
            success:function(response){
                $("#subSubjects").html('')
                if(response){
                for(var i=0; i<=response.length; i++){
                    var html = `<div class="col-md-4">
                                            <a href="#"  class="">
                                            `+response[i].name+`
                                            </a>
                                        </div>`

                        $('#subSubjects').append(html)
                    }

                }
            },
            error:function(e) {
                console.log(e);

            }
        });



}

$("#subjects").change(function() {
    let id = $("#subjects").val();
    document.cookie = 's_link' + "=" + id + ";" + 60 + ";";
    location.href = '{{route('student.tutor',['+id+'])}}';
});

</script>
    <!-- <div class="modal fade support_modal show" id="support-modal" tabindex="-1" role="dialog" aria-labelledby="support-modal" style="padding-right: 7px; display: block;">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content modals">
                <div class="modal-body modal-bodys">
                    <div class="container text-center pb-3 pt-3">
                        <img src="{{asset('')}}" alt="verfiy">
                        <h3 class="mt-3">
                            Add Role
                        </h3>
                        <form id="edit_role_form">
                            <div class="container mt-3">
                                <div class="row pb-3">
                                    <div class="col-md-12">
                                        <div class="input-serach">
                                            <input type="hidden" id="edit_id" value="13">
                                            <input type="text" name="edit_name" id="edit_name" placeholder="Enter Name" class="w-100">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                    </div>
                                    <div class="col-md-7 d-flex">
                                        <button type="button" class="cencel-btn" data-dismiss="modal">Cancel</button>
                                        <button class="schedule-btn ml-3 edit_role" style="width: 130px;" type="submit">Edit Role</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</body>
</html>
