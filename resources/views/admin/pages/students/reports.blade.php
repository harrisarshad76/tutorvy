@extends('admin.layouts.app')

@section('content')
<!--section start  -->
<div class="container-fluid pb-4">
    <a href="">
        <h1>
            < Reports </h1>
    </a>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mt-3">
            <nav class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="nav nav-stwich" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                                By student
                            </a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                href="#nav-profile" role="tab" aria-controls="nav-profile"
                                aria-selected="false">
                                Against student
                            </a>
                        </div>
                    </div>
                    <!-- <div class="col-md-4">
                        <button class="schedule-btn float-right">Add new post</button>
                    </div> -->
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane bg-white  fade show active" id="nav-home" role="tabpanel"
                    aria-labelledby="nav-home-tab">

                    <div class="container-fluid row mb-3 mt-3">
                        <div class="col-md-6">
                            <div class="container">
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <img src="../assets/img/ico/profile-boy.png" alt="image" />

                                    </div>
                                    <div class="col-md-10 m-0 p-0">
                                        <span class="heading-forth">Harram Laraib</span>
                                        <p class="paragraph-text  ">Student</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span class="view-date mt-3">02 March 2021</span>
                        </div>
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="star-fa ml-3 mt-0">

                                    </div>
                                    <p class="paragraph-texts mt-2 ml-3">
                                        It is a long established fact that a reader will be distracted by the readable
                                        content of a page when looking at0 its lyout. The point
                                        of using Lorem Ipsum is that it has more-or-less normal distribution of letters,
                                        as opposed to using Content here, content ere'
                                        making it look like readable English.
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <div class="float-right mt-5">
                                        <button class="schedule-btn" data-toggle="modal"
                                        data-target="#exampleModalCenter">Action</button>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>

                    </div>
                    <div class="container-fluid row mb-3 mt-3">
                        <div class="col-md-6">
                            <div class="container">
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <img src="../assets/img/ico/profile-boy.png" alt="image" />

                                    </div>
                                    <div class="col-md-10 m-0 p-0">
                                        <span class="heading-forth">Harram Laraib</span>
                                        <p class="paragraph-text  ">Student</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span class="view-date mt-3">02 March 2021</span>
                        </div>
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="star-fa ml-3 mt-0">

                                    </div>
                                    <p class="paragraph-texts mt-2 ml-3">
                                        It is a long established fact that a reader will be distracted by the readable
                                        content of a page when looking at0 its lyout. The point
                                        of using Lorem Ipsum is that it has more-or-less normal distribution of letters,
                                        as opposed to using Content here, content ere'
                                        making it look like readable English.
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <div class="float-right mt-5">
                                        <button class="schedule-btn" data-toggle="modal"
                                        data-target="#exampleModalCenter">Action</button>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>

                    </div>
                    <div class="container-fluid row mb-3 mt-3">
                        <div class="col-md-6">
                            <div class="container">
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <img src="../assets/img/ico/profile-boy.png" alt="image" />

                                    </div>
                                    <div class="col-md-10 m-0 p-0">
                                        <span class="heading-forth">Harram Laraib</span>
                                        <p class="paragraph-text  ">Student</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span class="view-date mt-3">02 March 2021</span>
                        </div>
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="star-fa ml-3 mt-0">

                                    </div>
                                    <p class="paragraph-texts mt-2 ml-3">
                                        It is a long established fact that a reader will be distracted by the readable
                                        content of a page when looking at0 its lyout. The point
                                        of using Lorem Ipsum is that it has more-or-less normal distribution of letters,
                                        as opposed to using Content here, content ere'
                                        making it look like readable English.
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <div class="float-right mt-5">
                                        <button class="schedule-btn" data-toggle="modal"
                                        data-target="#exampleModalCenter">Action</button>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>

                    </div>

                </div>
                <div class="tab-pane bg-white fade" id="nav-profile" role="tabpanel"
                    aria-labelledby="nav-profile-tab">
                    <div class="container-fluid row mb-3 mt-3">
                        <div class="col-md-6">
                            <div class="container">
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <img src="../assets/img/ico/profile-boy.png" alt="image" />

                                    </div>
                                    <div class="col-md-10 m-0 p-0">
                                        <span class="heading-forth">Harram Laraib</span>
                                        <p class="paragraph-text  ">Student</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span class="view-date mt-3">02 March 2021</span>
                        </div>
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="star-fa ml-3 mt-0">

                                    </div>
                                    <p class="paragraph-texts mt-2 ml-3">
                                        It is a long established fact that a reader will be distracted by the readable
                                        content of a page when looking at0 its lyout. The point
                                        of using Lorem Ipsum is that it has more-or-less normal distribution of letters,
                                        as opposed to using Content here, content ere'
                                        making it look like readable English.
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <div class="float-right mt-5">
                                        <button class="schedule-btn" data-toggle="modal"
                                        data-target="#exampleModalCenter">Action</button>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>

                    </div>
                    <div class="container-fluid row mb-3 mt-3">
                        <div class="col-md-6">
                            <div class="container">
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <img src="../assets/img/ico/profile-boy.png" alt="image" />

                                    </div>
                                    <div class="col-md-10 m-0 p-0">
                                        <span class="heading-forth">Harram Laraib</span>
                                        <p class="paragraph-text  ">Student</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span class="view-date mt-3">02 March 2021</span>
                        </div>
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="star-fa ml-3 mt-0">

                                    </div>
                                    <p class="paragraph-texts mt-2 ml-3">
                                        It is a long established fact that a reader will be distracted by the readable
                                        content of a page when looking at0 its lyout. The point
                                        of using Lorem Ipsum is that it has more-or-less normal distribution of letters,
                                        as opposed to using Content here, content ere'
                                        making it look like readable English.
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <div class="float-right mt-5">
                                        <button class="schedule-btn" data-toggle="modal"
                                        data-target="#exampleModalCenter">Action</button>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>

                    </div>
                    <div class="container-fluid row mb-3 mt-3">
                        <div class="col-md-6">
                            <div class="container">
                                <div class="row mt-3">
                                    <div class="col-md-2">
                                        <img src="../assets/img/ico/profile-boy.png" alt="image" />

                                    </div>
                                    <div class="col-md-10 m-0 p-0">
                                        <span class="heading-forth">Harram Laraib</span>
                                        <p class="paragraph-text  ">Student</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span class="view-date mt-3">02 March 2021</span>
                        </div>
                        <div class="container-fluid mt-3">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="star-fa ml-3 mt-0">

                                    </div>
                                    <p class="paragraph-texts mt-2 ml-3">
                                        It is a long established fact that a reader will be distracted by the readable
                                        content of a page when looking at0 its lyout. The point
                                        of using Lorem Ipsum is that it has more-or-less normal distribution of letters,
                                        as opposed to using Content here, content ere'
                                        making it look like readable English.
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <div class="float-right mt-5">
                                        <button class="schedule-btn" data-toggle="modal"
                                        data-target="#exampleModalCenter">Action</button>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



