<script>
        var free = false;

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // image validation
        $("#imageUpload").on('change', function() {
            var file = this.files[0];

            if (Math.round(file.size / (1024 * 1024)) > 2) { 
                toastr.error('Please select image size less than 2 MB',{
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
                $("#imageUpload").val(" ");
                return false;
            } else{
                readURL(this);
            }
        });

        // update tutor profile
        $("#personal").submit(function(e) {
            e.preventDefault();

            var tech = $("#aboutTextarea").val();
            languageTest(tech);

            if(free == false){
                toastr.error('Please Use English Language only for Tutor Description',{
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
            }
            else if (free == true){
                var action = $(this).attr('action');
                var method = $(this).attr('method');
                var file =  $('#imageUpload')[0].files[0];
                var form = new FormData(this);

                if( $('#imageUpload')[0].files.length != 0 ) {
                    if(Math.round(file.size / (1024 * 1024)) > 2 ) {
                        toastr.error('Please select image size less than 2 MB',{
                            position: 'top-end',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2500
                        });

                    }else{
                        
                        uploadProfile(action , method , form)
                    }
                
                }else{
                    
                    uploadProfile(action , method , form)
                }
            }
        });

        // update tutor edu record
        $("#tutorEduDocsForm").submit(function(e) {
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

        // update tutor profession record
        $("#tutorProfessionForm").submit(function(e) {
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
                    $("#professinal_btn").hide();
                    $("#professinal_loading").show();
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
                    $("#professinal_btn").show();
                    $("#professinal_loading").hide();
                },
                error:function(e) {
                    console.log(e);
                    $("#professinal_btn").show();
                    $("#professinal_loading").hide();
                    toastr.error('Something Went Wrong',{
                        position: 'top-end',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }
            });

        });

        // update tutor verfication record
        $("#tutorVerficationForm").submit(function(e) {
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
                    $("#verfication_btn").hide();
                    $("#verfication_loading").show();
                },
                success:function(response){
                    if(response.status_code == 200 && response.success == true) {
                        toastr.success(response.message,{
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2500
                        });
                        $("#tutorVerficationForm").hide();
                        $("#verfication_msg").show();
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
                    $("#verfication_btn").show();
                    $("#verfication_loading").hide();
                },
                error:function(e) {
                    console.log(e);
                    $("#verfication_btn").show();
                    $("#verfication_loading").hide();
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

    function uploadProfile(action , method , form) {
        $.ajax({
            url: action,
            type:method,
            data:form,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend:function(data) {
                $("#general_save").hide();
                $("#general_loading").show();
            },
            success:function(response){
                if(response.status_code == 200 && response.success == true) {
                    toastr.success(response.message,{
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500
                    });
                    let img_path = response.path;
                    var origin   = window.location.origin

                    if(img_path != null && img_path != "" ){
                        $('.profile-img').attr('src',origin + '/'+ img_path );
                    }else{
                        $('.profile-img').attr('src', origin + '/assets/images/ico/Square-white.jpg');
                    }
                    
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
                $("#general_save").show();
                $("#general_loading").hide();
            },
            error:function(e) {
                $("#general_save").show();
                $("#general_loading").hide();
                console.log(e);
                toastr.error('Something Went Wrong',{
                    position: 'top-end',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 2500
                });
            }
        });
    }
    // document.getElementById("aboutTextarea").addEventListener("keyup", function() {
    //     if (/^[a-zA-Z]+$/.test(this.value) || /^\s+$/.test(this.value)) {
    //         document.getElementById("show_lang_in_here").innerHTML = "English";
    //     } else {
    //         document.getElementById("show_lang_in_here").innerHTML = "Persian";
    //     }
    // });
        function languageTest(testArea) {
            
            var test = testArea;
                if (test.includes('this')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes(' is ')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes(' a ')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('his')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('you')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('your')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('ing')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('the')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('them')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('was')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('am')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('are')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('were')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('not')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('he')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('her')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('I')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('and')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('can')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('has')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('have')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('had')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('help')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('for')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('from')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('also')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('my')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('when')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('where')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('there')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('in')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('but')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('love')) { 
                    // Found world
                    free = true;
                }
                else if (test.includes("I'm")) { 
                    // Found world
                    free = true;
                }
                else if (test.includes('to')) { 
                    // Found world
                    free = true;
                }
                // if(free == true){
                //     console.log("This is english");
                // }
                // else if(free ==  false){
                //     console.log("This is not english")
                // }
                return free;
        }

        function countChars(obj){
            document.getElementById("changeAble").innerHTML = obj.value.length;
        }
</script>