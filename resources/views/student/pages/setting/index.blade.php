@extends('student.layouts.app')
<style>
    .nav {
        width: auto !important;
        padding: 0 !important;
        margin-left: 0 !important;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #007bff !important;
        border-bottom: 0;
    }
    .nav-pills .nav-link:hover{
        background-color: #E2F0FF !important;
        color: #007bff;
    }

</style>
@section('content')


    <section>
        <div class="content-wrapper " style="overflow: hidden;">
            <!--section start  -->
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-md-12">
                        <p class="mr-3 heading-first">
                            Settings
                        </p>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-md-12 mb-1 ">
                        <div class=" card  bg-toast infoCard">


                            <div class="card-body row">
                                <div class="col-md-1 text-center">
                                    <i class="fa fa-info" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-11 pl-0">
                                    <small>
                                        Change your registered information anytime to keep your profile updated here. <a
                                            href="#">Learn More</a>

                                    </small>
                                    <a href="#" class="cross" onclick="hideCard()">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                    aria-orientation="vertical">
                                    <!-- <a class="nav-link  {{ session()->has('key') ? '' : 'active show' }}" id="v-pills-General-tab" data-toggle="pill" href="#v-pills-General"
                                        role="tab" aria-controls="v-pills-General" aria-selected="true">General</a> -->
                                    <a class="nav-link  {{ session()->has('key') ? '' : 'active show' }}"
                                        id="v-pills-Security-tab" data-toggle="pill" href="#v-pills-Security" role="tab"
                                        aria-controls="v-pills-Security" aria-selected="false">Security</a>
                                    <a class="nav-link" id="v-pills-Payment-tab" data-toggle="pill"
                                        href="#v-pills-Payment" role="tab" aria-controls="v-pills-Payment"
                                        aria-selected="false">Billing</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="v-pills-tabContent chang_photo">
                                    <!-- <div class="tab-pane fade {{ session()->has('key') ? '' : 'active show' }} chee" id="v-pills-General" role="tabpanel"
                                        aria-labelledby="v-pills-General-tab">

                                        <form action="" method="Post"
                                            enctype="multipart/form-data" id="personal">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <h3>General</h3>
                                                </div>
                                                <div class="col-md-12 font-light">
                                                    Change email address
                                                </div>
                                                <div class="col-sm-6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <small class="">Name</small>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="text" value="" class="form-control"
                                                                        placeholder="First Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                                    <input type="text" value="" class="form-control"
                                                                        placeholder=" Last Name">
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <small class="">Email Address</small>
                                                    <div class="form-group">
                                                            <input type="email" value="" class="form-control"
                                                                placeholder="yourname@yourdomain.com">
                                                        </div>
                                                        <small class=" ">Phone number</small>
                                                        <div class="form-group">
                                                            <input type="number" value="" class="form-control"
                                                                placeholder="03XX XXXXXXXX">
                                                        </div>
                                                        <small class=" ">Address</small>
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <input type="text" value="" class="form-control"
                                                                    placeholder="City">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <div class="form-item">
                                                                    <input id="country_selector" class="form-control" name="country" type="">
                                                                    <input id="country_short" class="form-control" name="country_short" type="" hidden>
                                                                    <label for="country_selector" style="display:none;">Select a
                                                                        country here...</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="float-right">
                                                            <button class="schedule-btn">Save changes</button>
                                                        </div>

                                                    </div>
                                            </div>
                                        </form>
                                    </div> -->

                                    <div class="tab-pane fade {{ session()->has('key') ? '' : 'active show' }} chee"
                                        id="v-pills-Security" role="tabpanel" aria-labelledby="v-pills-Security-tab">
                                        <div class="row">
                                            <!-- <div class="col-md-12 mb-4">
                                                <h3>Security</h3>
                                            </div> -->

                                            <div class="col-6">
                                                @if (session()->has('error'))
                                                    <div class="alert alert-danger alert-dismissible fade show"
                                                        role="alert">
                                                        {{ session('error') }}
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @elseif(session()->has('success'))
                                                    <div class="alert alert-success alert-dismissible fade show"
                                                        role="alert">
                                                        {{ session('success') }}
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-12 font-light">
                                                Change password
                                            </div>
                                            <div class="col-sm-6 mt-3">
                                                <form action="{{ url('/student/change-password') }}" method="POST">
                                                    @csrf
                                                    <small>Current Password</small>
                                                    <div class="form-group pass_show">
                                                        <input type="text" name="current_password"
                                                            class="form-control @error('current_password') is-invalid @enderror"
                                                            placeholder=" ***********">
                                                        @error('current_password')
                                                            <span class="small text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <small>New Password</small>
                                                    <div class="form-group pass_show">
                                                        <input type="text" name="new_password" id="new_password" class="form-control"
                                                            placeholder="***********">
                                                        @error('new_password')
                                                            <span class="small text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <small>Re-enter new
                                                        password</small>
                                                    <div class="form-group pass_show">
                                                        <input type="text" name="new_confirm_password"
                                                            class="form-control" placeholder="***********">
                                                        @error('new_confirm_password')
                                                            <span class="small text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="float-right">
                                                        <button type="submit" class="schedule-btn" id="RegPass">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                            <div class="col-md-6 mt-3">
                                                <div id="passTech">
                                                    <!-- Field should have at least: -->
                                                    <div class="row mt-3">
                                                        <div class="col-md-12">
                                                            <ul>
                                                                <li id="capital_letter"><i class="fa fa-times"></i>
                                                                    One uppercase letter</li>
                                                                <li id="lower_letter"><i class="fa fa-times"></i> One
                                                                    lowercase letter</li>
                                                                <li id="numeric"><i class="fa fa-times"></i> One
                                                                    numeric value</li>
                                                                <li id="special_character"><i
                                                                        class="fa fa-times"></i> One special
                                                                    character</li>
                                                                <li id="min_character"><i class="fa fa-times"></i> 8
                                                                    characters</li>

                                                            </ul>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade chee" id="v-pills-Payment" role="tabpanel"
                                        aria-labelledby="v-pills-Payment-tab">
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <h3>Payment</h3>
                                            </div>


                                            <div class="col-sm-6">
                                                <form action="{{ route('student.paymentmethod') }}" method="post">
                                                    @csrf
                                                <small>Payment Method</small>
                                                <div class="form-group  mt-1">
                                                    <select name="payment_type" id="paymentMethod" class="form-control w-100" id="">
                                                        <option value="paypal">Paypal </option>
                                                        <option value="skrill">Skrill</option>
                                                        {{-- <option value="Sadapay">Sadapay</option>
                                                    <option value="Zippa">Zippa</option> --}}
                                                    </select>
                                                    {{-- <div class="dropdown d-flex ">
                                                        <a class=" d-flex form-control" href="#" data-toggle="dropdown" aria-expanded="true">David </a>
                                                        <ul class="dropdown-menu  " style="width:100%;">
                                                            <li>
                                                                <a tabindex="-1" class="" href="">
                                                                    <img src="{{ asset('assets/images/payment-icon/paypal.png') }}" alt="">
                                                                    Paypal
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a tabindex="-1" class="" href="#">
                                                                    Help
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div> --}}
                                                </div>
                                                    <small>Email </small>
                                                    <div class="form-group ">
                                                        <input type="email" name="email" class="form-control"
                                                            placeholder="payment method email">
                                                    </div>
                                                    {{--<small >CVS Number</small>
                                                    <div class="form-group ">
                                                        <input type="number" value="" class="form-control"
                                                            placeholder="365">
                                                    </div>
                                                    <small >Credit Card holder name</small>
                                                    <div class="form-group pass_show">
                                                        <input type="text" value="" class="form-control"
                                                            placeholder="Full Name">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <small >Exp. Month</small>
                                                            <div class="form-group pass_show">
                                                                <input type="text" value="" class="form-control"
                                                                    placeholder="Month">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <small >Exp. Year</small>
                                                            <div class="form-group pass_show">
                                                                <input type="text" value="" class="form-control"
                                                                    placeholder="Year">
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                <div class="float-right">
                                                    <button class="schedule-btn" type="submit">Save changes</button>
                                                </div>

                                            </form>
                                            </div>
                                        </div>

                                        @if($setting->count() != 0 || $setting != 'null')
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                            @foreach ($setting as $st)
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="text-center">
                                                            @if ($st->method == 'paypal')
                                                            <img src="{{ asset('assets/images/payment-icon/paypal_logo_512.png') }}"
                                                                alt="">
                                                            @elseif($st->method == 'skrill')
                                                            <img src="{{asset ('assets/images/payment-icon/skrill.png')}}" class="w-50" alt="">
                                                            @endif
                                                            <span class="payment-menu dropdown d-flex">
                                                                <a class=" d-flex" href="#" data-toggle="dropdown"
                                                                    aria-expanded="true">
                                                                    <img src="{{ asset('assets/images/payment-icon/menu_dots.png') }}"
                                                                        alt="">
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li>
                                                                        <a tabindex="-1" class="" href="">
                                                                            Edit
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a tabindex=" -1" class="" href="">
                                                                            Delete
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </span>
                                                            <span class=" round">
                                                                <input type="radio" name="payment" onclick="defaultMethod(this.value)" value="{{$st->method}}" id="checkbox1" {{$st->default == 1 ? 'checked' : ''}} />
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
@section('scripts')



<script>
    $(document).ready(function(){
        $("#passTech").hide();
        
        $("#new_password").focus(function(e) {
            $("#passTech").show("slow");
        });

        $("#new_password").focusout(function(e) {
            $("#passTech").hide("slow");
        });
    })
        function defaultMethod(value)
        {
            $.ajax({
                url: 'setDefaltPayment',
                dataType: "json",
                type: "Post",
                data: {_token:'{{csrf_token()}}',method:value},
                success: function (data) {
                    if(data == 'success'){
                            toastr.success((value.charAt(0).toUpperCase() + value.slice(1))+' has been set as default payment method',{
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                }
            });

        }


        $("#new_password").keyup(function(e) {
            
            var capital_leters = new RegExp('[A-Z]');
            var lower_leters = new RegExp('[a-z]');
            var numeric = new RegExp('[0-9]');
            var password = $(this).val();

            if (password.match(capital_leters)) {
                $("#capital_letter").css('color', 'green');
                $("#capital_letter").find(".fa").removeClass("fa-times");
                $("#capital_letter").find(".fa").addClass("fa-check");
                $('#RegPass').removeAttr('disabled','disabled');
            } else {
                $("#capital_letter").css('color', 'red');
                $("#capital_letter").find(".fa").removeClass("fa-check");
                $("#capital_letter").find(".fa").addClass("fa-times");
                var attr = $('#RegPass').attr('disabled','disabled');;

                if (typeof attr !== 'undefined' && attr !== false) {
                    $('#RegPass').removeAttr('disabled','disabled');
                } else {
                    $('#RegPass').attr('onsubmit', 'return false');
                }
            }

            if (password.match(lower_leters)) {
                $("#lower_letter").css('color', 'green');
                $("#lower_letter").find(".fa").removeClass("fa-times");
                $("#lower_letter").find(".fa").addClass("fa-check");
                $('#RegPass').removeAttr('disabled','disabled');
            } else {
                $("#lower_letter").css('color', 'red');
                $("#lower_letter").find(".fa").addClass("fa-times");
                $("#lower_letter").find(".fa").removeClass("fa-check");
                var attr = $('#RegPass').attr('disabled','disabled');;

                if (typeof attr !== 'undefined' && attr !== false) {
                    $('#RegPass').removeAttr('disabled','disabled');
                } else {
                    $('#RegPass').attr('onsubmit', 'return false');
                }
            }

            if (password.match(numeric)) {
                $("#numeric").css('color', 'green');
                $("#numeric").find(".fa").removeClass("fa-times");
                $("#numeric").find(".fa").addClass("fa-check");
                $('#RegPass').removeAttr('disabled','disabled');
            } else {
                $("#numeric").css('color', 'red');
                $("#numeric").find(".fa").addClass("fa-times");
                $("#numeric").find(".fa").removeClass("fa-check");
                var attr = $('#RegPass').attr('disabled','disabled');;

                if (typeof attr !== 'undefined' && attr !== false) {
                    $('#RegPass').removeAttr('disabled','disabled');
                } else {
                    $('#RegPass').attr('onsubmit', 'return false');
                }
            }

            if (password.length > 8) {
                $("#min_character").css('color', 'green');
                $("#min_character").find(".fa").removeClass("fa-times");
                $("#min_character").find(".fa").addClass("fa-check");
                $('#RegPass').removeAttr('disabled','disabled');
            } else {
                $("#min_character").css('color', 'red');
                $("#min_character").find(".fa").addClass("fa-times");
                $("#min_character").find(".fa").removeClass("fa-check");
                var attr = $('#RegPass').attr('disabled','disabled');;

                if (typeof attr !== 'undefined' && attr !== false) {
                    $('#RegPass').removeAttr('disabled','disabled');
                } else {
                    $('#RegPass').attr('onsubmit', 'return false');
                }
            }

            var format = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

            if (format.test(password)) {
                $("#special_character").css('color', 'green');
                $("#special_character").find(".fa").removeClass("fa-times");
                $("#special_character").find(".fa").addClass("fa-check");
                $('#RegPass').removeAttr('disabled','disabled');
            } else {
                $("#special_character").css('color', 'red');
                $("#special_character").find(".fa").addClass("fa-times");
                $("#special_character").find(".fa").removeClass("fa-check");
                var attr = $('#RegPass').attr('disabled','disabled');;

                if (typeof attr !== 'undefined' && attr !== false) {
                    $('#RegPass').removeAttr('disabled','disabled');
                } else {
                    $('#RegPass').attr('onsubmit', 'return false');
                }
            }

        });
    </script>


@endsection
