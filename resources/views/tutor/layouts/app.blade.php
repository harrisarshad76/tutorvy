<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutorvy</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--favicon --->
    <link href="{{ asset('assets/images/ico/side-icons.png') }}" rel="icon">
    <!-- bootstrap link -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/calender.css') }}" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/chat.css') }}" rel="stylesheet">

    <!-- fonawsome -->
    <link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">
    <!-- Dropify CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/multiselect.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/dropify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/countrySelect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/booking.css') }}">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.2.7/emojionearea.css"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/emojionearea.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-analytics.js"></script> -->

    <!--Select 2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- iGuider Plugin -->
        <link rel="stylesheet" href="{{ asset('assets/css/iGuider.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/material/iGuider-theme-material.css') }}">
    <!-- iGuider Plugin -->
      <!-- Cropper Plugin -->
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet" />

    <script src="https://unpkg.com/cropperjs"></script>
    <!-- Cropper Plugin -->
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    <!-- Styles -->

    @include('tutor.layouts.css')
    <style>
        .dataTables_length{
            display:none;
        }
        .dataTables_wrapper{
            margin-top:10px;
        }
        table.dataTable.no-footer {
                border-bottom: none;
                margin-bottom:20px;

            }
            table .table-bordered .dataTable .no-footer{
                    margin-bottom:20px;
            }
    </style>
</head>