<div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <p>Assgin</p>
            </div>
            <div class="modal-body">
                <div class="input-serach">
                    <input class="w-100" type="search" placeholder="Search members" />
                    <img class="serach-icon" src="../assets/img/ico/Search.png" />
                </div>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <span class="alex-name"><img src="../assets/img/ico/profile-boy.svg"
                                alt="std-icon" /></span>
                            <span class="pl-2 alex-names">Harram</span>
                        </div>
                        <div class="col-md-6 col-6">
                            <button class="schedule-btn assgin-text" data-toggle="modal" data-target="#exampleModalCenter">Assign</button>
                        </div>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <span class="alex-name"><img src="../assets/img/ico/profile-boy.png"
                                alt="std-icon" /></span>
                            <span class="pl-2 alex-names">Harram</span>
                        </div>
                        <div class="col-md-6 col-6">
                            <button class="schedule-btn assgin-text" data-toggle="modal" data-target="#exampleModalCenter">Assign</button>
                        </div>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <span class="alex-name">
                            <img src="../assets/img/ico/profile-boy.png" alt="std-icon" /></span>
                            <span class="pl-2 alex-names">Harram</span>
                        </div>
                        <div class="col-md-6 col-6">
                            <button class="schedule-btn assgin-text" data-toggle="modal" data-target="#exampleModalCenter">Assign</button>
                        </div>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <span class="alex-name"><img src="../assets/img/ico/profile-boy.png"
                                alt="std-icon" /></span>
                            <span class="pl-2 alex-names">Harram</span>
                        </div>
                        <div class="col-md-6 col-6">
                            <button class="schedule-btn assgin-text" data-toggle="modal" data-target="#exampleModalCenter">Assign</button>
                        </div>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <span class="alex-name"><img src="../assets/img/ico/profile-boy.png"
                                alt="std-icon" /></span>
                            <span class="pl-2 alex-names">Harram</span>
                        </div>
                        <div class="col-md-6 col-6">
                            <button class="schedule-btn assgin-text" data-toggle="modal" data-target="#exampleModalCenter">Assign</button>
                        </div>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <span class="alex-name"><img src="../assets/img/ico/profile-boy.png"
                                alt="std-icon" /></span>
                            <span class="pl-2 alex-names">Harram</span>
                        </div>
                        <div class="col-md-6 col-6">
                            <button class="schedule-btn assgin-text" data-toggle="modal" data-target="#exampleModalCenter">Assign</button>
                        </div>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <span class="alex-name"><img src="../assets/img/ico/profile-boy.png"
                                alt="std-icon" /></span>
                            <span class="pl-2 alex-names">Harram</span>
                        </div>
                        <div class="col-md-6 col-6">
                            <button class="schedule-btn assgin-text" data-toggle="modal" data-target="#exampleModalCenter">Assign</button>
                        </div>
                    </div>
                </div>
                <div class="container mt-4">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <span class="alex-name"><img src="../assets/img/ico/profile-boy.png"
                                alt="std-icon" /></span>
                            <span class="pl-2 alex-names">Harram</span>
                        </div>
                        <div class="col-md-6 col-6">
                            <button class="schedule-btn assgin-text" data-toggle="modal" data-target="#exampleModalCenter">Assign</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
