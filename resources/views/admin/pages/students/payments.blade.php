@extends('admin.layouts.app')

@section('content')
<!--section start  -->
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>
                < Payment details </h1>
        </div>
    </div>
</div>
<!-- tutor request bookings  table start-->
<div class="container-fluid">
    <div class="pt-3 mt-3 container-bg">
        {{-- <form>
        <div class="row border-bottom ml-1 mr-1 pb-2">
            <div class="col-md-2">
                <div class="input-option">
                    <div class="input-serach">
                        <input type="search" placeholder="Invoice number" id="student-id" />
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-option">
                    <select id="std-class">
                        <option disabled selected>Subject</option>
                        <option>Chemistry</option>
                        <option>Physice</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-date input-date-1">
                    <input type="text" name="daterange" placeholder="01/01/2018 - 01/15/2018" />
                </div>
            </div>
            <div class="col-md-2">

                <div class="input-option">
                    <select id="std-courses">
                        <option disabled selected>Rate</option>
                        <option>$50</option>
                        <option>$100</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="reset-text mt-2">
                    <input type="reset" value="Reset" class="reset-button">
                </div>
            </div>
            <div class="col-md-2">

            </div>
        </div>
    </form> --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col">Payment/Transaction ID</th>
                        <th scope="col">Type</th>
                        <th scope="col">Date</th>
                        <th scope="col">Rate</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- paid payment -->
                    @foreach ($payments as $payment)
                    <tr>
                        <td class="pt-4">
                            <span>{{$payment->transaction_id}}</span>
                        </td>
                        <td class="pt-4">{{$payment->type}}</td>
                        <td class="pt-4">{{date('d, M Y',strtotime($payment->created_at))}}</td>
                        <td class="pt-4">${{$payment->amount}}</td>
                        <td class="pt-4">{{$payment->method}}</td>
                        <td class="pt-4">
                            <span class="paid-text-1">Paid</span>
                        </td>
                        <td class="pt-3">
                            <a href="invoice.html">
                                <button class="schedule-btn w-100">View receipt</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
