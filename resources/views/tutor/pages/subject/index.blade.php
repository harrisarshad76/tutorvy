@extends('tutor.layouts.app')
<style>
    .searchBtn {
        position: absolute;
        right: 23px;
        top: 10px;
        color: #00132D;
    }

    .h-auto {
        height: auto !important;
    }

    .appOpt {
        padding-top: 8px;
        /* float: right; */
        padding-left: 12px;
        color: #00132D;
        font-size: 24px;

    }

    /* .badge {
        position: absolute;
        right: -28px;
        top: -15px;
        z-index: 9;
    } */

    .badge-new {
        background: #FAAF3A;
        color: #fff;
    }

    .badge-pending {
        background: #65A5ff;
        color: #fff;

    }

    .badge-approve {
        background: #0ace36b0;

    }

    svg:not(:root) {
    overflow: hidden;
    width: 20px;
    padding-top:3px;
}
.flex-1{
    opacity:0 ;
}

.sub-tab .tablinks{
    font-size:14px;
}
</style>
@section('content')
    <!-- top Fixed navbar End -->
    <section>
        <div class="content-wrapper " style="overflow: hidden;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <p class="mr-3 mb-3 heading-first">
                             Subjects
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-1 ">
                            <div class=" card  bg-toast infoCard">
                                <div class="card-body row">
                                    <div class="col-md-1 text-center">
                                        <i class="fa fa-info" aria-hidden="true"></i>
                                    </div>
                                    <div class="col-md-11">
                                        <small>
                                            Subject Details to get to know which subjects you can offer and which subjects you have already offered and their status. <a href="#">Learn More</a>

                                        </small>
                                        <a href="#" class="cross"  onclick="hideCard()">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @if (Auth::user()->teach)
                    <p class="heading-third mb-0">My Subjects</p>
                    <div class="row">
                        @foreach (Auth::user()->teach as $teach)
                            <div class="col-md-4">
                                <div class="card-deck">
                                    <div class="card h-auto card-shadow p-0">
                                        <div class="card-body ">
                                            <span
                                                class="badge badge-pill badge-approve mt-1 text-white">Approved</span>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <p class="heading-fifth mr-3 pt-2 mb-0 ">
                                                        {{ $teach->subject->name }}</p>
                                                </div>
                                                <div class="col-md-2">
                                                    <a  type="button" onclick="showTutorPlans('{{$teach->sub_name}}','{{$teach->user_id}}','{{$teach->subject_id}}')">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if(Auth::user()->assessment->where('status','0')->count() != 0)
                        <p class="heading-third mt-3 mb-0">Pending Subjects</p>
                        <div class="row">
                            @foreach (Auth::user()->assessment->where('status',0) as $teach)
                                <div class="col-md-4">
                                    <div class="card-deck">
                                        <div class="card h-auto card-shadow p-0">
                                            <div class="card-body ">
                                                <span
                                                    class="badge badge-pill badge-new mt-1 text-white">Pending</span>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <p class="heading-fifth mr-3 pt-2 mb-0 ">
                                                            {{ $teach->subject->name }}</p>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <a href="{{route('tutor.remove.subject',[$teach->subject->id])}}" class="float-right mt-2 text-danger text-decoration-none">Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                        <p class="heading-third mt-3">Add subjects</p>

                        <div class="row">
                            <div class="col-md-3">
                                <select name="subjects-list" class="form-select form-control w-25 " id="subjects-list">
                                    <option value="">Select Particular Subject</option>
                                    @foreach ($all_subjects as $subject)
                                        <option value="{{ $subject->id }}" data-myval="{{$subject->cat_id}}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="search" class="form-control" placeholder="Search Subject"> -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 pt-5">
                                <div class="tab-mobile tab sub-tab">
                                    @foreach($main_sub as $sub_cat)
                                        <button class="tablinks {{($sub_cat->id == 1) ? 'active': ''}}" id="defaultOpen_{{$sub_cat->id}}" onclick="getSubSubject({{$sub_cat->id}})">
                                            {{$sub_cat->name}}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-10 pt-4">
                                <div id="subjects" style="height:500px;overflow-y:auto;overflow-x:hidden;">
                                    <div id="1">
                                        <div class="row" id="subSubjects">
                                            @foreach ($subjects as $i => $subject)
                                                @if ((Auth::user()->teach[$i]->subject_id ?? null) != $subject->id)
                                                    <div class="col-md-5">
                                                        <div class="card-deck">
                                                            <div class="card h-auto card-shadow p-0">
                                                                <div class="card-body ">
                                                                    <div class="row">
                                                                        <div class="col-md-10">
                                                                            <p class="heading-fifth mr-3 pt-2 mb-0 ">
                                                                                {{ $subject->name }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            @if(Auth::user()->status == 2)
                                                                                <?php
                                                                                    $ter = Auth::user()->assessment->where('subject_id',$subject->id)->first();
                                                                                ?>
                                                                                @if($ter == "")
                                                                                    <a href="{{ route('tutor.test', [$subject->id]) }}">
                                                                                        <p class="view-bookings mb-0">Add</p>
                                                                                    </a>
                                                                                @else
                                                                                    
                                                                                @endif
                                                                            @else
                                                                                <a onclick="showMessage()">
                                                                                    <p class="view-bookings mb-0">Add</p>
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                @else
                    <!-- no subject start -->
                    @include('tutor.pages.general.nosubject')
                    <!-- end -->
                @endif
                <div class="line"></div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="priceModal" tabindex="-1" role="dialog"
        aria-labelledby="priceModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- <div class="modal-header text-center">
                </div> -->
                <form action="{{ route('tutor.update_sub_plan') }}" method="Post" id="subPlanUpdate">
                    <div class="modal-body h-auto  card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <img  src="{{asset('admin/assets/img/ico/dollars.png')}}" />
                            </div>
                            <div class="col-md-12 text-center mt-3">
                                <h3 id="subject_title"> </h3>
                            </div>
                        </div>
                        <div id="show_plans"></div>
                    </div>
                    <div class="modal-footer ">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="cencel-btn btn" data-dismiss="modal" type="button">
                                    Cancel
                                </button>
                                <button class="schedule-btn btn" type="submit">
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('js_files.tutor.subjectJs')
    <script>
        function showTutorPlans(subject_title , user_id , subject_id) {
            $.ajax({
                url: "{{route('tutor.plans')}}",
                type:"POST",
                data:{
                user_id:user_id,
                subject_id:subject_id,
                },
                success:function(response){

                var data = ``;
                var obj = response.tutor_plans;
                if(response.status_code == 200) {
                    console.log(obj, 'junk');
                    for(var i =0; i < obj.length; i++) {
                        var name = obj[i].experty_title != null ? obj[i].experty_title .replace("-", "_") : '-';
                        var title = $.trim(name).toLowerCase();
                    data +=`

                        <div class="row mt-3 ">
                            <div class="col-md-6">
                                <p class="pt-3"> `+ name +` </p>
                            </div>
                            <div class="text-right col-md-6 ">
                                <div class="input-group mt-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="text" class="form-control" id="preElementary_rate" name="`+ title +`" value="`+ obj[i].rate+`">                                   
                                    <input type="hidden" class="form-control"  name="`+ title +`_id" value="`+ obj[i].id+`">                                  
                                    <input type="hidden" class="form-control"  name="subject_id" value="`+ obj[i].subject_id+`">                                  
                                </div>
                            </div>
                        </div>`
                    }
                    $("#subject_title").text(subject_title);
                    $("#show_plans").html(data);
                    $("#priceModal").modal('show');

                }else{

                    toastr.error( response.message,{
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });

                }
                },
            });

        }
                // update tutor edu record
        $("#subPlanUpdate").submit(function(e) {
            
            e.preventDefault();

            var action = $(this).attr('action');
            var method = $(this).attr('method');
            var form = new FormData(this);
            $.ajax({
                url: action,
                type:method,
                data:form,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend:function(data) {
                    $("#educational_save").hide();
                    $("#educational_loading").show();
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
                    $("#educational_save").show();
                    $("#educational_loading").hide();
                },
                error:function(e) {
                    $("#educational_save").show();
                    $("#educational_loading").hide();
                    console.log(e);
                    toastr.error('Something Went Wrong',{
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            });

        });
    
    </script>
@endsection