<body>
    <div class="wrapper token_wrapper">
        <input type="hidden" class="user_id" value={{ Auth::user()->id }}>
        <input type="hidden" class="user_role_id" value={{ Auth::user()->role }}>

        <!-- side navbar -->
        @include('tutor.layouts.sidebar')
        <!-- seide navbar end -->
        <div class="content" style="width: 100%;background-color: #FBFBFB !important;">
            @include('tutor.layouts.navbar')
            <!-- Main-->
            @yield('content')
            <div class="modal fade supportModal" id="supportModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content pb-3">
                        <div class="modal-body">
                            <div class="container">
                                <form action="{{ route('tutor.save.ticket') }}" class="supportForm" method="POST">
                                    <div class="row">
                                        <div class="col-md-12 pt-4">
                                            <div class="iconss" style="text-align: center;">
                                                <img src="{{ asset('assets/images/ico/support.png') }}" alt="support"
                                                    class="mb-2" width="80px">
                                                <p
                                                    style=" font-size: 24px;color: #00132D;font-family: Poppins;font-weight: 600;margin-top: 10px;">
                                                    Support</p>
                                                <p style="font-size: 15px;color: #00132D;font-family: Poppins;font-weight: 400;line-height: 1.4;"
                                                    class="ml-5 mr-5">We are here to listen you, please write if
                                                    you have any problem</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="subject">Subject</label>
                                            <input type="text" class="form-control" name="subject" id="subject"
                                                placeholder="Subject">
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <select name="category" class="form-select support_category" id="category">
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <textarea name="message" id="message" cols="30" rows="10"
                                                class="form-control" placeholder="Enter your query here"></textarea>
                                        </div>
                                        <div class="col-md-12 mt-2 text-right">
                                            <button type="submit" class="schedule-btn"
                                                style="width: 130px;">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal supportModal" id="supportModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content pb-3">
                        <div class="modal-body">
                            <div class="container">
                                <form action="{{ route('tutor.save.ticket') }}" class="supportForm" method="POST">
                                    <div class="row">
                                        <div class="col-md-12 pt-4">
                                            <div class="iconss" style="text-align: center;">
                                                <img src="{{ asset('assets/images/ico/support.png') }}" alt="support" class="mb-2" width="80px">
                                                <p
                                                    style=" font-size: 24px;color: #00132D;font-family: Poppins;font-weight: 600;margin-top: 10px;">
                                                    Support</p>
                                                <p style="font-size: 15px;color: #00132D;font-family: Poppins;font-weight: 400;line-height: 1.4;"
                                                    class="ml-5 mr-5">We are here to listen you, please write if you have any problem</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="subject">Subject</label>
                                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <select name="category" class="form-select support_category" id="category">
                                            </select>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Enter your query here"></textarea>
                                        </div>
                                        <div class="col-md-12 mt-2 text-right">
                                            <button type="submit" class="schedule-btn" style="width: 130px;">Send</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div>

            </div>

            <!-- custom js -->

            <!-- <script src="{{ asset('js/app.js') }}"></script> -->
            <!-- jquery  -->
            <script src="{{ asset('/admin/assets/js/jquery.js') }}"></script>
            <script src="{{ asset('/admin/assets/js/jquery-ui.js') }}"></script>

            <script src="{{ asset('/admin/assets/js/popper.min.js') }}"></script>
            <script src="{{ asset('/admin/assets/js/bootstrap.min.js') }}"></script>
            <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
            <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
            <script src="{{ asset('assets/js/mobile.js') }}"></script>
            <script src="{{ asset('assets/js/history.js') }}"></script>
            <script src="{{ asset('assets/js/subject.js') }}"></script>
            <script src="{{ asset('assets/js/homePage.js') }}"></script>
            <script src="{{ asset('assets/js/registration.js') }}"></script>
            <script src="{{ asset('assets/js/dropify.js') }}"></script>
            <script src="{{ asset('assets/js/multiselect.js') }}"></script>
            <script src="{{ asset('assets/js/countrySelect.js') }}"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdn.jsdelivr.net/npm/easytimer@1.1.1/dist/easytimer.min.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.2.7/emojionearea.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

            <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-app.js"></script>
            <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-database.js"></script>
            <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-messaging.js"></script>
            <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-analytics.js"></script>
            <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-auth.js"></script>
            <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-firestore.js"></script>
            <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-storage.js"></script>
            <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


        <!-- iGuider Plugin -->
            <script src="{{ asset('assets/js/jquery.iGuider.js') }}"></script>
        <script src="{{ asset('assets/material/iGuider-theme-material.js') }}"></script>

        <!-- iGuider Plugin -->


   <!-- <script src="{{ asset('assets/firebase/index.js') . '?ver=' . rand() }}"></script> -->
            @include('firebase')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.5/ace.js" type="text/javascript" charset="utf-8"></script>


            <!-- <script src="{{ asset('assets/js/jquery_ui_multiselector.js') }}"></script> -->


            @yield('scripts')
            @include('js_files.tutor.supportJs')
            @yield('js')
            <script>
                $(document).ready(function() {

                   
        // iGuider Initialization

        $('.start-tour').on('click',function(){
            iGuider({
                tourTitle:'continue.enable',
                'intro': {
                    'title': 'Welcome To Tutorvy',
                    'content': 'Dashboard ',
                    'overlayOpacity': '0.4'
                },
                continue:{
                    enable:true,
                    cover:'../doc_files/images/hello.gif',
                    overlayColor:'#000',
                    overlayOpacity:0.5
                },
                'tourMap': {
                    'enable': false,
                    'clickable': 'ready'
                },
                'lang': {
                    'cancelText': '',
                    'tourMapText': '',
                    'endText': 'End of time'
                },
                steps:[{
                    title:'Set Your Porifile',
                    content:'Here you can setup your profile',   
                    target:'el-profile'
                },{
                    title:'Booking Tour',
                    content:'Booking Tour Description',   
                    target:'el-booking'
                },{
                    title:'Classroom Tour',
                    content:'Classroom Tour Description',   
                    target:'el-classroom'
                },{
                    title:'Courses Tour',
                    content:'Courses Tour Description',   
                    target:'el-courses'
                },{
                    title:'Select Subject',
                    content:'find a subject you prefer to teach',   
                    target:'el-subjects'
                }]

            });
            return false;
        });
        // iGuider Initialization
                    $('.table').DataTable();
                    get_all_notifications();
                    $('.table').DataTable();

                    $(".dropify").dropify();
                    $('.js-multiSelect').select2();
                    $('.form-select').select2();
                    $("#msg").emojioneArea({
                        pickerPosition: "top",
                        saveEmojisAs: "shortname"
                    });

                    /* Table Sorting */
                    // $("th").append('<i class="ml-1 fa fa-sort"></i>');
                    // $("th:last-child").css("color", 'white');
                    // $(".get").find("th:last-child").css("color",'red !important;');

                    // const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

                    // const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
                    //     v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
                    // )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

                    // do the work...
                    // document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
                    //     const table = th.closest('table');
                    //     Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
                    //         .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this
                    //             .asc))
                    //         .forEach(tr => table.appendChild(tr));
                    // })));
                    $(function() {
                        $('[data-toggle="tooltip"]').tooltip()
                    });
                })
                    $('.dd').click(function(){
                        $('.dd2').toggle('hide');
                        $(".notification-menu ").hide();

                    })
                    $('.notification').click(function(){
                        $('.dd2').hide();

                    })

                    $(".content-wrapper").click(function(){
                            $(".notification-menu ").hide();
                            $('.dd2').hide();
                    });
                $("#country_selector").countrySelect({
                    defaultCountry: "{{ $user->country_short ?? '' }}",
                    preferredCountries: ['ca', 'gb', 'us', 'pk']
                });

                $("#country_selector").on('change', function() {
                    var short = $(this).countrySelect("getSelectedCountryData");
                    $("#country_short").val(short.iso2);
                });

                function hideCard() {
                    // alert();
                    $(".infoCard").hide('slow');
                };

                function get_all_notifications() {
                    $.ajax({
                        url: "{{ route('getNotification') }}",
                        type: "GET",
                        dataType: 'json',
                        success: function(response) {
                            var obj = response.data;
                            console.log(response , "asd");

                            // console.log(response.unread_msg_count , "asd");
                            if(response.unread_msg_count == 0){
                                $(".show_message_counts").css("display","none");
                                $('.show_message_counts').text(0)
                            }
                            else{
                                $(".show_message_counts").addClass("notification-text");
                                $('.show_message_counts').text(response.unread_msg_count);
                            }
                            if (response.status_code == 200 && response.success == true) {
                                var notification = ``;
                                if (obj.length == 0) {
                                    $('.show_notification_counts').css("display","none");

                                    $('.show_notification_counts').text(0);
                                    notification += `
                                                        <li class="text-center">
                                                            No more unread notifications
                                                        </li>
                                                            `;
                                    $(".show_all_notifications").html(notification);
                                } else {
                                    $(".show_notification_counts").addClass("notification-text");
                                        $('.show_notification_counts').text(obj.length);
                                        for (var i = 0; i < obj.length; i++) {
                                            let img = '';

                                            if (obj[i].sender_pic != null) {
                                                img =
                                                    `<img class="profile-img mt-2 w-100 p-0" src="{{ asset('`+obj[i].sender_pic+`') }}" alt="layer">`;
                                            } else {
                                                img =
                                                    `<img class="profile-img mt-2 w-100 p-0" src="{{ asset('assets/images/ico/Square-white.jpg') }}" alt="layer">`;
                                            }
                                            notification += `
                                                        <li>
                                                            <a href="` + obj[i].slug + `" class="bgm">
                                                                <div class="row">
                                                                    <div class="col-md-2 pr-0 text-center">
                                                                    ` + img + `
                                                                    </div>
                                                                    <div class="col-md-10">
                                                                        <div class="head-1-noti">
                                                                            <span class="notification-text6">
                                                                                <strong>` + obj[i].noti_title + ` </strong>
                                                                                ` + obj[i].noti_desc + `
                                                                            </span>
                                                                        </div>
                                                                        <span class="notification-time">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                            `;
                                        }
                                    $(".show_all_notifications").html(notification);
                                }

                            } else {
                                notification += `<span> No Notification </span>`;
                            }
                        },
                        error: function(e) {
                            // console.log(e)
                        }
                    });
                }
                function allRead(event){
                    event.preventDefault();
                        $.ajax({
                            url: "{{ route('markAllRead') }}",
                            type: "get",
                            dataType: 'json',
                            cache: false,
                            async:false,
                            success: function(data) {
                                get_all_notifications();
                                // $('.message-item').remove();

                            },
                            failure: function(errMsg) {
                                console.log(errMsg);
                            }
                        });

                    };

            </script>

</body>

</html>
