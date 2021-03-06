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
    <link rel="stylesheet" href="assets/css/countrySelect.css">
    {{-- <link rel="stylesheet" href="assets/css/country_flag.css"> --}}
    <!-- Year Picker CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/yearpicker.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/multiselect.css') }}" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Dropify CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dropify.css') }}" />
    <link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Moment Js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0rc.0/dist/js/select2.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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

        .form-check-input {
            height: auto !important;
            width: auto !important;
        }

        .form-check-label {
            margin-left: 20px;
        }

        .stat {
            border: 1px solid transparent;
            transition: 0.3s all ease;

        }

        .stat:hover {
            border: 1px solid #007bff;
            color: #007bff;
        }
        #passTech{
            display:none;
        }

    </style>

</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v12.0&appId={{env('FACEBOOK_APP_ID')}}&autoLogAppEvents=1" nonce="i0UN3OzF"></script>

    <section id="body">
        <div class="container">
            <div class="row">
                <div class="col-md-6 nav-hide">
                    <div class="" style="position: sticky;top: 10%;">
                        <div class="login-logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo">
                            </a>
                        </div>
                        <div class="text">
                            <p class="learn">Teach anytime at best rate</p>
                            <!-- <p class="time"> Anytime, Anywhere</p> -->
                        </div>
                        <div class="Register mt-4">

                            Register yourself on Tutorvy and teach anything <br /> from anywhere.
                        </div>
                        <div style="margin-top: 70px;">
                            <img src="../assets/images/login-image/loginImage.png" style="width: 90%;">
                        </div>
                    </div>

                </div>
                <div class="col-md-6 card ">
                    <p class="mt-4 ml-3 heading-first">Create a tutor account</p>
                    <p class="ml-3 heading-sixth">Already have an account?
                        <a href="{{ route('login') }}" class="text-primary" style="text-decoration:none">
                            Sign in
                        </a>
                    </p>

                    <div class="row mt-5">
                        <div class="col-md-12 mb-3 mt-3">
                            <div class="nav nav-pills text-center border" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link  w-50 stat" id="v-pills-General-tab"
                                    href="{{ route('student.register') }}" role="tab" aria-selected="false">As a
                                    Student</a>
                                <a class="nav-link w-50 stat active" id="v-pills-Security-tab"
                                    href="{{ route('register') }}" role="tab" aria-selected="true">As a Teacher</a>
                            </div>
                        </div>
                        <div class="col-md-12 stu_reg">
                            <!-- <div class="board">
                                <ul class="nav nav-tabs">
                                    <div class="liner"></div>
                                    <li rel-index="0" class="bordr-none active">
                                        <a href="#step-1" aria-controls="step-1" role="tab" data-toggle="tab">
                                            <span>
                                                <img class="mb-3" src="../assets/images/ico/profile-ico.png" alt="img">
                                            </span>
                                        </a>
                                        <p class="register-content">Personal</p>
                                    </li>
                                    <li rel-index="1" class="bordr-none">
                                        <a href="#step-2" class=" disabled" aria-controls="step-2" role="tab"
                                            data-toggle="tab">
                                            <span>
                                                <img class="mb-3" src="../assets/images/ico/bag-icon.png"
                                                    alt="bag-icon">
                                            </span>
                                        </a>
                                        <p class="register-content">Educational</p>
                                    </li>
                                    <li rel-index="2" class="bordr-none">
                                        <a href="#step-3" class=" disabled" aria-controls="step-3" role="tab"
                                            data-toggle="tab">
                                            <span>
                                                <img class="mb-3" src="../assets/images/ico/cap-icon.png"
                                                    alt="cap-icon">
                                            </span>
                                        </a>
                                        <p class="register-content">Professional</p>
                                    </li>
                                    <li rel-index="2" class="bordr-none">
                                        <a href="#step-4" class=" disabled" aria-controls="step-4" role="tab"
                                            data-toggle="tab">
                                            <span>
                                                <img class="mb-3" src="../assets/images/ico/cricle-icon.png"
                                                    alt="cricle-icon">
                                            </span>
                                        </a>
                                        <p class="register-content">Complete</p>
                                    </li>
                                </ul>
                            </div> -->
                            <form action="{{ url('register') }}" method="post" id="register"
                                enctype="multipart/form-data" onsubmit="return false" autocomplete="off">
                                @csrf
                                <input type="hidden" name="role" value="2">
                                <input type="hidden" name="region" id="region">
                                <input type="hidden" name="time_zone" id="time_zone">
                                <div class="tab-content">
                                    <div role="tabpanel" class="border-right tab-pane active" id="step-1">
                                        <div class="col-md-12">
                                            <p class="heading-third ">Personal information</p>
                                            @if (Session::has('error'))
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close" style="margin-top:-12px">
                                                        <span aria-hidden="true">??</span>
                                                    </button>
                                                    {{ Session::get('error') }}
                                                </div>
                                            @endif
                                            <div class="row mt-5">
                                                <div class="input-text col-md-6 d-block">
                                                    <input type="" class="form-control csd" name="first_name"
                                                        placeholder="First Name"
                                                        value="{{ $user->first_name ?? '' }}" id="fname"
                                                        style="text-transform: capitalize;">
                                                    <span for="" id="fname_error" class="invalid-feedback" role="alert">
                                                        <strong> This field is required </strong>
                                                    </span>
                                                    <!-- <label for="" id="fname_error" class="text-red"><strong> This field is required </strong>  </label> -->
                                                    {{-- @error('first_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{$message}}</strong>
                                                        </span>
                                                    @enderror --}}

                                                </div>
                                                <div class="input-text col-md-6 d-block">
                                                    <input type=""
                                                        class="form-control @error('last_name') is-invalid @enderror"
                                                        name="last_name" placeholder="Last Name"
                                                        value="{{ $user->last_name ?? '' }}" id="lname"
                                                        style="text-transform: capitalize;">
                                                    <span for="" id="lname_error" class="invalid-feedback" role="alert">
                                                        <strong> This field is required </strong>
                                                    </span>
                                                    @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="input-text col-md-12 m-0 mt-3 d-block">
                                                    <input type="email"
                                                        class="form-control  @error('email') is-invalid @enderror"
                                                        name="email" placeholder="Email Address"
                                                        value="{{ $user->email ?? '' }}" id="email">
                                                    <span for="" id="email_error" class="invalid-feedback" role="alert">
                                                        <strong> This field is required </strong>
                                                    </span>
                                                    <span for="" id="email_error_duplicate" class="invalid-feedback"
                                                        role="alert">
                                                        <strong> This email already exists. <a
                                                                href="{{ route('login') }}" class="text-primary"
                                                                style="text-decoration:none">Log in?</a> </strong>
                                                    </span>
                                                    <!-- <label for="" id="email_error" class="text-red"><strong> This field is required </strong>  </label> -->
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="input-text col-md-12 m-0  mt-3  d-block">
                                                    <input type="password" name="password" class="form-control "
                                                        placeholder="Password" id="password">
                                                    <!-- <label for="" id="password_error" class="text-red"><strong> This field is required </strong>  </label> -->
                                                    <small id="passTech">
                                                        <!-- Field should have at least:
                                                            <ul>
                                                                <li id="capital_letter"><i class="fa fa-times"></i> One uppercase letter</li>
                                                                <li id="lower_letter"><i class="fa fa-times"></i> One lowercase letter</li>
                                                                <li id="numeric"><i class="fa fa-times"></i> One numeric value</li>
                                                                <li id="special_character"><i class="fa fa-times"></i> One special character</li>
                                                                <li id="min_character"><i class="fa fa-times"></i> 8 characters</li>
                                                            </ul> -->
                                                        <div class="row mt-3">
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li id="capital_letter"><i
                                                                            class="fa fa-times"></i> One uppercase
                                                                        letter</li>
                                                                    <li id="lower_letter"><i class="fa fa-times"></i>
                                                                        One lowercase letter</li>
                                                                    <li id="numeric"><i class="fa fa-times"></i> One
                                                                        numeric value</li>

                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <ul>
                                                                    <li id="special_character"><i
                                                                            class="fa fa-times"></i> One special
                                                                        character</li>
                                                                    <li id="min_character"><i
                                                                            class="fa fa-times"></i> 8 characters
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </small>
                                                    <span for="" id="password_error" class="invalid-feedback"
                                                        role="alert">
                                                        <strong> This field is required </strong>
                                                    </span>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12 text-right mt-3">

                                                    <!-- <button id="finish" type="submit"
                                                        class="btn btn-lg btn-registration schedule-btn  nextBtn pull-right  ">
                                                        &nbsp; Join &nbsp;
                                                    </button> -->
                                                    <button id="finish"  type="submit"
                                                        class="schedule-btn  ">
                                                            Join Now
                                                    </button>
                                                </div>

                                                <div class="col-md-12 text-right">

                                                    <div class="social-Icon ">
                                                        <div id="status"></div>
                                                        <div class="row mt-4">
                                                            <div class="col-md-6">
                                                                <div class="g-signin2 mt-3 text-center"
                                                                    data-onsuccess="onSignIn"
                                                                    data-width="250"
                                                                    data-text="signin_with"
                                                                    data-shape="rectangular"
                                                                    data-height="40"
                                                                    data-logo_alignment="center"
                                                                    >
                                                                </div>

                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="facebook">
                                                                    <a href="javascript:void(0);" style="text-decoration:none" onclick="fbLogin();" id="fbLink">
                                                                    <i class="fa fa-facebook fa-lg mr-2" aria-hidden="true"></i>
                                                                    Continue with Facebook
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="Policy-text" style="display: flex;">
                                                            <p  class="text-left">
                                                                        Protected by reCAPTCHA and subject to the Google
                                                                        <a href="#">Privacy Policy</a> and <a href="#">Terms and Conditions</a>

                                                                    </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <!-- <p class="heading-fifth">Date of Birth</p>
                                            <div class="row mt-4 mb-3">
                                                <div class="col-md-4">
                                                    <select class="form-select form-select-lg" id="day"
                                                        name="day"></select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-select form-select-lg" name="month"
                                                        aria-label=".form-select-lg example">
                                                        <option value="Jan" @if (isset($user) && $user->month == 'Jan')  @endif>January</option>
                                                        <option value="Feb" @if (isset($user) && $user->month == 'Feb')  @endif>February</option>
                                                        <option value="Mar" @if (isset($user) && $user->month == 'Mar')  @endif>March</option>
                                                        <option value="Apr" @if (isset($user) && $user->month == 'Apr')  @endif>April</option>
                                                        <option value="May" @if (isset($user) && $user->month == 'May')  @endif>May</option>
                                                        <option value="Jun" @if (isset($user) && $user->month == 'Jun')  @endif>June</option>
                                                        <option value="Jul" @if (isset($user) && $user->month == 'Jul')  @endif>July</option>
                                                        <option value="Aug" @if (isset($user) && $user->month == 'Aug')  @endif>August</option>
                                                        <option value="Sep" @if (isset($user) && $user->month == 'Sep')  @endif>September</option>
                                                        <option value="Oct" @if (isset($user) && $user->month == 'Oct')  @endif>October</option>
                                                        <option value="Nov" @if (isset($user) && $user->month == 'Nov')  @endif>November</option>
                                                        <option value="Dec" @if (isset($user) && $user->month == 'Dec')  @endif>December</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="" name="year" class=" yearpicker form-control"
                                                        placeholder="Year" id="year" value="">

                                                </div>

                                            </div> -->
                                            <!-- <div class="row">
                                                <div class="col-md-12 mt-3 mb-3">
                                                    <input id="phone" name="phone" type="tel"
                                                        value="{{ $user->phone ?? '' }}" placeholder="Phone Number">
                                                        <span for="" id="phone_error"  class="invalid-feedback" role="alert">
                                                            <strong> This field is required </strong>
                                                        </span>
                                                        <label for="" id="phone_error" class="text-red"><strong> This field is required </strong>  </label>
                                                    @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                                    <script src="{{ asset('assets/js/intlTelInput.js') }}"></script>
                                                    <script>
                                                        var input = document.getElementById("phone");
                                                        window.intlTelInput(input, {
                                                            utilsScript: "assets/js/utils.js",
                                                        });
                                                    </script>
                                                </div>
                                            </div> -->

                                            <!-- city dropdwon -->
                                            <!-- <div class="row ">
                                                <div class="input-text col-md-12 mb-2 d-block">
                                                    <input type="" name="address"
                                                        class="form-control  "
                                                        placeholder="Address" id="address">
                                                </div>
                                                <div class="input-text col-md-6 mt-2 ">
                                                    <div class="autocomplete mt-1" style="width:300px;">
                                                        <input id="myInput" type="" name="city" placeholder="City"
                                                            value="{{ $user->city ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="input-text col-md-6 mt-2 ">
                                                    <div class="form-item" style="width:300px;">
                                                        <input id="country_selector" name="country" type="">
                                                        <input id="country_short" name="country_short" type="" hidden>
                                                        <label for="country_selector" style="display:none;">Select a
                                                            country here...</label>
                                                    </div>

                                                </div> -->
                                            <!-- <div class="container mt-3">
                                                    <div class=" row">
                                                        <div class="input-text col-md-6">
                                                            <select id="selection" name="security"
                                                                onchange="changeplh()"
                                                                class="form-select form-select-lg mb-3 "
                                                                aria-label=".form-select-lg example">
                                                                <option value="1" @if (isset($user) && $user->type == 1) selected @endif>ID card
                                                                    number</option>
                                                                <option value="2" @if (isset($user) && $user->type == 2) selected @endif>Social
                                                                    security number</option>
                                                            </select>
                                                        </div>
                                                        <div class="input-text col-md-6">
                                                            <input id="textbox" type="number" @if (isset($user) && $user->type == 1) name="cnic" @else name="security" @endif class="form-control"
                                                                placeholder="ID card number"
                                                                value="{{ $user->cnic_security ?? '' }}">
                                                        </div>
                                                    </div>
                                                </div> -->
                                            <!-- <div class="container mt-3">
                                                    <div class="row">
                                                        <div class="col-md-6 d-block">
                                                            <input type="" name="language" id="lang" hidden>
                                                            <select class="form-select form-select-lg mb-3"
                                                                id="languages-list" name="lang_short"
                                                                onchange="langshort(this)">
                                                                    <option value="" disable="" selected> Preffered Language</option>
                                                            </select>
                                                            <span for="" id="language_error" class="invalid-feedback" role="alert">
                                                                <strong> This field is required </strong>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-6 d-block">
                                                            <select
                                                                class="form-select form-select-lg mb-3  @error('gender') is-invalid @enderror"
                                                                aria-label=".form-select-lg example" name="gender" id="gender">
                                                                <option selected disabled>Gender</option>
                                                                <option value="male" @if (isset($user) && $user->gender === 'male') selected @endif>Male</option>
                                                                <option value="female" @if (isset($user) && $user->gender === 'female') selected @endif>Female
                                                                </option>
                                                            </select>
                                                            <label for="" id="gender_error" class="text-red"><strong> This field is required </strong>  </label>
                                                            <span for="" id="gender_error" class="invalid-feedback" role="alert">
                                                                <strong> This field is required </strong>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div> -->

                                            <div class="container form-group mt-3">
                                                <div class="row">
                                                    <!-- <div class="col-md-12">
                                                            <textarea class="form-control" name="bio"
                                                            id="exampleFormControlTextarea1" rows="5"
                                                            placeholder="Tell us about yourself that you want students to see?">{{ $user->bio ?? '' }}</textarea>
                                                        </div> -->
                                                    <!-- <div class="col-md-12 text-right mt-3">
                                                            <input type="submit"
                                                                class="btn btn-registration btn-lg cencel-btn nextBtn pull-right ml-5"
                                                                value=" Save for Later">

                                                            <button id="finish" type="submit"
                                                                class="btn btn-lg btn-registration schedule-btn  nextBtn pull-right  ">
                                                                &nbsp; Save &nbsp;
                                                            </button>
                                                        </div> -->
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- <div role="tabpanel" class="tab-pane border-right" id="step-2"
                                        style="padding-bottom: 100px;background-color: white;">
                                        <div class="col-md-12 ">
                                            <p class="heading-third mt-3">Educational information </p>
                                            @isset($user)
                                                    @forelse ($user->education as $i => $education)
                                                        <div class=" customer_records mt-5">
                                                            <div class="row">
                                                                <div class="input-text col-md-6">
                                                                    <select name="degree[]" onchange="checkLevel(this)"
                                                                        class="form-select form-select-lg mb-3">
                                                                        @foreach ($degrees as $degree)
                                                                            <option level="{{ $degree->level }}"
                                                                                value="{{ $degree->id }}" @if ($education->degree_id == $degree->id) selected @endif>
                                                                                {{ $degree->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="input-text col-md-6">
                                                                    <select name="major[]"
                                                                        class="form-select form-select-lg mb-3">
                                                                        @foreach ($subjects as $subject)
                                                                            <option value="{{ $subject->id }}" @if ($subject->id == $education->subject_id) selected @endif>
                                                                                {{ $subject->name }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="input-text col-md-6">
                                                                    <input type="hidden" name="institute[]"
                                                                        id="inst_id_{{ $i }}"
                                                                        value="{{ $education->institute_id }}">

                                                                    <input class="form-control bs-autocomplete"
                                                                        id="{{ $i }}"
                                                                        placeholder="University"
                                                                        value="{{ $education->institute->name ?? '' }}"
                                                                        data-hidden_field_id="city-code" data-item_id="id"
                                                                        data-item_label="name" autocomplete="off">
                                                                </div>
                                                                <div class="input-text col-md-6">
                                                                    <input type="date" name="graduate_year[]"
                                                                        class=" yearpicker form-control" id="grad-yea"
                                                                        value="{{ $education->year ?? '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-md-12">
                                                                    <input hidden name="exist_img[]" value="{{ $education->docs }}">
                                                                    <input type="file" class="dropify" name="upload[]" id=""
                                                                        data-default-file="{{ asset($education->docs) }}">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <hr />
                                                @empty
                                                        <div class=" customer_records mt-5">
                                                            <div class="row">
                                                                <div class="input-text col-md-6">
                                                                    <select name="degree[]" onchange="checkLevel(this)"
                                                                        class="form-select form-select-lg mb-3">
                                                                        <option value="0" selected>Degree</option>
                                                                        @foreach ($degrees as $degree)
                                                                            <option level="{{ $degree->level }}"
                                                                                value="{{ $degree->id }}">
                                                                                {{ $degree->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <div class="input-text col-md-6">
                                                                    <select name="major[]"
                                                                        class="form-select form-select-lg mb-3">
                                                                        <option value="0" selected>Major</option>
                                                                        @foreach ($subjects as $subject)
                                                                            <option value="{{ $subject->id }}">
                                                                                {{ $subject->name }}</option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="input-text col-md-6">
                                                                    <input type="hidden" name="institute[]" id="inst_id_0"
                                                                        value="">
                                                                    <input class="form-control bs-autocomplete" id="ac-demo"
                                                                        placeholder="University"
                                                                        data-item_label="name" autocomplete="off">

                                                                </div>
                                                                <div class="input-text col-md-6">
                                                                    <input type="date" name="graduate_year[]"
                                                                        class=" yearpicker form-control" id="grad-yea">
                                                                </div>

                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-md-12">
                                                                    <input type="file" class="dropify" name="upload[]" id="">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <hr />
                                                    @endforelse
                                            @else
                                                    <div class=" customer_records mt-5">
                                                        <div class="row">
                                                            <div class="input-text col-md-6">
                                                                <select name="degree[]" class="form-select form-select-lg mb-3"
                                                                    onchange="checkLevel(this)">
                                                                    <option value="0" selected>Degree</option>
                                                                    @foreach ($degrees as $degree)
                                                                        <option value="{{ $degree->id }}">
                                                                            {{ $degree->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="input-text col-md-6">
                                                                <select name="major[]" class="form-select form-select-lg mb-3">
                                                                    <option value="0" selected>Major</option>
                                                                    @foreach ($subjects as $subject)
                                                                        <option value="{{ $subject->id }}">
                                                                            {{ $subject->name }}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="input-text col-md-6">
                                                                <input type="hidden" name="institute[]" id="inst_id" value="">

                                                                <input class="form-control bs-autocomplete" id="ac-demo"
                                                                    placeholder="University"
                                                                    data-source="demo_source.php" data-item_id="inst_id"
                                                                    data-item_label="name" autocomplete="off">
                                                            </div>
                                                            <div class="input-text col-md-6">
                                                                <input type="date" name="graduate_year[]"
                                                                    class=" yearpicker form-control" id="grad-yea">
                                                            </div>

                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-12">
                                                                <input type="file" class="dropify" name="upload[]" id="">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <hr />
                                            @endisset
                                            <a class="extra-fields-customer cust_link" href="#">+
                                                Add more degrees
                                            </a>
                                            <div class="customer_records_dynamic mt-5"></div>
                                            <div class="row">
                                                <div class="col-8"></div>
                                                <div class="col-4">
                                                    <div class="btn-later">
                                                        <button type="submit"
                                                            class="btn btn-registration btn-lg cencel-btn nextBtn pull-right ml-5 ">Save
                                                            for Later
                                                        </button>
                                                        <button type="button" id="step-2-next"
                                                            class="btn btn-lg   schedule-btn  nextBtn pull-right ml-4 btn-registration">&nbsp;
                                                            Continue &nbsp;
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div> -->
                                <!-- <div role="tabpanel" class="tab-pane border-right" id="step-3"
                                        style="padding-bottom: 100px;background-color: white;">
                                        <div class="col-md-12">
                                            <p class="heading-third mt-3">Professional information</p>
                                            <div class="wrapper mt-5">
                                                <div class="container">
                                                    @isset($user)
                                                            @forelse ($user->professional as $profession)
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="element">
                                                                            <div class="row">
                                                                                <div class="input-text col-md-6">
                                                                                    <input name="designation[]"
                                                                                        class="form-control"
                                                                                        placeholder="Designation: Senior Developer at Google"
                                                                                        value="{{ $profession->designation }}">
                                                                                </div>
                                                                                <div class="input-text col-md-6">
                                                                                    <input name="organization[]"
                                                                                        class="form-control"
                                                                                        placeholder="Organization"
                                                                                        value="{{ $profession->organization }}">
                                                                                </div>

                                                                            </div>
                                                                            <div class="row my-3">
                                                                                <div class="input-text col-md-6">
                                                                                    <input  class="form-control"
                                                                                        name="degree_start[]"
                                                                                        placeholder="Starting date" onfocus="(this.type='date')"
                                                                                        value="{{ $profession->start_date ?? '' }}">
                                                                                </div>
                                                                                <div class="input-text col-md-6">
                                                                                    <input class="form-control"
                                                                                        name="degree_end[]" onfocus="(this.type='date')"
                                                                                        placeholder="Ending Date"
                                                                                        value="{{ $profession->end_date ?? '' }}">
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        @empty
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="element">
                                                                            <div class="row">
                                                                                <div class="input-text col-md-6">
                                                                                    <input name="designation[]"
                                                                                        class="form-control"
                                                                                        title="Designation: Senior Developer at Google"
                                                                                        placeholder="Designation">
                                                                                </div>
                                                                                <div class="input-text col-md-6">
                                                                                    <input name="organization[]"
                                                                                        class="form-control"
                                                                                        title="Organization Like Google"
                                                                                        placeholder="Organization">

                                                                                </div>
                                                                            </div>
                                                                            <div class="row my-3">
                                                                                <div class="input-text col-md-6">
                                                                                    <input  onfocus="(this.type='date')" class="form-control"
                                                                                        name="degree_start[]"
                                                                                        placeholder="Starting date" value="">
                                                                                </div>
                                                                                <div class="input-text col-md-6">
                                                                                    <input  onfocus="(this.type='date')" class="form-control"
                                                                                        name="degree_end[]"
                                                                                        placeholder="Ending Date" value="">
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforelse
                                                    @else
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="element">
                                                                        <div class="row">
                                                                            <div class="input-text col-md-6">
                                                                                <input name="designation[]" class="form-control"
                                                                                    title="Designation: Senior Developer at Google"
                                                                                    placeholder="Designation">
                                                                            </div>
                                                                            <div class="input-text col-md-6">
                                                                                <input name="organization[]"
                                                                                    class="form-control"
                                                                                    title="Organization Like Google"
                                                                                    placeholder="Organization">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row my-3">
                                                                            <div class="input-text col-md-6">
                                                                                <input  onfocus="(this.type='date')" class="form-control"
                                                                                    name="degree_start[]"
                                                                                    placeholder="Starting date" value="">
                                                                            </div>
                                                                            <div class="input-text col-md-6">
                                                                                <input onfocus="(this.type='date')" class="form-control"
                                                                                    name="degree_end[]"
                                                                                    placeholder="Ending Date" value="">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                    @endisset


                                                    <div class="buttons mb-5">
                                                        <a href="#" class="moreExperience cust_link">+ Add more
                                                            experience</a>
                                                    </div>
                                                    <div class="results"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row ml-2 mt-5">
                                            <div class="col-4">

                                            </div>
                                            <div class="col-8" style="display: flex;">
                                                <button
                                                    class="btn btn-lg cencel-btn nextBtn pull-right ml-5 btn-registration">Save
                                                    for Later
                                                </button>
                                                <button type="button" id="step-3-next"
                                                    class="btn btn-lg   schedule-btn  nextBtn pull-right ml-4 btn-registration">&nbsp;
                                                    Continue &nbsp;
                                                </button>

                                            </div>
                                        </div>
                                    </div> -->
                                <script>
                                    // $(document).ready(function() {
                                    //     $(".clone").click(function() {
                                    //         $(".remove").css("visibility", "visible");
                                    //     });
                                    // });
                                </script>
                                <!-- <div role="tabpanel" class="tab-pane border-right" id="step-4"
                                        style="background-color: white;">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="input-text col-md-6 d-block">
                                                    {{-- <select name="teach"
                                                        class="form-select form-select-lg mb-3 @error('teach') is-invalid @enderror"
                                                        required>
                                                        <option disabled selected>I want to teach</option>
                                                        @foreach ($subjects as $subject)
                                                            <option value="{{ $subject->id }}" @if ($subject->id == ($user->userdetail->subject_id ?? 0)) selected @endif>
                                                                {{ $subject->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('teach')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror --}}

                                                    <select name="teach"
                                                        class="form-select form-select-lg mb-3 @error('teach') is-invalid @enderror"
                                                        id="teacher">
                                                        <option disabled selected>I want to teach</option>
                                                        @foreach ($subjects as $subject)
                                                            <option value="{{ $subject->id }}">
                                                                {{ $subject->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span for="" id="teach_error" class="invalid-feedback" role="alert">
                                                        <strong> This field is required </strong>
                                                    </span>
                                                    @error('teach')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                    @enderror
                                                </div>
                                                <div class="input-text col-md-6">

                                                    <select name="student_grade"
                                                        class="form-select form-select-lg mb-3" id="levels">
                                                        <option value="" disabled selected>School</option>

                                                            <option value="1">Pre Elementary School</option>
                                                            <option value="2">Elementary School</option>
                                                            <option value="3">Secondary School</option>
                                                            <option value="4">High School</option>
                                                            <option value="5"> Post Secondary</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container-fluid">

                                            <div class="input-text col-md-12 m-0 p-0 mt-3 mb-3">
                                                <input type="" name="hour_rate" placeholder="Rate per hour (in USD)">
                                                <select name="hour_rate" class="form-select form-select-lg mb-3"
                                                    aria-label=".form-select-lg example">
                                                    <option disabled>Per hour charges</option>
                                                    <option @if (isset($user) && $user->hourly_rate == 5) selected @endif value="5">$5</option>
                                                    <option @if (isset($user) && $user->hourly_rate == 10) selected @else selected @endif
                                                        value="10">$10</option>
                                                    <option @if (isset($user) && $user->hourly_rate == 15) selected @endif value="15">$15</option>
                                                    <option @if (isset($user) && $user->hourly_rate == 20) selected @endif value="20">$20</option>
                                                    <option @if (isset($user) && $user->hourly_rate == 25) selected @endif value="25">$25</option>
                                                    <option @if (isset($user) && $user->hourly_rate == 30) selected @endif value="30">$30</option>
                                                    <option @if (isset($user) && $user->hourly_rate == 35) selected @endif value="35">$35</option>
                                                    <option @if (isset($user) && $user->hourly_rate == 40) selected @endif value="40">$40</option>
                                                    <option @if (isset($user) && $user->hourly_rate == 45) selected @endif value="45">$45</option>
                                                    <option @if (isset($user) && $user->hourly_rate == 50) selected @endif value="50">$50</option>

                                                </select>

                                            </div>
                                            <div class=" col-md-4 col-sm-6 form-check   m-0 p-0">
                                                    <input class="form-check-input" type="checkbox" name="policies" id="policies" value="on">
                                                    <label class="form-check-label " for="policies">Policies</label>
                                            </div>
                                            <div class=" col-md-4 col-sm-6 form-check   m-0 p-0">
                                                    <input class="form-check-input" type="checkbox" name="email_market" id="email_market" value="on">
                                                    <label class="form-check-label " for="email_market">Email marketing</label>
                                            </div>
                                        </div>
                                        <div class="col-8" style="float: right;">

                                            <button type="button" id="finish"
                                                class="btn btn-lg   schedule-btn  nextBtn  pull-right">&nbsp;
                                                Finish&nbsp;
                                            </button>

                                        </div>
                                    </div> -->

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        <script>
            window.addEventListener("load", function(){
                document.querySelector('.abcRioButtonIcon').style.marginLeft="15px";
                document.querySelector('.abcRioButtonContents').style.marginLeft="-40px";
                document.querySelector('.abcRioButtonContents span').innerHTML="Continue With Google";
            });

            function signOut() {
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut().then(function () {
                    console.log('User signed out.');
                    });
                }
            window.onload = function() {
                signOut();
                fbLogout();
            };

            function onSignIn(googleUser) {
                var profile = googleUser.getBasicProfile();
                var firstName = profile.getName().split(' ').slice(0, -1).join(' ');
                var lastName = profile.getName().split(' ').slice(-1).join(' ');

                $.ajax({
                    url: "{{ route('login.google') }}",
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
                        role: 2
                    },
                    success: function(data) {
                        if(data.status == 200){
                            signOut();
                            window.location.href = window.location.origin+data.url
                        }
                        if(data.status == 400){
                            signOut();
                            document.querySelector('.abcRioButtonIcon').style.marginLeft="15px";
                            document.querySelector('.abcRioButtonContents').style.marginLeft="-40px";
                            document.querySelector('.abcRioButtonContents span').innerHTML="Continue With Google";
                            toastr.error(data.message,{
                                position: 'top-end',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 2500
                            });
                        }
                    },

                });

            }

            //Facebook Login Script

            window.fbAsyncInit = function() {
                // FB JavaScript SDK configuration and setup
                FB.init({
                appId      : '{{ env("FACEBOOK_APP_ID") }}', // FB App ID
                cookie     : true,  // enable cookies to allow the server to access the session
                xfbml      : true,  // parse social plugins on this page
                version    : 'v3.2' // use graph api version 2.8
                });

                // Check whether the user already logged in
                FB.getLoginStatus(function(response) {
                    if (response.status === 'connected') {
                        //display user data
                        getFbUserData();
                    }
                });
            };

            // Load the JavaScript SDK asynchronously
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            // Facebook login with JavaScript SDK
            function fbLogin() {
                FB.login(function (response) {
                    if (response.authResponse) {
                        getFbUserData();
                    } else {
                        document.getElementById('status').innerHTML = 'User cancelled login or did not fully authorize.';
                    }
                }, {scope: 'email'});
            }

            //Fetch the user profile data from facebook
            function getFbUserData(){
                FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture'},
                function (response) {
                    $.ajax({
                        url: "{{ route('login.google') }}",
                        dataType: "json",
                        type: "Post",
                        async: true,
                        data: {
                            _token: "{{ csrf_token() }}",
                            first_name: response.first_name,
                            last_name: response.last_name,
                            email: response.email,
                            picture: response.picture.data.url,
                            provider: 'facebook',
                            role: 2
                        },
                        success: function(data) {
                            if(data.status == 200){
                                fbLogout();
                                window.location.href = window.location.origin+data.url
                            }
                            if(data.status == 400){

                                fbLogout();
                                toastr.error(data.message,{
                                    position: 'top-end',
                                    icon: 'error',
                                    showConfirmButton: false,
                                    timer: 2500
                                });
                            }
                        },

                    });
                });
            }

            // Logout from facebook
            function fbLogout() {
                FB.logout(function() {
                    console.log('facebook logged out')
                });
            }

        </script>

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{ asset('assets/js/ui-autocomplete.js') }}"></script>
        <script src="assets/js/countrySelect.js"></script>
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
            for (var i = 1; i <= 31; i++) {
                $("#day").append("<option value='" + i + "'" + (i == {{ $user->day ?? 1 }} ? 'selected' : '') + ">" + i +
                    "</option>");
            }

            $("#finish").on('click', function() {
                $(this).attr('name', 'finish');
            });
            $("#policies").change(function() {
                if ($(this).prop("checked") == true) {
                    $(this).val("on");
                } else if ($(this).prop("checked") == false) {
                    $(this).val("off");
                }
            });
            $("#email_market").change(function() {
                if ($(this).prop("checked") == true) {
                    $(this).val("on");
                } else if ($(this).prop("checked") == false) {
                    $(this).val("off");
                }
            });
            $(document).ready(function() {

                var date = new Date();
                $("#region").val(date);
                const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                // console.log(timezone);
                $("#time_zone").val(timezone);

                $("#year,#grad-year").yearpicker({
                    year: {{ $user->year ?? '1990' }},
                    startYear: 1950,
                    endYear: 2050,
                });
                $("#teach_error").hide();
                $(".text-red").hide();
            });

            $("#country_selector").countrySelect({
                defaultCountry: "{{ $user->country_short ?? '' }}",
                preferredCountries: ['ca', 'gb', 'us', 'pk']
            });

            $("#country_selector").on('change', function() {
                var short = $(this).countrySelect("getSelectedCountryData");
                $("#country_short").val(short.iso2);
            });

            // var languages_list = {...};
            (function() {
                var user_language_code = "{{ $user->language ?? 'en-US' }}";
                // var option = '';
                var option = '<option value="" disabled selected> Preffered Language</option>';
                for (var language_code in languages_list) {
                    // var selected = (language_code == user_language_code) ? ' selected' : '';
                    option += '<option value="' + language_code + '">' + languages_list[language_code] +
                        '</option>';
                }
                // document.getElementById('languages-list').innerHTML = option;
            })();

            $(document).ready(function() {
                $(".dropify").dropify();
                $(".form-select").select2();
                $(".text-red").hide();
                /* Password STrength */
              

               
                /* Password Strength End  */
            });
            $("#password").keyup(function(e) {
                    var capital_leters = new RegExp('[A-Z]');
                    var lower_leters = new RegExp('[a-z]');
                    var numeric = new RegExp('[0-9]');
                    var special = /[_~\-!@#\$%\^&\*\(\)]+$/;
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

                    console.log(password, "password");

                    // var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
                    // var ter = $(this).val();
                    // if (ter.match(decimal))
                    // {
                    //     console.log("password ok");
                    //     // $("#password_error").css("display", "none");
                    //     // $("#passTech").css("display", "block");
                    //     // $("#password").removeClass("is-invalid");
                    //     // $("#password").addClass("valid");
                    //     // $('#register').removeAttr('onsubmit');

                    // }else{
                    //     var attr = $('#register').attr('onsubmit');

                    //     if (typeof attr !== 'undefined' && attr !== false) {
                    //         $('#register').removeAttr('onsubmit');
                    //     }else{
                    //         $('#register').attr('onsubmit','return false');
                    //     }

                    //     // $("#password_error").css("display", "block");
                    //     // $("#passTech").css("display", "none");
                    //     // $("#password").removeClass("valid");
                    //     // $("#password").addClass("is-invalid");

                    //     // $("#password_error").text("Field should have at least one lowercase letter, one uppercase letter, one numeric digit, and one special character")

                    //     return false;
                    // }
                });
            $("#password").focus(function(e) {
                    $("#passTech").show("slow");
                });

                $("#password").focusout(function(e) {
                    $("#passTech").hide("slow");
                });
        </script>
    </section>
</body>

</html>
