<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutorvy</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <!--favicon --->
    <link href="{{ asset('assets/images/ico/side-icons.png') }}" rel="icon">
    <!-- bootstrap link -->

    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <!-- fonawsome -->
    <link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/calender.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/countrySelect.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dropify.css') }}" />
    <link href="{{ asset('assets/css/chat.css') }}" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!--Plugin CSS file with desired skin-->
    <link rel="stylesheet" href="{{ asset('assets/css/ion.rangeSlider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/emojionearea.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Styles -->
    @include('student.layouts.css')
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
    <div class="wrapper" id="wrapper">
        <input type="hidden" class="user_id" value={{ Auth::user()->id }}>
        <input type="hidden" class="user_role_id" value={{ Auth::user()->role }}>
        <!-- side navbar -->

        @include('student.layouts.sidebar')
        <!-- seide navbar end -->
        <div class="content" style="width: 100%;background-color: #FBFBFB !important;">
            @include('student.layouts.navbar')
            <!-- Main-->
            @yield('content')

        <div>

    </div>
     <!-- custom js -->
     <script src="{{ asset('js/app.js') }}"></script>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
     <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
     <script src="{{ asset('assets/js/mobile.js') }}"></script>
     <script src="{{ asset('assets/js/history.js') }}"></script>
     <script src="{{ asset('assets/js/subject.js') }}"></script>
     <script src="{{ asset('assets/js/languages.js') }}"></script>

     <script src="{{ asset('assets/js/homePage.js') }}"></script>
     <script src="{{ asset('assets/js/registration.js') }}"></script>
     <script src="{{ asset('assets/js/dropify.js')}}"></script>
     <script src="{{ asset('assets/js/multiselect.js')}}"></script>
     <script src="https://cdn.jsdelivr.net/npm/easytimer@1.1.1/dist/easytimer.min.js"></script>
     <script src="{{ asset('assets/js/jquery.validate.js')}}"></script>
     <script src="{{ asset('assets/js/countrySelect.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.2.7/emojionearea.min.js"></script>

    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-storage.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <!-- <script src="{{asset('assets/firebase/index.js').'?ver='.rand()}}"></script> -->
    @include('firebase')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.5/ace.js" type="text/javascript" charset="utf-8"></script>


    </script>
        <!--Plugin JavaScript file-->
        <script src="{{ asset('assets/js/ion.rangeSlider.js')}}"></script>

     @yield('scripts')
     @include('js_files.student.supportJs')
     <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $(document).ready(function(){
        $('.table').DataTable();
        get_all_notifications();
        $(".mk").hide();
        $(".vc").hide();
        $(".dropify").dropify();
        $('.js-multiSelect').select2();
        $('.accSelect2').select2();
        $('.form-select').select2();
        // $("#year").yearpicker({
        //         year: {{$user->year ?? '1990'}},
        //         startYear: 1950,
        //         endYear: 2050,
        //     });
        $(".js-range-slider").ionRangeSlider({
            type: "double",
            min: 0,
            max: 100,
            from: 0,
            to: 20,
            grid: true,
            prefix: "$"
        });
        $(".age-range-slider").ionRangeSlider({
            type: "double",
            min: 18,
            max: 70,
            from: 18,
            to: 70,
            grid: true,
        });
        $("#msg").emojioneArea({
                pickerPosition: "top",
                saveEmojisAs:"shortname"
            });
          /* Table Sorting */

        //   $("th").append('<i class="ml-1 fa fa-sort"></i>');
        //      $("th:last-child").css("color",'white');

        //     const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

        //     const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
        //         v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
        //         )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

        //     document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
        //         const table = th.closest('table');
        //         Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
        //             .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        //             .forEach(tr => table.appendChild(tr) );
        //     })));


            /* Table Sorting */
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
                })




                })

                $('.dd').click(function() {
                    $('.dd2').toggle('hide');
                    $(".notification-menu ").hide();

                });
                $('.notification').click(function() {
                    $('.dd2').hide();

                });
                $(".content-wrapper").click(function() {
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


                $("#country_selector").countrySelect({
                    defaultCountry: "{{ $user->country_short ?? '' }}",
                    preferredCountries: ['ca', 'gb', 'us', 'pk']
                });

                $("#country_selector").on('change', function() {
                    var short = $(this).countrySelect("getSelectedCountryData");
                    $("#country_short").val(short.iso2);
                });

                $("#register").validate({
                    rules: {
                        // compound rule
                        email: {
                            required: true,
                            email: true,
                            remote: {
                                url: "{{ route('available.email') }}",
                                type: "post",
                                data: {
                                    _token: function() {
                                        return "{{ csrf_token() }}"
                                    },
                                }
                            }
                        },
                        password: {
                            required: true,
                        },
                        first_name: {
                            required: true
                        },
                        last_name: {
                            required: true
                        },

                    },
                    messages: {
                        email: {
                            required: "We need your email address to contact you",
                            email: "Your email address must be in the format of name@domain.com"
                        }
                    }
                });

                function langshort(opt) {
                    var val = opt.options[opt.selectedIndex].innerHTML;
                    $("#lang").val(val)
                }

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
                            // console.log(obj , "asd");
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
                                    $('.show_notification_counts').css("display", "none");

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
                                                `<img class="profile-img w-100 p-0 mt-2" src="{{ asset('`+obj[i].sender_pic+`') }}" alt="layer">`;
                                        } else {
                                            img =
                                                `<img class="profile-img w-100 p-0 mt-2" src="{{ asset('assets/images/ico/Square-white.jpg') }}" alt="layer">`;
                                        }
                                        notification += `
            <li>

                    <div class="row bgm" >
                        <div class="col-md-2 text-center pr-0">
                        <a href="` + obj[i].slug + `" class="">
                            ` + img + `
                        </a>
                        </div>
                        <div class="col-md-10">
                            <a href="` + obj[i].slug + `" class="">
                                <div class="head-1-noti">
                                    <span class="notification-text6">
                                        <strong>` + obj[i].noti_title + ` </strong>
                                        ` + obj[i].noti_desc + `
                                    </span>
                                </div>
                                <span class="notification-time">
                                </span>
                            </a>
                        </div>
                    </div>
            </li>`;
                                    }
                                    $(".show_all_notifications").html(notification);
                                }

                            } else {
                                notification += `<span> No Notification </span>`;
                            }
                        },
                        error: function(e) {
                            console.log(e)
                        }
                    });
                }

                function allRead(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "{{ route('markAllRead') }}",
                        type: "get",
                        dataType: 'json',
                        cache: false,
                        async: false,
                        success: function(data) {
                            get_all_notifications();
                            // $('.message-item').remove();

                        },
                        failure: function(errMsg) {
                            console.log(errMsg);
                        }
                    });

                };


                function langshort(opt) {
                    var val = opt.options[opt.selectedIndex].innerHTML;
                    $("#lang").val(val)
                }

                function hideCard() {
                    // alert();
                    $(".infoCard").hide('slow');
                };
            </script>

</body>

</html>
