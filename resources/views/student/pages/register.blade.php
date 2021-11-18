<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="{{ env('GOOGLE_CLIENT_ID') }}">
    <title>Login-Pages</title>
    <!-- CSS only -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--favicon --->
    <link href="{{ asset('assets/images/ico/side-icons.png') }}" rel="icon">
    <!-- bootstrap end -->
    <!--  -->
    <link href="../assets/css/registerpage.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/demo.css">
    <link rel="stylesheet" href="../assets/css/intlTelInput.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!-- style css -->
    <link href="../assets/css/registration.css" rel="stylesheet">

    <!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/countrySelect.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/country_flag.css') }}"> --}}
    <!-- Year Picker CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/yearpicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/multiselect.css') }}" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Dropify CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dropify.css') }}" />
    <link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">

    <!-- Moment Js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0rc.0/dist/js/select2.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>


    <style>
        .error {
            color: red !important;
            font-weight: 500;
        }

        .cust_link {
            font-size: 16px;
            font-family: Poppins;
        }

        .cust_link:hover {

            text-decoration: none;
        }

        .select2-container .select2-selection--single {
            height: 46px;
            width: 100% !important;

        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 11px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 47px;
        }

        .select2 {
            width: 100% !important;
        }

        .is-invalid {
            color: red;
            border-color: red;
        }

        ul {
            padding-left: 20px;
        }

        ul li {
            list-style-type: none;
        }

        ul.bs-autocomplete-menu {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            max-height: 200px;
            overflow: auto;
            z-index: 9999;
            border: 1px solid #eeeeee;
            border-radius: 4px;
            background-color: #fff;
            box-shadow: 0px 1px 6px 1px rgba(0, 0, 0, 0.4);
        }

        ul.bs-autocomplete-menu a {
            font-weight: normal;
            color: #333333;
        }

        .ui-helper-hidden-accessible {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        .ui-state-active,
        .ui-state-focus {
            color: #23527c;
            background-color: #eeeeee;
        }

        .bs-autocomplete-feedback {
            width: 1.5em;
            height: 1.5em;
            overflow: hidden;
            margin-top: .5em;
            margin-right: .5em;
        }

        .loader {
            font-size: 10px;
            text-indent: -9999em;
            width: 1.5em;
            height: 1.5em;
            border-radius: 50%;
            background: #333;
            background: -moz-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
            background: -webkit-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
            background: -o-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
            background: -ms-linear-gradient(left, #333333 10%, rgba(255, 255, 255, 0) 42%);
            background: linear-gradient(to right, #333333 10%, rgba(255, 255, 255, 0) 42%);
            position: relative;
            -webkit-animation: load3 1.4s infinite linear;
            animation: load3 1.4s infinite linear;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
        }

        .loader:before {
            width: 50%;
            height: 50%;
            background: #333;
            border-radius: 100% 0 0 0;
            position: absolute;
            top: 0;
            left: 0;
            content: '';
        }

        .loader:after {
            background: #fff;
            width: 75%;
            height: 75%;
            border-radius: 50%;
            content: '';
            margin: auto;
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        @-webkit-keyframes load3 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes load3 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        .stat {
            border: 1px solid transparent;
            transition: 0.3s all ease;

        }

        .stat:hover {
            border: 1px solid #007bff;
            color: #007bff;
        }

    </style>

</head>

<body>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0&appId={{env('FACEBOOK_APP_ID')}}&autoLogAppEvents=1" nonce="i0UN3OzF"></script>


    <section id="body">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="" style="position: sticky;top: 10%;">
                        <div class="login-logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo">
                            </a>
                        </div>
                        <div class="text">
                            <p class="learn">Learn from the best tutors</p>
                            <p class="time"> Anytime, Anywhere</p>
                        </div>
                        <div class="Register mt-4">

                            Register yourself on Tutorvy and learn or teach anything <br /> from anywhere.
                        </div>
                        <div style="margin-top: 70px;" class="  nav-hide">
                            <img src="../assets/images/login-image/loginImage.png" style="width: 90%;">
                        </div>
                    </div>

                </div>
                <div class="col-md-6 card">
                    <p class="mt-5 ml-3 heading-first">Create a student account</p>
                    <p class="ml-3 heading-sixth">Already have an account?
                        <a href="{{ route('login') }}" class="text-primary" style="text-decoration:none">
                            Sign in
                        </a>
                    </p>

                    <div class="row stu_reg mt-5">
                        <div class="col-md-12 mb-3 mt-3">
                            <div class="nav nav-pills text-center border" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active w-50 stat" id="v-pills-General-tab" role="tab"
                                    href="{{ route('student.register') }}" aria-selected="true">As a Student</a>
                                <a class="nav-link w-50 stat " id="v-pills-Security-tab" href="{{ route('register') }}"
                                    role="tab" aria-selected="false">As a Tutor</a>
                            </div>
                        </div>

                        <div class="col-md-12">

                            <form action="{{ url('register') }}" method="post" id="register"
                                enctype="multipart/form-data" onsubmit="return false" autocomplete="off">
                                @csrf
                                <input type="hidden" name="role" value="3">
                                <input type="hidden" name="region" id="region">
                                <input type="hidden" name="time_zone" id="time_zone">
                                <div class="tab-content">
                                    <div role="tabpanel" class="border-right tab-pane active" id="step-1">
                                        <div class="col-md-12">
                                            <p class="heading-third">Personal information </p>
                                            @if (Session::has('error'))
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close" style="margin-top:-12px">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    {{ Session::get('error') }}
                                                </div>
                                            @endif
                                            <div class="row mt-5">
                                                <div class="input-text col-md-6 d-block">
                                                    <input type=""
                                                        class="form-control csd  @error('first_name') is-invalid @enderror"
                                                        name="first_name" id="fname" placeholder="First Name"
                                                        value="{{ $user->first_name ?? '' }}"
                                                        style="text-transform: capitalize;">
                                                    <span for="" id="fname_error" class="invalid-feedback" role="alert">
                                                        <strong> This field is required </strong>
                                                    </span>

                                                    @error('first_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                                <div class="input-text col-md-6 d-block">
                                                    <input type=""
                                                        class="form-control @error('last_name') is-invalid @enderror"
                                                        name="last_name" placeholder="Last Name"
                                                        value="{{ $user->last_name ?? '' }}" id="lname"
                                                        style="text-transform: capitalize;">
                                                    <!-- <label for="" id="lname_error" class="text-red"><strong> This field is required </strong>  </label> -->
                                                    <span for="" id="lname_error" class="invalid-feedback" role="alert">
                                                        <strong> This field is required </strong>
                                                    </span>
                                                    @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="input-text col-md-12 m-0 p-0 mt-3 d-block">
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" placeholder="Email Address"
                                                    value="{{ $user->email ?? '' }}" id="email">
                                                <!-- <label for="" id="email_error" class="text-red"><strong> This field is required </strong>  </label> -->
                                                <span for="" id="email_error" class="invalid-feedback" role="alert">
                                                    <strong> This field is required </strong>
                                                </span>
                                                <span for="" id="email_error_duplicate" class="invalid-feedback"
                                                    role="alert">
                                                    <strong> This email already exists. <a
                                                            href="{{ route('login') }}" class="text-primary"
                                                            style="text-decoration:none">Log in?</a> </strong>
                                                </span>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="input-text col-md-12 m-0 p-0 mt-3  d-block">
                                                <input type="password" name="password" class="form-control "
                                                    placeholder="Password" id="password">
                                                <!-- <label for="" id="password_error" class="text-red"><strong> This field is required </strong>  </label> -->
                                                <small id="passTech">
                                                    <!-- Field should have at least: -->
                                                    <div class="row mt-3">
                                                        <div class="col-md-6">
                                                            <ul>
                                                                <li id="capital_letter"><i class="fa fa-times"></i>
                                                                    One uppercase letter</li>
                                                                <li id="lower_letter"><i class="fa fa-times"></i> One
                                                                    lowercase letter</li>
                                                                <li id="numeric"><i class="fa fa-times"></i> One
                                                                    numeric value</li>

                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <ul>
                                                                <li id="special_character"><i
                                                                        class="fa fa-times"></i> One special
                                                                    character</li>
                                                                <li id="min_character"><i class="fa fa-times"></i> 8
                                                                    characters</li>
                                                            </ul>
                                                        </div>
                                                    </div>

                                                </small>
                                                <span for="" id="password_error" class="invalid-feedback" role="alert">
                                                    <strong> This field is required </strong>
                                                </span>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- <button id="finish"  type="submit"
                                                class="btn btn-lg btn-registration schedule-btn  nextBtn pull-right  ">
                                                    Join 
                                            </button> -->
                                            <button id="finish"  type="submit"
                                                class="schedule-btn  nextBtn">
                                                    Join Now
                                            </button>
                                        </div>

                                        <!-- <div class="col-md-12 text-right">

                                            <div class="social-Icon">
                                                @if (Session::has('error'))
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        {{ Session::get('error') }}
                                                    </div>
                                                @endif
                                                <div class="row mt-4" >
                                                   
                                                    <div class="col-md-6">
                                                        <div class="Google">
                                                            <a href="{{route('social.google',[3])}}">
                                                                <img class="mr-3" src="{{asset('assets/images/ico/google.png')}}" alt="google">
                                                                Continue with Google
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="facebook">
                                                            <a href="{{route('social.facebook',[3])}}">
                                                                <i class="fa fa-facebook  fa-lg mr-2" aria-hidden="true"></i>
                                                                Continue with Facebook
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="Policy-text" style="display: flex;">
                                                    <p class="text-left">
                                                        Protected by reCAPTCHA and subject to the Google
                                                        <a href="#">Privacy Policy</a> and <a href="#">Terms and Conditions</a>
                                                    
                                                    </p>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-md-12 text-right">
                                            <div class="social-Icon">
                                                @if (Session::has('error'))
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                        role="alert">
                                                        <button type="button" class="close"
                                                            data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        {{ Session::get('error') }}
                                                    </div>
                                                @endif
                                                <div class="row mt-4">

                                                    <div class="col-md-6">
                                                        <div class="g-signin2 mt-3 text-center"
                                                            data-onsuccess="onSignIn" data-width="250" data-height="40">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mt-4">
                                                        <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></div>
                                                    </div>
                                                </div>
                                                <div class="Policy-text" style="display: flex;">
                                                    <p class="text-left">
                                                        Protected by reCAPTCHA and subject to the Google
                                                        <a href="#">Privacy Policy</a> and <a href="#">Terms and Conditions</a>
                                                    
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <!-- <div role="tabpanel" class="tab-pane border-right" id="step-2"
                                            style="padding-bottom: 100px;background-color: white;">
                                            <div class="col-md-12 ">
                                                <p class="heading-third mt-3">Educational information </p>
                                                <div class=" customer_records mt-5">
                                                    <div class="row">
                                                        <div class="input-text col-md-12">
                                                            <select name="degree"
                                                                class="form-select form-select-lg mb-3">
                                                                <option value="">Degree</option>
                                                            @foreach($degrees as $degree)
                                                                    <option value="{{$degree->id}}">{{$degree->name}}</option>
                                                            @endforeach
                                                            </select>
                                                            <select name="std_grade"
                                                                class="form-select form-select-lg mb-3">
                                                                <option value="" disabled selected>Which grade you are in?</option>

                                                                    <option value="1">Pre Elementary School</option>
                                                                    <option value="2">Elementary School</option>
                                                                    <option value="3">Secondary School</option>
                                                                    <option value="4">High School</option>
                                                                    <option value=" 5"> Post Secondary</option>

                                                            </select>
                                                        </div>
                                        </div>-->
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

    </section>
    <script>

        function signOut() {
            var auth2 = gapi.auth2.getAuthInstance();
            auth2.signOut().then(function () {
            console.log('User signed out.');
            });
        }
        window.onload = function() {
            signOut();
        };
        function onSignIn(googleUser) {
            var profile = googleUser.getBasicProfile();
            var firstName = profile.getName().split(' ').slice(0, -1).join(' ');
            var lastName = profile.getName().split(' ').slice(-1).join(' ');

            $.ajax({
                url: "{{ route('social.google', [3]) }}",
                dataType: "json",
                type: "Post",
                async: true,
                data: {
                    _token: "{{ csrf_token() }}",
                    first_name: firstName,
                    last_name: lastName,
                    email: profile.getEmail(),
                    picture: profile.getImageUrl(),
                    provider: 'google',
                    role: 3
                },
                success: function(data) {
                    if(data.status == 200){
                        window.location.href = window.location.origin+data.url
                    }
                },

            });
        }


        FB.ui({
        method: 'share',
        href: 'https://developers.facebook.com/docs/'
        }, function(response){});
        FB.login(function(response) {
    if (response.authResponse) {
     console.log('Welcome!  Fetching your information.... ');
     FB.api('/me', function(response) {
       console.log('Good to see you, ' + response.name + '.');
     });
    } else {
     console.log('User cancelled login or did not fully authorize.');
    }
});


    </script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/ui-autocomplete.js') }}"></script>
    <script src="{{ asset('assets/js/countrySelect.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/intlTelInput.js') }}"></script>
    <script src="{{ asset('assets/js/registration.js') }}"></script>
    <script src="{{ asset('assets/js/yearpicker.js') }}"></script>
    <script src="{{ asset('assets/js/languages.js') }}"></script>
    <script src="{{ asset('assets/js/googleapi.js') }}"></script>
    <script src="{{ asset('assets/js/multiselect.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.js') }} "></script>
    <script>
        $(document).ready(function() {

                    var date = new Date();
                    $("#region").val(date);
                    const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                    $("#time_zone").val(timezone);

                    for (var i = 1; i <= 31; i++) {
                        $("#day").append("<option value='" + i + "'" + (i == {{ $user->day ?? 1 }} ? 'selected' : '') +
                            ">" + i +
                            "</option>");
                    }


                    $("#password").focus(function(e) {
                        $("#passTech").show("slow");
                    });

                    $("#password").focusout(function(e) {
                        $("#passTech").hide("slow");
                    });

                    $("#password").keyup(function(e) {

                        var capital_leters = new RegExp('[A-Z]');
                        var lower_leters = new RegExp('[a-z]');
                        var numeric = new RegExp('[0-9]');
                        var password = $(this).val();

                        if (password.match(capital_leters)) {
                            $("#capital_letter").css('color', 'green');
                            $("#capital_letter").find(".fa").removeClass("fa-times");
                            $("#capital_letter").find(".fa").addClass("fa-check");
                            $('#register').removeAttr('onsubmit');
                        } else {
                            $("#capital_letter").css('color', 'red');
                            $("#capital_letter").find(".fa").removeClass("fa-check");
                            $("#capital_letter").find(".fa").addClass("fa-times");
                            var attr = $('#register').attr('onsubmit');

                            if (typeof attr !== 'undefined' && attr !== false) {
                                $('#register').removeAttr('onsubmit');
                            } else {
                                $('#register').attr('onsubmit', 'return false');
                            }
                        }

                        if (password.match(lower_leters)) {
                            $("#lower_letter").css('color', 'green');
                            $("#lower_letter").find(".fa").removeClass("fa-times");
                            $("#lower_letter").find(".fa").addClass("fa-check");
                            $('#register').removeAttr('onsubmit');
                        } else {
                            $("#lower_letter").css('color', 'red');
                            $("#lower_letter").find(".fa").addClass("fa-times");
                            $("#lower_letter").find(".fa").removeClass("fa-check");
                            var attr = $('#register').attr('onsubmit');

                            if (typeof attr !== 'undefined' && attr !== false) {
                                $('#register').removeAttr('onsubmit');
                            } else {
                                $('#register').attr('onsubmit', 'return false');
                            }
                        }

                        if (password.match(numeric)) {
                            $("#numeric").css('color', 'green');
                            $("#numeric").find(".fa").removeClass("fa-times");
                            $("#numeric").find(".fa").addClass("fa-check");
                            $('#register').removeAttr('onsubmit');
                        } else {
                            $("#numeric").css('color', 'red');
                            $("#numeric").find(".fa").addClass("fa-times");
                            $("#numeric").find(".fa").removeClass("fa-check");
                            var attr = $('#register').attr('onsubmit');

                            if (typeof attr !== 'undefined' && attr !== false) {
                                $('#register').removeAttr('onsubmit');
                            } else {
                                $('#register').attr('onsubmit', 'return false');
                            }
                        }

                        if (password.length > 8) {
                            $("#min_character").css('color', 'green');
                            $("#min_character").find(".fa").removeClass("fa-times");
                            $("#min_character").find(".fa").addClass("fa-check");
                            $('#register').removeAttr('onsubmit');
                        } else {
                            $("#min_character").css('color', 'red');
                            $("#min_character").find(".fa").addClass("fa-times");
                            $("#min_character").find(".fa").removeClass("fa-check");
                            var attr = $('#register').attr('onsubmit');

                            if (typeof attr !== 'undefined' && attr !== false) {
                                $('#register').removeAttr('onsubmit');
                            } else {
                                $('#register').attr('onsubmit', 'return false');
                            }
                        }

                        var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

                        if (format.test(password)) {
                            $("#special_character").css('color', 'green');
                            $("#special_character").find(".fa").removeClass("fa-times");
                            $("#special_character").find(".fa").addClass("fa-check");
                            $('#register').removeAttr('onsubmit');
                        } else {
                            $("#special_character").css('color', 'red');
                            $("#special_character").find(".fa").addClass("fa-times");
                            $("#special_character").find(".fa").removeClass("fa-check");
                            var attr = $('#register').attr('onsubmit');

                            if (typeof attr !== 'undefined' && attr !== false) {
                                $('#register').removeAttr('onsubmit');
                            } else {
                                $('#register').attr('onsubmit', 'return false');
                            }
                        }

                    });





                    $("#email").change(function() {
                        let email = $(this).val();
                        // alert(email);
                        $.ajax({
                            url: "{{ route('validate.email') }}",
                            data: {
                                email: email
                            },
                            success: function(result) {
                                if (result == "Trust me") {
                                    $("#email_error_duplicate").show();
                                    // $("#email_error_duplicate").focus();
                                    $("#email").addClass("is-invalid");
                                    $("#email_error").hide();

                                } else {
                                    $("#email_error_duplicate").hide();
                                    $("#email").removeClass("is-invalid");
                                }
                            }
                        });

                    });
            });
    </script>

</body>

</html>
