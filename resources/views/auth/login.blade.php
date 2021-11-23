<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-signin-client_id" content="{{ env('GOOGLE_CLIENT_ID') }}">

    <title>Login</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- style css -->
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/global-login.css') }}" rel="stylesheet">

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <!--favicon --->
    <link href="{{ asset('assets/images/ico/side-icons.png') }}" rel="icon">
    <!-- bootstrap link -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <!-- fonawsome -->
    <link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <!--toggle Eye for tutor and student-->
    <style>
        .toggle-password{
            position: absolute;
            right: 12px;
            top: 43px;
        }

.Google {
    margin-top: 30px;
    width: 100%;
    background-color: #C94131;
    color: #fff;
    padding: 9px;
    font-size: 14px;
    border: 1px solid #C94131;
    text-align: center;
    font-family: 'Poppins';
    cursor: pointer;
    border-radius: 4px;
}

.Google a {
    color: #fff;
    text-decoration: none;
}

.Google:hover {
    background-color: #fff;
}

.Google:hover a {
    color: #C94131;
}
.facebook{
    border:1px solid #1173FF;
}
.facebook a {
    color: #fff;
    text-decoration: none;
}

.facebook:hover {
    background-color: #fff;
}

.facebook:hover a {
    color: #1173FF;
}
.Apple {
    border: 1px solid #000000;
}

.Apple a {
    color: #fff;
    text-decoration: none;
}

.Apple:hover {
    background-color: #fff;
    color: #000000;

}

.Apple:hover a {
    color: #000000;
}

    </style>
</head>

<body>
    <section id="body" style="padding-bottom: 35px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="">
                        <div class="login-logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('assets/images/logo/logo.png') }}" alt="logo">
                            </a>
                        </div>
                        <div class="text">
                            <p class="learn">
                                Learn from the best tutors
                            </p>
                            <p class="time">
                                Anytime, Anywhere
                            </p>
                        </div>
                        <div class="Register mt-4">
                            Register yourself on Tutorvy and learn or teach anything <br />
                            from anywhere.
                        </div>
                        <div style="margin-top: 70px;" class="gPicture">
                            <img src="../assets/images/login-image/loginImage.png" alt="login" style="width: 90%;">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class=" card border-0 container pb-5">
                        <div class="ml-3 mr-3">
                            <div class="row">
                                @isset($user)
                                <p class="ml-3 mt-3 mt-5">
                                    @if($user->picture)
                                            <?php
                                                $path = $user->picture;
                                            ?>
                                            @if(file_exists( public_path($path) ))
                                                <img src="{{asset($user->picture)}}" alt="boy" class="profile-img">
                                            @else
                                                <img src="../assets/images/ico/Square-white.jpg" alt="boy" class="profile-img">
                                            @endif
                                    @else
                                        <img src="../assets/images/ico/Square-white.jpg" alt="boy" class="profile-img">
                                    @endif
                                </p>
                                <p class="ml-3 mt-5 Welcome-text"> {{$user->first_name ?? ''}} {{$user->last_name ?? ''}}</p>
                                @else
                                <p class="ml-3 mt-5 hello-text">
                                    Hello,
                                </p>
                                <p class="ml-1 mt-5 Welcome-text">
                                    Welcome back
                                </p>
                                @endisset
                            </div>
                            @isset($user)
                            <a href="{{route('login')}}" class="text-primary" style="position: absolute;top: 75px;left: 90px;font-size: 14px;font-family: Poppins;line-height: 1;text-decoration:none">
                                Not you ?</a>
                            <p class="sign-text">Enter Password</p>
                            <div class="row">
                                <p class="user-text ml-3">Enter password to login</p>
                                <br />
                                <br />
                            </div>
                            @else
                            <p class="sign-text">
                                Sign in
                            </p>
                            <div class="row">
                                <p class="user-text ml-3">
                                    New user?<a href="{{route('student.register')}}" class="Create-text text-decoration-none">
                                        create an account
                                    </a>
                                </p>
                                <br /><br />
                            </div>
                            @endisset
                            <form action="{{ route('login') }}" method="POST" id="form">
                                @csrf
                                <div class="mb-5 input-login">
                                    <div class="input-container">
                                            <input type="hidden" name="time_zone" id="time_zone">
                                            @if(!isset($user))
                                            <input type="email" name="email" id="myName" placeholder="Enter Email Address"
                                                class="form-control @if(Session::has('error')) is-invalid @endif">

                                                @if(Session::has('error'))
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{session::get('error')}}</strong>
                                                    </span>
                                                @endif
                                            @else
                                                <input type="email" name="valid_email" value="{{$user->email}}" hidden />
                                                <input type="text" name="role" value="{{$user->role}}" hidden/>
                                                <input type="password" name="password" id="pswd" placeholder="Enter your password"
                                                class="@isset($error) is-invalid @endisset">
                                                <span toggle="#password-field" id="togglepass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                @isset($error)
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong>{{$error}}</strong>
                                                        </span>
                                                @endisset
                                            @endif
                                            <!-- <input type="submit" class="submit schedule-btn w-25 mt-3 float-right" value="Submit"> -->
                                            <button type="submit" class="submit schedule-btn mt-3 float-right">Submit</button>
                                    </div>
                                    @if(isset($user))

                                    <p class="checkboxs d-inline-block w-100 mt-4">
                                        <input style="width: 15px;" type="checkbox" class="checkbox">
                                        <span style="position: absolute;left: 55px;font-size: 16px;font-family: Poppins;">
                                        Stay signed in</span>
                                    </p>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <!-- <form method="post" action="#" id="myform">
                            <input type="" placeholder="Enter your email address" name="email" class="email"
                                required>
                            <div class="add"></div>
                            <input type="submit" class="submit schedule-btn w-25 mt-3 float-right"
                                value="Submit">
                        </form> -->
                        @if(!isset($user))
                        <div class="social-Icon ml-3 mr-3">
                            {{-- <div class="Google">
                                <a href="{{route('social.google',[0])}}" target="popup"
                                onclick="window.open({{route('social.google',[0])}},'popup','width=600,height=600'); return true;">
                                    <img class="mr-3" src="../assets/images/ico/google.png" alt="google">
                                    Continue with Google
                                </a>
                            </div> --}}
                            <div class="g-signin2 mt-3 text-center"
                                data-onsuccess="onSignIn"
                                data-width="480"
                                data-height="40"
                                data-text="continue_with"
                                data-logo_alignment="center"
                                onclick="checkLogin()">
                            </div>

                            <div class="facebook">
                                <a href="javascript:void(0);" style="text-decoration:none" onclick="fbLogin();" id="fbLink">
                                <i class="fa fa-facebook fa-lg mr-2" aria-hidden="true"></i>
                                Continue with Facebook
                                </a>
                            </div>
                            {{-- <div class="facebook">
                                <a href="{{route('social.facebook',[0])}}">

                                <!-- <img class="mr-3" src="../assets/images/ico/facebook(1).png" alt="facebook"> -->
                                <i class="fa fa-facebook fa-lg mr-2" aria-hidden="true"></i>
                                Continue with Facebook
                                </a>
                            </div> --}}
                            <!-- <div class="Apple">
                                <img class="mr-3" src="../assets/images/ico/apple.png" alt="apple">
                                <i class="fa fa-apple fa-lg mr-2" aria-hidden="true"></i>
                                Continue with Apple
                            </div> -->
                            <div class="Policy-text" style="display: flex;">
                                <p class="by-text">
                                    Protected by reCAPTCHA and subject to the Google
                                    <a href="#">Privacy Policy</a> and <a href="#">Terms and Condition</a>
                                <!-- <span class="Privacy-text">
                                    Privacy
                                </span> -->
                                </p>
                            </div>
                            <!-- <div class="" style="display: flex;">
                                <p class="policy-text1">
                                    Policy and
                                </p>
                                <P class="Privacy-text">
                                    Terms of Service.
                                </P>
                            </div> -->
                        </div>
                        @else
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <a href="{{route('password.request')}}" style="font-size: 14px;">
                                   <p class="ml-4">Forgot password?</p>
                                </a>
                            </div>
                            <div class="col-md-6 text-right">
                                <div class="social-Icon ml-4" style="font-size: 14px;color: #1173FF;font-family: Poppins;">
                                    <a href="{{route('login')}}" class="mr-4" > Back to signin</a>
                                </div>
                            </div>


                        </div>
                        @endif


                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade custom_modal" id="registerLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-body bg-custom text-center p-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="p-2"> <img src="{{asset('assets/images/logo-footer.png')}}" alt="">
                                    </h1>
                                    <h3 class="mb-4 p-2"> Are you a</h3>
                                </div>
                                <div class="col-md-12">
                                    <div class="bg-btn-light">
                                        <a type="button" href="{{route('student.register')}}" class="btn  modal-btn animate__animated">Student</a>
                                        <a type="buttin" href="{{route('register')}}" class="btn  modal-btn animate__animated">Tutor</a>

                                    </div>
                                </div>
                            </div>



                        </div>
                        <!-- <div class="modal-footer">

                        </div> -->
                    </div>
                </div>
            </div>
