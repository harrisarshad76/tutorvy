
    <!-- jquery  -->
    <script src="{{asset('/admin/assets/js/jquery.js')}}" ></script>
    <script src="{{asset('/admin/assets/js/jquery-ui.js')}}"></script>
      <!-- bootstrap 4 javascript -->
    <script src="{{ asset('/admin/assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('/admin/assets/js/bootstrap.min.js')}}"></script>
     <!-- chart javascript -->
    <script src="{{ asset('/admin/assets/js/chart.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- Custom js -->

    <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="{{ asset('/admin/assets/js/mobile.js')}}"></script>
     <script src="{{ asset('assets/js/multiselect.js')}}"></script>
    <script src="{{ asset('/admin/assets/js/global.js')}}"></script>
    <!-- <script src="{{ asset('assets/js/course.js')}}"></script> -->
    <!-- <script src="{{ asset('/admin/assets/js/pages/subjects.js')}}"></script> -->

    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-messaging.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.2.6/firebase-storage.js"></script>
    <!-- <script src="{{asset('assets/firebase/index.js').'?ver='.rand()}}"></script> -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    @include('firebase');

    <script src="{{ asset('assets/js/dropify.js')}}"></script>

    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOIfEfDtYJRmL9ALc-bcfJPukqy_8OCwQ&libraries=places&callback=initAutocomplete"></script> -->
    <script type="text/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.table').DataTable();

        get_all_notifications();

        $(".dropify").dropify();

        $('#availability-id').change(function () {
            $.ajax({
                url: "/assets/js/ticket-id.json",
                type: "GET",
                data: {
                    id: $("#home-ticket-1").val(),
                    location: $("#search-location").val(),
                    student: $("#TypeFeed").val(),
                    rate: $("#rate-number").val(),

                },
                // how can I get selected value here
                beforeSend: function () {
                    // alert("Send data ...")
                },
                success: function (data) {
                    $('#datas').html("");
                    $.each(data.employees, function (i, data) {
                        var div_datae = '<tr> <td class="pt-3 alex-name-2"> <div class="container"> <div class="row"> <div class="col-md-5 m-0 p-0"> <span class="alex-name"> <img class="img-whih-table" src=' + data.img + ' alt="std-icon"/> </span> </div><div class="col-md-7 m-0 p-0 alex-21 mt-2"> <span class="alex-name ml-3" id="name">' + data.name + '</span> </div></div></div></td><td class="pt-4">123456789</td><td class="pt-4"> <span href="#" data-toggle="tooltip" title="harramlaraib127@gmail.com">' + data.email + '</span> </td><td class="pt-4">' + data.subject + '</td><td class="pt-4">' + data.location + '</td><td class="pt-4">Advance</td><td class="pt-4" id="avalibility">' + data.avaiblilty + '</td><td class="pt-4">' + data.rate + '</td>   <td class="pt-3 float-right"> <a href=' + data.button + ' class="cencel-btn btn"> View </a> </td><td class="pt-3 float-right"> <button class="schedule-btn" data-toggle="modal" data-target="#exampleModalCenter">Assign</button> </td></tr>';
                        $('#datas').append(div_datae);
                    });

                },
            });
        });

        $('#TypeFeed').change(function () {

            $.ajax({
                url: "/assets/js/ticket-id.json",

                // url: $('#TypeFeed').val() + '.html',
                type: "GET",
                data: {
                    id: $("#home-ticket-1").val(),
                    location: $("#search-location").val(),
                    avaiblilty: $("#availability-id").val(),
                    rate: $("#rate-number").val(),

                },
                // how can I get selected value here
                beforeSend: function () {
                    // alert("Send data ...")

                },
                success: function (data) {
                    $('#datas').html("");
                    $.each(data.employees, function (i, data) {
                        var div_datae = '<tr> <td class="pt-3 alex-name-2"> <div class="container"> <div class="row"> <div class="col-md-5 m-0 p-0"> <span class="alex-name"> <img class="img-whih-table" src=' + data.img + ' alt="std-icon"/> </span> </div><div class="col-md-7 m-0 p-0 alex-21 mt-2"> <span class="alex-name ml-3" id="name">' + data.name + '</span> </div></div></div></td><td class="pt-4">123456789</td><td class="pt-4"> <span href="#" data-toggle="tooltip" title="harramlaraib127@gmail.com">' + data.email + '</span> </td><td class="pt-4">' + data.subject + '</td><td class="pt-4">' + data.location + '</td><td class="pt-4">Advance</td><td class="pt-4" id="avalibility">' + data.avaiblilty + '</td><td class="pt-4">' + data.rate + '</td>   <td class="pt-3 float-right"> <a href=' + data.button + ' class="cencel-btn btn"> View </a> </td><td class="pt-3 float-right"> <button class="schedule-btn" data-toggle="modal" data-target="#exampleModalCenter">Assign</button> </td></tr>';
                        $('#datas').append(div_datae);
                        window.history.pushState("object or string", "", "/new-url") = data;
                        // window.pushState = data;
                        // window.location.replace("your_url")
                        // var url = $(this).val();
                        // if (url) {
                        //     window.location = url;
                        // }
                        // return false;

                    });

                },

            });
        });

        $('#rate-number').change(function () {
            $.ajax({
                url: "/assets/js/ticket-id.json",
                type: "GET",
                data: {
                    id: $("#home-ticket-1").val(),
                    location: $("#search-location").val(),
                    student: $("#TypeFeed").val(),
                    avaiblilty: $("#availability-id").val(),

                },
                // how can I get selected value here
                beforeSend: function () {
                    // alert("Send data ...")
                },
                success: function (data) {
                    $('#datas').html("");
                    $.each(data.employees, function (i, data) {
                        var div_datae = '<tr> <td class="pt-3 alex-name-2"> <div class="container"> <div class="row"> <div class="col-md-5 m-0 p-0"> <span class="alex-name"> <img class="img-whih-table" src=' + data.img + ' alt="std-icon"/> </span> </div><div class="col-md-7 m-0 p-0 alex-21 mt-2"> <span class="alex-name ml-3" id="name">' + data.name + '</span> </div></div></div></td><td class="pt-4">123456789</td><td class="pt-4"> <span href="#" data-toggle="tooltip" title="harramlaraib127@gmail.com">' + data.email + '</span> </td><td class="pt-4">' + data.subject + '</td><td class="pt-4">' + data.location + '</td><td class="pt-4">Advance</td><td class="pt-4" id="avalibility">' + data.avaiblilty + '</td><td class="pt-4">' + data.rate + '</td>   <td class="pt-3 float-right"> <a href=' + data.button + ' class="cencel-btn btn"> View </a> </td><td class="pt-3 float-right"> <button class="schedule-btn" data-toggle="modal" data-target="#exampleModalCenter">Assign</button> </td></tr>';
                        $('#datas').append(div_datae);
                    });

                },
            });
        });

        $('#sort-by-home').change(function () {
            $.ajax({
                url: "/assets/js/ticket-id.json",
                type: "GET",
                data: {
                    id: "1",
                },
                // how can I get selected value here
                beforeSend: function () {
                    // alert("Send data ...")
                },
                success: function (data) {
                    $('#datas').html("");
                    $.each(data.employees, function (i, data) {
                        var div_datae = '<tr> <td class="pt-3 alex-name-2"> <div class="container"> <div class="row"> <div class="col-md-5 m-0 p-0"> <span class="alex-name"> <img class="img-whih-table" src=' + data.img + ' alt="std-icon"/> </span> </div><div class="col-md-7 m-0 p-0 alex-21 mt-2"> <span class="alex-name ml-3" id="name">' + data.name + '</span> </div></div></div></td><td class="pt-4">123456789</td><td class="pt-4"> <span href="#" data-toggle="tooltip" title="harramlaraib127@gmail.com">' + data.email + '</span> </td><td class="pt-4">' + data.subject + '</td><td class="pt-4">' + data.location + '</td><td class="pt-4">Advance</td><td class="pt-4" id="avalibility">' + data.avaiblilty + '</td><td class="pt-4">' + data.rate + '</td>   <td class="pt-3 float-right"> <a href=' + data.button + ' class="cencel-btn btn"> View </a> </td><td class="pt-3 float-right"> <button class="schedule-btn" data-toggle="modal" data-target="#exampleModalCenter">Assign</button> </td></tr>';
                        $('#datas').append(div_datae);
                    });
                },
            });
        });

        $('#home-category').change(function () {
                // var url = $(this).val();
            $.ajax({
                url: "/assets/js/ticket-id.json",
                type: "GET",
                data: {

                    ticketNo: $("#home-ticket").val(),
                    userName: $("#home-user").val(),
                    status: $("#home-status").val(),

                },
                // how can I get selected value here
                beforeSend: function () {
                    // alert("Send data ...")
                },
                success: function (data) {
                    $('#datashow').html("");
                    $.each(data.employees, function (i, data) {
                        var div_datae = ' <tr> <td class="pt-4"> <span>' + data.ticket + '</span> </td><td class="pt-4">' + data.user + '</td><td class="pt-4">' + data.ticketSubject + '</td><td class="pt-4">' + data.category + '</td><td class="pt-4">' + data.date + '</td><td class="pt-4">' + data.answerby + '</td><td class="pt-4"> <span class="pending-text">' + data.pending + '</span> </td><td class="pt-3 float-right"> <a href=' + data.button + ' class="schedule-btn btn">View</a> </td></tr>';
                        $('#datashow').append(div_datae);
                        window.location = url; // redirect
                    });
                },
            });
        });

        $('#home-status').change(function () {
            $.ajax({
                url: "/assets/js/ticket-id.json",
                type: "GET",
                data: {

                    ticketNo: $("#home-ticket").val(),
                    userName: $("#home-user").val(),
                    status: $("#home-category").val(),

                },
                // how can I get selected value here
                beforeSend: function () {
                    // alert("Send data ...")
                },
                success: function (data) {
                    $('#datashow').html("");
                    $.each(data.employees, function (i, data) {
                        var div_datae = ' <tr> <td class="pt-4"> <span>' + data.ticket + '</span> </td><td class="pt-4">' + data.user + '</td><td class="pt-4">' + data.ticketSubject + '</td><td class="pt-4">' + data.category + '</td><td class="pt-4">' + data.date + '</td><td class="pt-4">' + data.answerby + '</td><td class="pt-4"> <span class="pending-text">' + data.pending + '</span> </td><td class="pt-3 float-right"> <a href=' + data.button + ' class="schedule-btn btn">View</a> </td></tr>';
                        $('#datashow').append(div_datae);
                    });
                },
            });
        });

        $('#sort-by-home-1').change(function () {
            $.ajax({
                url: "/assets/js/ticket-id.json",
                type: "GET",
                data: {
                    id: "2",
                },
                // how can I get selected value here
                beforeSend: function () {
                    // alert("Send data ...")
                },
                success: function (data) {
                    $('#datas').html("");
                    $.each(data.employees, function (i, data) {
                        var div_datae = ' <tr> <td class="pt-4"> <span>' + data.ticket + '</span> </td><td class="pt-4">' + data.user + '</td><td class="pt-4">' + data.ticketSubject + '</td><td class="pt-4">' + data.category + '</td><td class="pt-4">' + data.date + '</td><td class="pt-4">' + data.answerby + '</td><td class="pt-4"> <span class="pending-text">' + data.pending + '</span> </td><td class="pt-3 float-right"> <a href=' + data.button + ' class="schedule-btn btn">View</a> </td></tr>';
                        $('#datashow').append(div_datae);
                    });
                },
            });
        });

        var _seed = 42;
        Math.random = function () {
            _seed = _seed * 16807 % 2147483647;
            return (_seed - 1) / 2147483646;
        };




    });


    function get_all_notifications() {
        $.ajax({
            url: "{{route('getNotification')}}",
            type:"GET",
            dataType:'json',
            success:function(response){
                var obj = response.data;
                if(response.status_code == 200 && response.success == true) {
                    var notif = obj.slice(0, 3)
                    var notification = ``;
                    var notificationDash = ``;
                    if(obj.length == 0){
                    $('.show_notification_counts').css("display","none");

                        $('.show_notification_counts').text(0);
                        notification += `
                                            <li class="text-center">
                                                No more unread notifications
                                            </li>`;
                        notificationDash += `
                        <div class="notification-hover row mt-2 pt-2 pb-2 m-0 p-0 w-100">
                                            <div class=" col-md-12 pl-2 m-0 p-0 ">
                                                <span class="notification-text-home text-center">
                                                   Notifications not found
                                                </span>
                                            </div>
                                        </div>`;

                        $(".show_all_notifications").html(notification);
                        $("#dashNotif").html(notificationDash);
                    }else{
                        $(".show_notification_counts").addClass("notification-text");
                        $('.show_notification_counts').text(obj.length);
                        for(var i =0; i < obj.length; i++) {
                            let img = '';

                            if(obj[i].sender_pic != null){
                                img = `<img class="profile-img w-100 p-0 mt-2" src="{{asset('`+obj[i].sender_pic+`')}}" alt="layer">`;
                            }
                            else{
                                img = `<img class="profile-img w-100 p-0 mt-2" src="{{asset('assets/images/ico/Square-white.jpg')}}" alt="layer">`;
                            }
                        notification +=`
                        <li>
                            <a href="`+obj[i].slug+`" class="bgm">
                                <div class="row">
                                    <div class="col-md-2 pr-0 text-center">
                                    `+img+`
                                    </div>
                                    <div class="col-md-10">
                                        <div class="head-1-noti">
                                            <span class="notification-text6">
                                                <strong>` +obj[i].noti_title+ ` </strong>
                                                `+obj[i].noti_desc+`
                                            </span>
                                        </div>
                                        <span class="notification-time">
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>`;
                        }
                        $(".show_all_notifications").html(notification);

                        for(var i =0; i < notif.length; i++) {

                            notificationDash +=`
                            <div class="w-100 container-bg-1 mr-2 pb-2 pt-0 notifiaction-margin " >
                                <div class="notification-hover row mt-2 pt-2 pb-2 m-0 p-0 w-100">
                                    <div class=" col-md-9 pl-2 m-0 p-0 ">
                                        <span class="notification-text-home">
                                            `+notif[i].noti_desc+`
                                        </span>
                                    </div>
                                    <div class="col-md-3 m-0 p-0">
                                        <span class="heading-sixth row time-top float-right mr-2">
                                            `+ getTimeInterval(new Date(notif[i].created_at)) +`
                                        </span>
                                    </div>
                                </div>
                            </div>`;

                        }
                        $("#dashNotif").html(notificationDash);

                    }
                }else{

                }
            },
            error:function(e) {
                console.log(e)
            }
        });
    }


    function allRead(event){
        event.preventDefault();
            $.ajax({
                url: "{{ route('markAllRead') }}",
                type: "get",
                dataType: 'json',
                cache: false,
                async:false,
                success: function(data) {
                    get_all_notifications();
                    // $('.message-item').remove();

                },
                failure: function(errMsg) {
                    console.log(errMsg);
                }
            });

    };



    var generateDayWiseTimeSeries = function (baseval, count, yrange) {
        var i = 0;
        var series = [];
        while (i < count) {
            var x = baseval;
            var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

            series.push([x, y]);
            baseval += 86400000;
            i++;
        }
        return series;
    }

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function getTimeInterval(date) {
        let seconds = Math.floor((Date.now() - date) / 1000);
        let unit = "second";
        let direction = "ago";
        if (seconds < 0) {
            seconds = -seconds;
            direction = "from now";
        }
        let value = seconds;
        if (seconds >= 31536000) {
            value = Math.floor(seconds / 31536000);
            unit = "year";
        } else if (seconds >= 86400) {
            value = Math.floor(seconds / 86400);
            unit = "day";
        } else if (seconds >= 3600) {
            value = Math.floor(seconds / 3600);
            unit = "hour";
        } else if (seconds >= 60) {
            value = Math.floor(seconds / 60);
            unit = "minute";
        }
        if (value != 1)
            unit = unit + "s";
        return value + " " + unit + " " + direction;
        }


    </script>


