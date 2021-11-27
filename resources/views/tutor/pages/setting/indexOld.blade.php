@extends('tutor.layouts.app')
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

    .nav-pills .nav-link:hover {
        background-color: #E2F0FF !important;
        color: #007bff;
    }
    .dayName{
        padding-top:15px;
    }
    .dayCheck{
        padding-top:25px;
    }
    #accordion .card-header{
        background:#fff;
        padding-bottom: 15px;
        padding-top: 15px;
    }
    #accordion .slider{
        height: 20px;
        width: 42px;
    }
    input:checked+.slider {
    background-color: #1173FF !important;
}
</style>
@section('content')

    <section>
        <div class="content-wrapper " style="overflow: hidden;">
            <!--section start  -->
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-md-12">
                        <p class="mr-3 heading-first"> Settings </p>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12 mb-1 ">
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fa fa-info" aria-hidden="true"></i>
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @elseif(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fa fa-info" aria-hidden="true"></i>
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class=" card  bg-toast infoCard">

                            <div class="card-body row">
                                <div class="col-md-1 text-center">
                                    <i class="fa fa-info" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-11">
                                    <small>
                                        Update your settings to get secured and optimised as much as you can<a
                                            href="#">Learn More</a>
                                    </small>
                                    <a href="#" class="cross" onclick="hideCard()">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <!-- <a class="nav-link {{session()->has('key') ? '' : 'active'}}" id="v-pills-General-tab" data-toggle="pill" href="#v-pills-General"
                                        role="tab" aria-controls="v-pills-General" aria-selected="true">General</a> -->

                                    <a class="nav-link {{session()->has('key') ? '' : 'active'}}" id="v-pills-Security-tab" data-toggle="pill" href="#v-pills-Security"
                                        role="tab" aria-controls="v-pills-Security" aria-selected="true">Security</a>

                                    <a class="nav-link" id="v-pills-Payment-tab" data-toggle="pill"
                                        href="#v-pills-Payment" role="tab" aria-controls="v-pills-Payment"
                                        aria-selected="false">Payments</a>

                                    <a class="nav-link" id="v-pills-Notifications-tab" data-toggle="pill"
                                        href="#v-pills-Notifications" role="tab" aria-controls="v-pills-Notifications"
                                        aria-selected="false">Notifications</a>

                                    <a class="nav-link" id="v-pills-Slots-tab" data-toggle="pill"
                                        href="#v-pills-Slots" role="tab" aria-controls="v-pills-Slots"
                                        aria-selected="false">Working Slots</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="v-pills-tabContent chang_photo">
                                    <div class="tab-pane fade {{ session()->has('key') ? '' : 'active show' }} chee"
                                        id="v-pills-Security" role="tabpanel" aria-labelledby="v-pills-Security-tab">
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <h3>Security</h3>
                                            </div>

                                            <div class="col-md-12 font-light">
                                                Change password
                                            </div>
                                            <div class="col-sm-6">
                                                <form action="{{ route('tutor.change.password') }}" method="POST">
                                                    @csrf
                                                    <small>Current Password</small>
                                                    <div class="form-group pass_show">
                                                        <input type="password" name="current_password"
                                                            class="form-control @error('current_password') is-invalid @enderror"
                                                            placeholder=" ***********">
                                                        @error('current_password')
                                                            <span class="small text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <small>New Password</small>
                                                    <div class="form-group pass_show">
                                                        <input type="password" name="new_password" class="form-control"
                                                            placeholder="***********">
                                                        @error('new_password')
                                                            <span class="small text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <small>Re-enter new password</small>
                                                    <div class="form-group pass_show">
                                                        <input type="password" name="new_confirm_password"
                                                            class="form-control" placeholder="***********">
                                                        @error('new_confirm_password')
                                                            <span class="small text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="float-right">
                                                        <button type="submit" class="schedule-btn">Save changes</button>
                                                    </div>

                                                    <span id='lippButton'></span>

                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade chee" id="v-pills-Payment" role="tabpanel"
                                        aria-labelledby="v-pills-Payment-tab">
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <h3>Payments</h3>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-2 text-center">
                                                <img class="mt-4"
                                                    src="{{ asset('assets/images/payment-icon/paypal_logo_512.png') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-8">
                                                <h5>Paypal</h5>
                                                <hr>
                                                <p>Additional activation and maintainance fees charged by Paypal.
                                                    <a href="https://www.paypal.com/us/webapps/mpp/account-selection">Don't
                                                        have a Paypal account?</a>
                                                </p>

                                            </div>
                                            <div class="col-md-2 text-center">
                                                @if ($paypal_payment != null)
                                                    <button type="button" class="btn btn-secondary mt-4" disabled>Set
                                                        Up</button>
                                                @else
                                                    <button type="button" data-toggle="modal" data-target="#paypalModel"
                                                        class="btn btn-primary mt-4">Set Up</button>
                                                @endif
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="row">
                                            <div class="col-md-2 text-center">
                                                <img class="mt-4 w-100"
                                                    src="{{ asset('assets/images/payment-icon/Payoneer_logo.png') }}"
                                                    alt="">
                                            </div>
                                            <div class="col-md-8">
                                                <h5>Payoneer</h5>
                                                <hr>
                                                <p>Additional activation and maintainance fees charged by Paypal.
                                                    <a
                                                        href="https://payouts.payoneer.com/partners/or.aspx?pid=YOYIZC74IO2s4KZQp7tgsw%3d%3d&web_interaction=website_traffic">Don't
                                                        have a Payoneer account?</a>
                                                </p>

                                            </div>
                                            <div class="col-md-2 text-center">
                                                <a href="#" class="btn btn-primary mt-4">Set Up</a>
                                            </div>
                                        </div>






                                        {{-- <div class="row"> --}}
                                        {{-- <div class="col-sm-6"> --}}
                                        {{-- <small>Payment Methods</small> --}}
                                        {{-- <div class="form-group  mt-1">
                                                <select name="" id="paymentMethod" class="form-control" id="">
                                                    <option value="Paypal"> <p> <i class="fa fa-plus"></i> Paypal  </p></option>
                                                    <option value="Payoneer">Payoneer</option>
                                                    <option value="Sadapay">Sadapay</option>
                                                    <option value="Zippa">Zippa</option>
                                                </select>
                                              
                                            </div>
                                            <small>Credit Card Number</small>
                                            <div class="form-group ">
                                                <input type="number" value="" class="form-control"
                                                    placeholder="XX-XXXXXXXXXX-X">
                                            </div>
                                            <small >CVS Number</small>
                                            <div class="form-group ">
                                                <input type="number" value="" class="form-control"
                                                    placeholder="365">
                                            </div>
                                            <small >Credit Card holder name</small>
                                            <div class="form-group pass_show">
                                                <input type="text" value="" class="form-control"
                                                    placeholder="Name Mean">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <small >Exp. Month</small>
                                                    <div class="form-group pass_show">
                                                        <input type="text" value="" class="form-control"
                                                            placeholder="August">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <small >Exp. Year</small>
                                                    <div class="form-group pass_show">
                                                        <input type="text" value="" class="form-control"
                                                            placeholder="2021">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="float-right">
                                                <button class="schedule-btn">Save changes</button>
                                            </div> --}}



                                        {{-- </div> --}}

                                        {{-- </div> --}}
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <hr>
                                            </div>


                                            @if ($paypal_payment != null)
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="text-center">
                                                                <img src="{{ asset('assets/images/payment-icon/paypal_logo_512.png') }}"
                                                                    alt="">
                                                                <span class="payment-menu dropdown d-flex">
                                                                    <a class=" d-flex" href="#"
                                                                        data-toggle="dropdown" aria-expanded="true">
                                                                        <img src="{{ asset('assets/images/payment-icon/menu_dots.png') }}"
                                                                            alt="">
                                                                    </a>
                                                                    <ul class="dropdown-menu">
                                                                        <li>
                                                                            <a tabindex="-1" class=""
                                                                                href="">
                                                                                Edit
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a tabindex=" -1" class=""
                                                                                href="">
                                                                                Delete
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </span>
                                                                <span class=" round">
                                                                    <input type="radio" name="payment"
                                                                        onclick="defaultMethod(this.value)" value=""
                                                                        id="checkbox1" />
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                    </div>

                                    <div class="tab-pane fade chee" id="v-pills-Notifications" role="tabpanel"
                                        aria-labelledby="v-pills-Notification-tab">
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <h3>Notification</h3>
                                            </div>
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
                                                Manage Notifications
                                            </div>
                                            <div class="col-sm-6">
                                                <form action="{{ route('tutor.change.password') }}" method="POST">
                                                    @csrf
                                                    <div class="row mt-3">
                                                        <div class="col-md-12 mt-1">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="booking" id="booking">
                                                                <label class="custom-control-label" for="booking">Get
                                                                    Booking Notification on your Email Address</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mt-1">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="verification" id="verification">
                                                                <label class="custom-control-label" for="verification">Get
                                                                    Verification Notification on your Email Address</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mt-1">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input"
                                                                    name="assessment" id="assessment">
                                                                <label class="custom-control-label" for="assessment">Get
                                                                    Assessment Notification on your Email Address</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mt-3 text-right">
                                                            <button type="submit" class="schedule-btn">Save
                                                                changes</button>
                                                        </div>
                                                    </div>


                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane fade chee" id="v-pills-Slots" role="tabpanel"
                                        aria-labelledby="v-pills-Slots-tab">
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <h3>Slots</h3>
                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <form action="{{route('tutor.saveSlots')}}" id="tutorSlotForm" method="POST">
                                                    @csrf
                                                    <div id="accordion" class="mb-3">
                                                        @if(count($user_slots)  == 0)
                                                            @foreach($days as $day) 
                                                                <div class="m-0 p-0">

                                                                    <div class="card-header"
                                                                        id="outlinehead{{$day['day']}}" class=" bg-color btn-header-link collapsed"
                                                                            data-toggle="collapse"
                                                                            data-target="#outline{{$day['day']}}"
                                                                            aria-expanded="true"
                                                                            aria-controls="outline{{$day['day']}}">
                                                                
                                                                            <img class="mr-2"
                                                                                src="{{ asset('admin/assets/img/ico/round.png') }}" />
                                                                                {{$day['day']}}  
                                                                                <img src="{{ asset('assets/images/ico/cal-blue.png') }}" class="pull-right" alt="" style="width:18px;">
                                                                    </div>
                                                                    <input type="hidden" name="day[]" value="{{$day['day']}}">
                                                                    <div id="outline{{$day['day']}}" class="collapse border-radius" aria-labelledby="{{$day['day']}}" data-parent="#outline{{$day['day']}}">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12 mt-1">
                                                                                    <div class="row">
                                                                                        <div class="col-md-2 pt-1">
                                                                                            <p> <b>Availability </b></p>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="row">
                                                                                                <div class="col-md-3 pt-3 text-right"> From: </div>
                                                                                    
                                                                                                <div class="col-md-9 ">
                                                                                                    
                                                                                                    <select class="form-select mt-1" id="{{$day['day']}}_from" name="from[]">
                                                                                                        @foreach($times as $time)
                                                                                                            <option value="{{$time['value']}}"> {{$time['value']}} </option>
                                                                                                        @endforeach
                                                                                                    </select>

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="row">
                                                                                                <div class="col-md-3 pt-3 text-right"> To: </div>

                                                                                                <div class="col-md-9">
                                                                                                    <select  class="form-select mt-1" id="{{$day['day']}}_to" name="to[]">
                                                                                                        @foreach($times as $time)
                                                                                                            <option value="{{$time['value']}}"> {{$time['value']}} </option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12 mt-1">
                                                                                    <div class="row">
                                                                                        <div class="col-md-2 pt-2">
                                                                                            <p><b>Day Off </b></p>

                                                                                        </div>
                                                                                        <div class="col-md-10 ">
                                                                                            <label class="switch mt-0">
                                                                                                <input type="checkbox" data-day="{{$day['day']}}" value="1" id="{{$day['day']}}_off" class="day_off">
                                                                                                <span class="slider round"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            @foreach($user_slots as $slot)
                                                            <div class=" m-0 p-0">

                                                                <div class="card-header"
                                                                            id="outlinehead{{$slot->day}}"  class="bg-color btn-header-link collapsed"
                                                                                data-toggle="collapse"
                                                                                data-target="#outline{{$slot->day}}"
                                                                                aria-expanded="true"
                                                                                aria-controls="outline{{$slot->day}}">
                                                                        
                                                                                <img class="mr-2"
                                                                                    src="{{ asset('admin/assets/img/ico/round.png') }}" />
                                                                                    {{$slot->day}}
                                                                                <img src="{{ asset('assets/images/ico/cal-blue.png') }}" class="pull-right" alt="" style="width:18px;">

                                                                        </div>
                                                                        <input type="hidden" name="day[]" value="{{$slot->day}}">

                                                                        <div id="outline{{$slot->day}}" class="collapse border-radius" aria-labelledby="{{$slot->day}}" data-parent="#outline{{$slot->day}}">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-md-12 mt-1">
                                                                                    <div class="row">
                                                                                        <div class="col-md-2 pt-3">
                                                                                            <p> <b>Availability </b></p>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="row">
                                                                                                <div class="col-md-4 pt-3 text-right"> From: </div>
                                                                                    
                                                                                                <div class="col-md-8 ">
                                                                                                    <select class="form-select" id="{{$slot->day}}_from" name="from[]">
                                                                                                        @foreach($times as $time)
                                                                                                            <option value="{{$time['value']}}"> {{$time['value']}} </option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <div class="row">
                                                                                                <div class="col-md-4 pt-3 text-right"> To: </div>

                                                                                                <div class="col-md-8">
                                                                                                    <select class="form-select"  id="{{$slot->day}}_to" name="to[]">
                                                                                                        @foreach($times as $time)
                                                                                                            <option value="{{$time['value']}}"> {{$time['value']}} </option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12 mt-1">
                                                                                    <div class="row">
                                                                                        <div class="col-md-2 pt-2">
                                                                                            <p><b>Day Off </b></p>

                                                                                        </div>
                                                                                        <div class="col-md-10 ">
                                                                                            <label class="switch mt-0">
                                                                                                <input type="checkbox" id="{{$slot->day}}_off" class="day_off" {{$slot->day_off == 1 ? 'checked' : ''}}>
                                                                                                <span class="slider round"></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        @endif
                                                    
                                                                                    
                                                    </div>
                                                    <div class="pull-right">
                                                        <button type="submit" class="schedule-btn" id="slot_save">Save changes</button>
                                                        <button type="button" class="btn btn-primary" id="slot_loader" style="display:none" disabled> Processing </button>
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
        </div>
    </div>
</section>

@include('Modals.paymentModal')

@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        $(".get").find("th:last-child").css("color",'red');

        $("#tutorSlotForm").submit(function(e) {
            e.preventDefault();

            var day_off = [];

            var action = $(this).attr('action');
            var method = $(this).attr('method');
            var form = new FormData(this);

            
            $('.day_off').each(function(index, item) {

                console.log( index , "index" );               
                console.log( item , "item" );

                if( $(this).is(":checked") ) {
                    day_off[index] = 1;
                }else{
                    day_off[index] = 0;
                }

            });

            form.append('day_off' , day_off);
           
            $.ajax({
                url: action,
                type:method,
                data: form,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend:function(data) {
                    $("#slot_save").hide();
                    $("#slot_loader").show();
                },
                success:function(response){
                    if(response.status_code == 200 && response.success == true) {
                        toastr.success(response.message,{
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }else{
                        toastr.error(response.message,{
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                },
                complete:function(data) {
                    $("#slot_save").show();
                    $("#slot_loader").hide();
                },
                error:function(e) {
                    $("#slot_save").show();
                    $("#slot_loader").hide();
                    toastr.error('Something Went Wrong',{
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            });

        });

    });
    function delPayMethod(id) {
        $.ajax({
            url: "{{route('del.payment')}}",
            type:"POST",
            data:{
                id:id,
            },
            success:function(data){
                    if(data == "success"){
                        toastr.success('Payment Method Deleted Successfully!',{
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500
                    });

                    setInterval(function(){
                        window.location.href = "{{ route('tutor.settings') }}";
                    }, 1500);
                    }
                },
            });
        }
    </script>

@endsection