<!-- Category Modal -->

        <!-- Modal -->
        <div class="modal fade custom_modal" id="registerLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-body bg-custom text-center p-5">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="p-2"> <img src="{{asset('assets/images/logo-footer.png')}}" alt="">
                                </h1>
                                <h3 class="mb-4 p-2"> Are you a</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="bg-btn-light">
                                    <a type="button" href="{{route('student.register')}}" class="btn  modal-btn animate__animated">Student</a>
                                    <a type="buttin" href="{{route('register')}}" class="btn  modal-btn animate__animated">Tutor</a>

                                </div>
                            </div>
                        </div>



                    </div>
                    <!-- <div class="modal-footer">

                    </div> -->
                </div>
            </div>
        </div>

        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.js"></script>
        <script src="../assets/js/login.js"></script>
        <script src="../assets/js/jquery.validate.js"></script>
        <script>

            window.addEventListener("load", function(){
                document.querySelector('.abcRioButtonIcon').style.marginLeft="130px";
                document.querySelector('.abcRioButtonContents').style.marginLeft="-168px";
                document.querySelector('.abcRioButtonContents span').innerHTML="Continue With Google";
            });


            function signOut() {
                    var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut().then(function () {
                    console.log('User signed out.');
                    });
            }
            window.onload = function() {
                fbLogout();
                signOut();
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
                            window.location.href = window.location.origin+data.url
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

            // Fetch the user profile data from facebook
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
                                window.location.href = window.location.origin+data.url
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

            // jquery form validation
            $(document).ready(function() {
                const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
                $("#time_zone").val(timezone);

                $("#form").validate({
                    rules: {
                        myName: {
                            required: true,
                            minlength: 8
                        },
                        pass: {
                            required: true,
                            minlength: 8
                        }
                    },

                    highlight: function(element) {
                        $(element).addClass("cl");
                    },
                    unhighlight: function(element) {
                        $(element).removeClass("cl");
                    },
                    messages: {
                        myName: {
                            required: "Enter your password",

                        },
                        pass: {
                            required: "Enter new password",

                        },
                        cpass: {
                            required: "Re-enter password",
                            equalTo: "password not matched"

                        }
                    }


                })
            })
        </script>
    </section>

</body>

</html>