@if(\Request::path() === 'admin/dashboard')
    <script>

        var options = {
            series: [],
            chart: {
                type: 'area',
                //   height: 'auto',
                height: '240vh',
                stacked: true,
                events: {
                    selection: function (chart, e) {
                        console.log(e,chart)
                    }
                },
            },
            colors: ['#008FFB', '#00E396', '#CED4DC'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            fill: {
                type: 'gradient',
                gradient: {
                    opacityFrom: 0.6,
                    opacityTo: 0.8,
                }
            },
            legend: {
                position: 'top',
                horizontalAlign: 'left'
            },
            noData: {
            text: 'Loading...'
            },


        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();



        var updateChart = function() {
                $.ajax({
                url: "{{ route('admin.dash.graph') }}",
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    var user = data.tutor.length + data.student.length + data.staff.length
                    chart.updateSeries([{
                        name: 'Tutor',
                        data: data.tutor
                    },
                    {
                        name: 'Student',
                        data: data.student
                    },
                    {
                        name: 'Staff',
                        data: data.staff
                    }
                    ])

                    $("#users").html(data.users)
                },
                error: function(data){
                    console.log(data);
                }
            });
        }


        updateChart();
        setInterval(() => {
            updateChart();
            get_all_notifications();
        }, 1000);



        var options2 = {
            series: [{
                name: 'Inflation',
                data: [2.3, 3.1, 4.0, 10.1, 4.0,]
            }],
            chart: {
                height: '250vh',
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    dataLabels: {
                        position: 'top', // top, center, bottom
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + "%";
                },
                offsetY: -20,
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            },

            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                position: 'bottom',
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                crosshairs: {
                    fill: {
                        type: 'gradient',
                        gradient: {
                            colorFrom: '#D8E3F0',
                            colorTo: '#BED1E6',
                            stops: [0, 100],
                            opacityFrom: 0.4,
                            opacityTo: 0.5,
                        }
                    }
                },
                tooltip: {
                    enabled: true,
                }
            },
            yaxis: {
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                    formatter: function (val) {
                        return val + "%";
                    }
                }

            },
            title: {
                text: 'Monthly Inflation in Argentina, 2002',
                floating: true,
                offsetY: 330,
                align: 'center',
                style: {
                    color: '#444'
                }
            }
        };

        var chart1 = new ApexCharts(document.querySelector("#columnchart"), options2);
        chart1.render();
        // keypress modal js
        // get input field and add 'keyup' event listener
        let searchInput = document.querySelector('.search-input');
        searchInput.addEventListener('keyup', search);

        if(document.getElementById("defaultOpen")){
            document.getElementById("defaultOpen").click();
        }
    </script>
@endif
