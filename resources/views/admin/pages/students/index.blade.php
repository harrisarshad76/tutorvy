@extends('admin.layouts.app')

@section('content')
    <!--section start  -->
    <div class="container-fluid mt-5">
        <div class="row ml-1 mr-1 ">
            <div class="col-md-6">
                <h1>Student</h1>
            </div>

            <div class="col-md-6 m-0 p-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-items"><a href="#">Tutorvy</a></li>
                        <li class="breadcrumb-items m-0 p-0 ml-3" aria-current="page">&gt;</li>
                        <li class="breadcrumb-items m-0 p-0 ml-3" aria-current="page"><a href="">student</a> </li>
                        <li class="breadcrumb-items m-0 p-0 ml-3" aria-current="page">&gt;</li>
                        <li class="breadcrumb-items m-0 p-0 ml-3 breadcrumb-item-active" aria-current="page"><a href="">All
                                students</a> </li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-4">
        <div class="row ml-1 mr-1">
            <div class="col-md-4">
                <h3 class="heading-third-res">All students</h3>
            </div>
            <div class="col-md-4">
            </div>
            <!-- <div class="col-md-4">
                <a href="">
                        View all students

                </a>
            </div> -->

        </div>
        <div class="row ml-1 mr-1">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- <div class="row border-bottom pb-2 ml-1 mr-1">
                            <div class="col-md-11">
                                <form class="row">
                                    <div class="col-md-2">
                                        <div class="input-serach">
                                            <input type="search" placeholder="Student id" id="student-id" />
                                        </div>
                                    </div>
                                    <div class=" col-md-2">
                                        <div class="input-option">
                                            <select id="std-class">
                                                <option selected disabled>Classes</option>
                                                <option>highest</option>
                                                <option>Lowest</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-option">
                                            <select id="std-courses">
                                                <option selected disabled>Courses</option>
                                                <option>highest</option>
                                                <option>Lowest</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-serach ">
                                            <input type="search" placeholder="location" id="search-location-t" />
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-option">
                                            <select id="std-support">
                                                <option selected disabled>Support tickets</option>
                                                <option>Pending</option>
                                                <option>Resolved</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-1 m-0 p-0">

                                        <div class="reset-text mt-2">
                                            <input type="reset" value="Reset" class="reset-button">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-1">
                                <div class="sort-text">
                                    <select id="sort-by-home">
                                        <option value="3" disabled selected>Sort by</option>
                                        <option value="1">Old to new</option>
                                        <option value="1">New to old</option>
                                    </select>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Id</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Classes</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Courses </th>
                                            <th scope="col">Support</th>
                                            <th scope="col">Status</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{dd($students)}} --}}
                                        @foreach($students as $student)
                                            <tr>
                                                <td class="pt-4 alex-name-2">
                                                    <span href="#" data-toggle="tooltip" title="{{ $student->first_name }} {{ $student->last_name }}">{{ $student->first_name }} {{ $student->last_name }}</span>
                                                </td>
                                                <td class="pt-4">1234567891</td>
                                                <td class="pt-4">
                                                    <span href="#" data-toggle="tooltip" title="{{ $student->email }}">{{Str::limit($student->email, 3, $end='***')}}</span>

                                                </td>
                                                <td class="pt-4">01</td>
                                                <td class="pt-4">{{ $student->address }}</td>
                                                <td class="pt-4">{{$student->course->count()}}</td>
                                                <td class="pt-4">{{$student->support->count()}}</td>
                                                <td class="pt-4">
                                                    @if ($student->status_text == 'Pending')
                                                    <span class="pending-text-1">{{$student->status_text}}</span>
                                                    @elseif($student->status_text == 'Approved')
                                                    <span class="pending-text-1">{{$student->status_text}}</span>
                                                    @endif
                                                    {{-- <span class="pending-text-1">{{$student->status_text}}</span> --}}
                                                </td>
                                                <td class="pt-4">
                                                    <a type="button" onclick="deleteStudent({{$student->id}})">
                                                        <img src="{{ asset('admin/assets/img/ico/delete-icon.png')}}" alt="delete-icon" >
                                                    </a>

                                                    <!-- <a href="edit-student.html">
                                                        <img src=" {{ asset('admin/assets/img/ico/edit-icon.png')}}" alt="delete-icon" class="ml-1">
                                                    </a> -->
                                                    <label class="switch" style="position: relative;left: -10px;width: 60px;">
                                                        <input type="checkbox" class="s_status" val_id="{{$student->id}}" val_st="{{$student->status}}" {{ ($student->status == 1) ? 'checked' : ''}}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td class="pt-3 d-flex float-right">
                                                    <a href="{{ route('admin.studentProfile',[ $student->id]) }}" class="cencel-btn btn mr-2">
                                                        View
                                                    </a>
                                                    @if ($student->assign_to != null)
                                                        <button class="btn schedule-btn" disabled>Assigned</button>
                                                        @else
                                                        <button class="schedule-btn" onclick="assignStudentModal({{$student->id}})">Assign</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tutor request bookings  table start-->

    <div class="container-fluid">
        <div class="pt-3 mt-3 container-bg ml-1 mr-1">

        </div>
    </div>
    <!-- deleet Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body modal-bodys">
                    <div class="container text-center pb-3 pt-3">
                        <img src="{{ asset('admin/assets/img/ico/cross-icon.png')}}" alt="verfiy" />
                        <h3 class="mt-3 pb-2">
                            Remove student
                        </h3>
                        <p class="paragraph-text-1 pb-3">Are you sure you want to remove student?</P>
                        <button type="button" class="cencel-btn w-25" data-dismiss="modal">Yes</button>
                        <a href="" class="schedule-btn btn w-25">
                            No
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- assgin modal -->
    <div class="modal fade" id="assignModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <p>Assgin</p>
                </div>
                <div class="modal-body">
                    <div class="input-serach">
                        <input class="w-100" id="search" type="search" placeholder="Search members" />
                        <img class="serach-icon" src="{{ asset('admin/assets/img/ico/Search.png')}}" />

                    </div>
                    @foreach($staff_members as $staff)
                    <div class="container mt-4" id="record">
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <!-- <span class="alex-name">
                                    <img src="{{asset($staff->picture)}}"
                                        alt="std-icon" />

                                    </span> -->

                                <span class="pl-2 alex-names">{{$staff->name}}</span>
                            </div>
                            <div class="col-md-6 col-6">

                                <button class="schedule-btn assgin-text" onclick="assign({{$staff->id}})">Assign</button>

                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
    <!-- end -->
     <!-- delete modal -->
     <div class="modal fade" id="deleteStudentModal" tabindex="-1" role="dialog"
        aria-labelledby="deleteStudentModalTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content modals">
                <div class="modal-body modal-bodys">
                    <div class="container text-center pb-3 pt-3">
                        <img src="{{asset('admin/assets/img/ico/cross-icon.png')}}" alt="verfiy" />
                        <h3 class="mt-3">
                            Remove this Student
                        </h3>
                        <p class="paragraph-text mb-5">
                            Are you sure you want to remove student?
                        </p>

                        <button type="button" class="cencel-btn w-25" data-dismiss="modal">Cancel</button>

                            <button class="schedule-btn w-25" id="Yes" >Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->

@endsection
@section('js')
@include('js_files.admin.studentJs')
@endsection
