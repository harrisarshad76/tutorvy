<?php

use App\Events\ChatMessage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\LoginController as AdminLogin;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TutorController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\IntegrationController;
use App\Http\Controllers\Admin\KnowledgeController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\General\GeneralController;
use App\Http\Controllers\Tutor\HomeController as TutorHomeController;
use App\Http\Controllers\Tutor\BookingController;
use App\Http\Controllers\Tutor\CalendarController;
use App\Http\Controllers\Tutor\ClassController;
use App\Http\Controllers\Tutor\SubjectController as TutorSubjectController;
use App\Http\Controllers\Tutor\CourseController as TutorCourseController;
use App\Http\Controllers\Tutor\HistoryController;
use App\Http\Controllers\Tutor\PaymentController;
use App\Http\Controllers\Tutor\SettingController as TutorSettingController;
use App\Http\Controllers\Tutor\AssessmentController;
use App\Http\Controllers\Tutor\ProfileController;
use App\Http\Controllers\Student\BookingController as StudentBookingController;
use App\Http\Controllers\Student\HomeController as StudentHomeController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\TutorController as StudentTutorController;
use App\Http\Controllers\Student\StudentClassController as StudentClassController;
use App\Http\Controllers\Student\SettingController as StudentSettingController;
use App\Http\Controllers\General\ChatController;
use App\Http\Controllers\Student\WalletController;

use App\Http\Controllers\General\GenChatController;
use App\Http\Controllers\General\NotifyController;
use App\Http\Controllers\Frontend\TutorController as FrontTutorController;
use App\Models\Chat;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/


Route::get('/admins',[AdminLogin::class,'index']);
Route::post('admin/login',[AdminLogin::class,'login'])->name('admin.login');
Route::get('admin/logout',[AdminLogin::class,'logout'])->name('admin.logout');

Route::group(['prefix' => '/admin','middleware' => ['auth','admin']],function () {

    Route::get('/dashboard',[HomeController::class,'index'])->name('admin.dashboard');



    Route::get('/tutor',[TutorController::class,'index'])->name('admin.tutor');
    Route::get('/tutor/profile/{id}',[TutorController::class,'profile'])->name('admin.tutorProfile');
    Route::get('/tutor/profile/{id}/edit',[TutorController::class,'editProfile'])->name('admin.tutorProfile.edit');
    Route::get('/tutor/{id}/subjects/',[TutorController::class,'subjects'])->name('admin.tutorSubjects');

    Route::post('/tutor-plans',[TutorController::class,'showTutorPlans'])->name('admin.tutor.plans');

    Route::get('tutor/request/{id}/{assess_id?}',[TutorController::class,'tutorRequest'])->name('admin.tutorRequest');
    Route::get('tutor/assessment/{assessment_id}',[TutorController::class,'tutorAssessment'])->name('admin.tutotAssessment');

    Route::get('tutor/get-assessment',[TutorController::class,'getTutorAssessment'])->name('admin.getTutotAssessment');

    Route::get('/tutor-request/{id}',[TutorController::class,'tutor_course_Request'])->name('admin.tutor-request');
    Route::get('/tutor-profile',[TutorController::class,'tutor_course_profile'])->name('admin.tutor-profile');
    Route::get('/tutor-class',[TutorController::class,'tutor_subject_class'])->name('admin.tutor-class');
    Route::get('/all-tutor-req',[TutorController::class,'all_tutor_req'])->name('admin.all-tutor-req');
    Route::get('/all-tutors',[TutorController::class,'all_tutors'])->name('admin.all-tutors');


    Route::post('tutor/verify-assessment',[TutorController::class,'verifyAssessment'])->name('admin.verifyAssessment');
    Route::post('tutor/verify-tutor',[TutorController::class,'verifyTutor'])->name('admin.verifyTutor');
    Route::get('tutor/activitylog/{id}',[TutorController::class,'activitylog'])->name('admin.tutor.activitylog');

    Route::post('tutor/tutor-verfication',[TutorController::class,'tutorVerification'])->name('admin.tutor.verification');
    Route::post('tutor/change-tutor-status',[TutorController::class,'tutorStatus'])->name('admin.tutor.status');
    Route::post('assignTutor',[TutorController::class,'assignTutor'])->name('admin.tutor.assign');


    Route::get('/student',[StudentController::class,'index'])->name('admin.student');
    Route::get('/student/profile/{id}',[StudentController::class,'profile'])->name('admin.studentProfile');
    Route::get('/student/profile/{id}/edit',[StudentController::class,'editProfile'])->name('admin.studentProfile.edit');
    Route::post('student/change-student-status',[StudentController::class,'studentStatus'])->name('admin.studentStatus');
    Route::post('student/delete-student',[StudentController::class,'deleteStudent'])->name('admin.deleteStudent');
    Route::post('assignStudent',[StudentController::class,'assignStudent'])->name('admin.assign.student');
    Route::get('student/activitylog/{id}',[StudentController::class,'activitylog'])->name('admin.student.activitylog');
    Route::get('student/paidpayments/{id}',[StudentController::class,'paidPayments'])->name('admin.student.paidpayments');
    Route::get('student/reports/{id}',[StudentController::class,'reports'])->name('admin.student.reports');

    Route::get('/classroom',[ClassroomController::class,'index'])->name('admin.classroom');
    Route::get('/classdetail/{id}',[ClassroomController::class,'classdetail'])->name('admin.classdetail');
    Route::get('/booking',[AdminBookingController::class,'index'])->name('admin.booking');
    Route::get('/booking-details/{id}',[AdminBookingController::class,'bookingDetails'])->name('admin.bookingDetail');

    Route::get('/course',[CourseController::class,'index'])->name('admin.course');
    Route::get('/course-request/{id}',[CourseController::class,'courseRequest'])->name('admin.course-request');
    Route::get('/course-profile/{id}',[CourseController::class,'courseProfile'])->name('admin.course-profile');
    Route::get('/course-edit/{id?}',[CourseController::class,'editCourseProfile'])->name('admin.course-edit');
    Route::post('/courseUpdate',[CourseController::class,'update'])->name('admin.course.update');
    Route::post('course/change-course-status',[CourseController::class,'courseStatus'])->name('admin.courseStatus');
    Route::post('course/delete-course',[CourseController::class,'deleteCourse'])->name('admin.deleteCourse');
    Route::post('assignCourse',[CourseController::class,'assignCourse'])->name('admin.assign.course');


    Route::get('/subject',[SubjectController::class,'index'])->name('admin.subject');
    Route::post('/subject/insert-subject',[SubjectController::class,'insertSubject'])->name('admin.insertSubject');
    Route::post('/subject/update-subject',[SubjectController::class,'updateSubject'])->name('admin.updateSubject');
    Route::post('/subject/delete-subject',[SubjectController::class,'deleteSubject'])->name('admin.deleteSubject');
    Route::post('/subject/status',[SubjectController::class,'status'])->name('admin.status');



    Route::get('/website',[WebsiteController::class,'index'])->name('admin.website');
    Route::get('/report',[ReportController::class,'index'])->name('admin.report');
    Route::get('/integration',[IntegrationController::class,'index'])->name('admin.integration');
    Route::post('/save-payal',[IntegrationController::class,'savePaypalDetails']);
    Route::post('/verify-integration',[IntegrationController::class,'verfiyIntegration']);
    Route::post('/integration-status',[IntegrationController::class,'changeIntegrationStatus']);

    Route::get('/staff',[StaffController::class,'index'])->name('admin.staff');
    Route::post('/staff/insert',[StaffController::class,'insertStaff'])->name('admin.insertStaff');
    Route::get('/staff/profile/{id}',[StaffController::class,'staffProfile'])->name('admin.staffProfile');
    Route::get('/staff/profile/{id}/tasks',[StaffController::class,'alltasks'])->name('admin.staff.tasks');

    Route::get('/role-permission/{id}',[StaffController::class,'rolePermission'])->name('admin.role.permission');
    Route::post('/role-permission-store',[StaffController::class,'saveRolePermission'])->name('admin.save.permission');

    Route::get('/role',[StaffController::class,'role'])->name('admin.role');
    Route::post('/role/insert-role',[StaffController::class,'insertRole'])->name('admin.insertRole');
    Route::post('/role/delete-role',[StaffController::class,'deleteRole'])->name('admin.deleteRole');
    Route::post('/role/update-role',[StaffController::class,'updateRole'])->name('admin.updateRole');



    Route::get('/knowledge',[KnowledgeController::class,'index'])->name('admin.knowledge');
    Route::get('/support',[SupportController::class,'index'])->name('admin.support');

    Route::get('/ticket/{id}',[SupportController::class,'ticket'])->name('admin.ticket');

    Route::get('/ticket-reply',[SupportController::class,'ticketReply'])->name('admin.ticketReply');
    Route::post('/ticket-chat',[SupportController::class,'ticketChat'])->name('admin.ticketChat');
    Route::post('/assignTicket',[SupportController::class,'assignTicket'])->name('admin.assign.ticket');
    Route::post('/ticketStatus',[SupportController::class,'ticketStatus'])->name('admin.ticketStatus');

    Route::get('/setting',[SettingController::class,'index'])->name('admin.setting');

    Route::get('/activity-logs',[SettingController::class,'activityLogs'])->name('admin.activity.logs');

    Route::post('/save-profile',[SettingController::class,'saveProfile'])->name('admin.profile');

    Route::post('/change-password',[SettingController::class,'changePassword'])->name('admin.change.password');
    Route::post('/save-system-etting',[SettingController::class,'saveSystemSetting'])->name('admin.save.system-setting');
    // Route to get all subjects form api call

    Route::get('/api_subjects',[SubjectController::class,'getSubjectsFromApi']);

    Route::get('/category',[SupportController::class,'category'])->name('admin.category');
    Route::post('/save-category',[SupportController::class,'saveCategory'])->name('admin.save.category');
    Route::post('/delete-category',[SupportController::class,'deleteCategory'])->name('admin.delete.category');

    Route::get('graphData',[HomeController::class,'graphData'])->name('admin.dash.graph');


});

/*
|--------------------------------------------------------------------------
| Staff Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => '/staff','middleware' => ['auth','staff']],function () {

    Route::get('/dashboard',[HomeController::class,'index'])->name('staff.dashboard');
    Route::get('/tutor',[TutorController::class,'index'])->name('staff.tutor');
    Route::get('/tutor/profile/{id}',[TutorController::class,'profile'])->name('staff.tutorProfile');
    Route::get('/tutor/{id}/subjects/',[TutorController::class,'subjects'])->name('staff.tutorSubjects');

    Route::post('/tutor-plans',[TutorController::class,'showTutorPlans'])->name('staff.tutor.plans');

    Route::get('tutor/request/{id}/{assess_id?}',[TutorController::class,'tutorRequest'])->name('staff.tutorRequest');
    Route::get('tutor/assessment/{assessment_id}',[TutorController::class,'tutorAssessment'])->name('staff.tutotAssessment');

    Route::get('tutor/get-assessment',[TutorController::class,'getTutorAssessment'])->name('staff.getTutotAssessment');

    Route::get('/tutor-request/{id}',[TutorController::class,'tutor_course_Request'])->name('staff.tutor-request');
    Route::get('/tutor-profile',[TutorController::class,'tutor_course_profile'])->name('staff.tutor-profile');
    Route::get('/tutor-class',[TutorController::class,'tutor_subject_class'])->name('staff.tutor-class');
    Route::get('/all-tutor-req',[TutorController::class,'all_tutor_req'])->name('staff.all-tutor-req');
    Route::get('/all-tutors',[TutorController::class,'all_tutors'])->name('staff.all-tutors');


    Route::post('tutor/verify-assessment',[TutorController::class,'verifyAssessment'])->name('staff.verifyAssessment');
    Route::post('tutor/verify-tutor',[TutorController::class,'verifyTutor'])->name('staff.verifyTutor');

    Route::post('tutor/tutor-verfication',[TutorController::class,'tutorVerification'])->name('staff.tutor.verification');
    Route::post('tutor/change-tutor-status',[TutorController::class,'tutorStatus'])->name('staff.tutor.status');


    Route::get('/student',[StudentController::class,'index'])->name('staff.student');
    Route::get('/student/profile/{id}',[StudentController::class,'profile'])->name('staff.studentProfile');
    Route::post('student/change-student-status',[StudentController::class,'studentStatus'])->name('staff.studentStatus');
    Route::post('student/delete-student',[StudentController::class,'deleteStudent'])->name('staff.deleteStudent');

    Route::get('/classroom',[ClassroomController::class,'index'])->name('staff.classroom');
    Route::get('/booking',[staffBookingController::class,'index'])->name('staff.booking');
    Route::get('/booking-details/{id}',[staffBookingController::class,'bookingDetails'])->name('staff.bookingDetail');

    Route::get('/course',[CourseController::class,'index'])->name('staff.course');
    Route::get('/course-request/{id}',[CourseController::class,'courseRequest'])->name('staff.course-request');
    Route::get('/course-profile/{id}',[CourseController::class,'courseProfile'])->name('staff.course-profile');
    Route::get('/course-edit',[CourseController::class,'editCourseProfile'])->name('staff.course-edit');
    Route::post('course/change-course-status',[CourseController::class,'courseStatus'])->name('staff.courseStatus');
    Route::post('course/delete-course',[CourseController::class,'deleteCourse'])->name('staff.deleteCourse');


    Route::get('/subject',[SubjectController::class,'index'])->name('staff.subject');
    Route::post('/subject/insert-subject',[SubjectController::class,'insertSubject'])->name('staff.insertSubject');
    Route::post('/subject/update-subject',[SubjectController::class,'updateSubject'])->name('staff.updateSubject');
    Route::post('/subject/delete-subject',[SubjectController::class,'deleteSubject'])->name('staff.deleteSubject');



    Route::get('/website',[WebsiteController::class,'index'])->name('staff.website');
    Route::get('/report',[ReportController::class,'index'])->name('staff.report');
    Route::get('/integration',[IntegrationController::class,'index'])->name('staff.integration');
    Route::post('/save-payal',[IntegrationController::class,'savePaypalDetails']);
    Route::post('/verify-integration',[IntegrationController::class,'verfiyIntegration']);
    Route::post('/integration-status',[IntegrationController::class,'changeIntegrationStatus']);

    Route::get('/staff',[StaffController::class,'index'])->name('staff.staff');
    Route::post('/staff/insert',[StaffController::class,'insertStaff'])->name('staff.insertStaff');
    Route::get('/staff/profile/{id}',[StaffController::class,'staffProfile'])->name('staff.staffProfile');

    Route::get('/role-permission/{id}',[StaffController::class,'rolePermission'])->name('staff.role.permission');
    Route::post('/role-permission-store',[StaffController::class,'saveRolePermission'])->name('staff.save.permission');

    Route::get('/role',[StaffController::class,'role'])->name('staff.role');
    Route::post('/role/insert-role',[StaffController::class,'insertRole'])->name('staff.insertRole');
    Route::post('/role/delete-role',[StaffController::class,'deleteRole'])->name('staff.deleteRole');
    Route::post('/role/update-role',[StaffController::class,'updateRole'])->name('staff.updateRole');



    Route::get('/knowledge',[KnowledgeController::class,'index'])->name('staff.knowledge');
    Route::get('/support',[SupportController::class,'index'])->name('staff.support');

    Route::get('/ticket/{id}',[SupportController::class,'ticket'])->name('staff.ticket');

    Route::get('/ticket-reply',[SupportController::class,'ticketReply'])->name('staff.ticketReply');
    Route::post('/ticket-chat',[SupportController::class,'ticketChat'])->name('staff.ticketChat');
    Route::post('/assignTicket',[SupportController::class,'assignTicket'])->name('staff.assign.ticket');

    Route::get('/setting',[SettingController::class,'index'])->name('staff.setting');

    Route::get('/activity-logs',[SettingController::class,'activityLogs'])->name('staff.activity.logs');

    Route::post('/save-profile',[SettingController::class,'saveProfile'])->name('staff.profile');

    Route::post('/change-password',[SettingController::class,'changePassword'])->name('staff.change.password');
    Route::post('/save-system-etting',[SettingController::class,'saveSystemSetting'])->name('staff.save.system-setting');
    // Route to get all subjects form api call

    Route::get('/api_subjects',[SubjectController::class,'getSubjectsFromApi']);

    Route::get('/category',[SupportController::class,'category'])->name('staff.category');
    Route::post('/save-category',[SupportController::class,'saveCategory'])->name('staff.save.category');
    Route::post('/delete-category',[SupportController::class,'deleteCategory'])->name('staff.delete.category');




});

/*
|--------------------------------------------------------------------------
| Tutor Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => '/tutor','middleware' => ['auth','tutor']],function () {

    // remove
    Route::post('/testing',[TutorSettingController::class,'testing'])->name('tutor.testing');
    Route::post('/save_time_zone',[TutorSettingController::class,'saveTimeZone'])->name('tutor.timeZone');

    Route::get('/dashboard',[TutorHomeController::class,'index'])->name('tutor.dashboard');
    Route::get('/booking',[BookingController::class,'index'])->name('tutor.booking');
    Route::get('/booking-detail/{id}',[BookingController::class,'bookingDetail'])->name('tutor.booking.detail');
    Route::get('/booking-accept/{id}',[BookingController::class,'acceptBooking'])->name('tutor.booking.accept');

    Route::post('/cancelBooking/{id}',[BookingController::class,'cancelBooking'])->name('tutor.booking.cancel');
    Route::post('/rescheduleBooking/{id}',[BookingController::class,'rescheduleBooking'])->name('tutor.booking.reschedule');


    Route::post('/get-booking',[BookingController::class,'getBookingDetail'])->name('tutor.getBookingDetail');


    Route::get('/chat',[GenChatController::class,'index'])->name('tutor.chat');
    Route::get('/chatNew',[ChatController::class,'chatNew'])->name('tutor.chatNew');
    Route::get('/classroom',[ClassController::class,'index'])->name('tutor.classroom');
    Route::get('/calendar',[CalendarController::class,'index'])->name('tutor.calendar');
    Route::get('/support-ticket',[HistoryController::class,'index'])->name('tutor.history');

    Route::get('/payment',[PaymentController::class,'index'])->name('tutor.payment');
    Route::get('/payment/paypal-status',[PaymentController::class,'paypalResponseSuccess'])->name('tutor.payment.paypal_status');

    Route::post('/payment/paypal',[PaymentController::class,'withdrawWithPaypal'])->name('tutor.withdraw.paypal');

    Route::get('/subjects',[TutorSubjectController::class,'index'])->name('tutor.subject');
    Route::get('/subjects-all/{id}',[TutorSubjectController::class,'displaySub'])->name('tutor.subjectGet');



    Route::get('/reviews',[TutorSubjectController::class,'review'])->name('tutor.reviews');
    Route::get('/removesubjects/{id}',[TutorSubjectController::class,'destroy'])->name('tutor.remove.subject');
    Route::view('/skip','tutor.skip')->name('skip');
    Route::get('/assessment/{id}',[AssessmentController::class,'index'])->name('tutor.test');
    Route::post('/assessment',[AssessmentController::class,'store'])->name('tutor.assessment');
    Route::post('/subjectPlanUpdate',[AssessmentController::class,'update_sub_plan'])->name('tutor.update_sub_plan');

    //Course CRUD
    Route::get('/course',[TutorCourseController::class,'index'])->name('tutor.course');
    Route::get('/course/{id}/course-view',[TutorCourseController::class,'courseView'])->name('tutor.course.courseView');
    Route::get('/addcourse', [TutorCourseController::class,'create'])->name('tutor.addcourse');

    Route::post('/srtorecourse', [TutorCourseController::class,'store'])->name('tutor.storecourse');

    Route::get('/course/{id}/edit', [TutorCourseController::class,'edit'])->name('tutor.course.edit');
    Route::post('/course/{id}/update', [TutorCourseController::class,'update'])->name('tutor.course.update');

    Route::get('/courseClass',[TutorCourseController::class,'start_course_class'])->name('tutor.start_course_class');

    //Profile Routes
    Route::get('/profile',[ProfileController::class,'index'])->name('tutor.profile');
    Route::get('/profile-view/{id}',[ProfileController::class,'profile'])->name('tutor.profileView');
    Route::post('/tutor-plans',[ProfileController::class,'showTutorPlans'])->name('tutor.plans');

    Route::get('/viewstudent/{id}',[ProfileController::class,'show'])->name('tutor.student');

    Route::post('/updateprofile/{id}',[ProfileController::class,'profileUpdate'])->name('tutor.profile.update');

    Route::post('/updateedu/{id}',[ProfileController::class,'updateProfileEdu'])->name('tutor.profile.edu');
    Route::post('/updateprofession/{id}',[ProfileController::class,'updateProfileProfession'])->name('tutor.profile.profession');
    Route::post('/update_verification/{id}',[ProfileController::class,'updateProfileVerfication'])->name('tutor.profile.verfication');

    // Route::post('/updatevideo/{id}',[ProfileController::class,'uploadVideo'])->name('tutor.profile.video');
    Route::post('/updateprofilepic/{id}',[ProfileController::class,'uploadPic'])->name('tutor.profile.image');


    Route::get('/settings',[TutorSettingController::class,'index'])->name('tutor.settings');
    Route::post('/change-password',[TutorSettingController::class,'changePassword'])->name('tutor.changePassword');

    /**
     * Payment Configuration | Integeration
     */
    Route::post('storePaypal',[PaymentController::class,'paypalConfigure'])->name('paypal.conf');
    Route::post('delPayMethod',[PaymentController::class,'delPayMethod'])->name('del.payment');


    Route::get('/call',[TutorSettingController::class,'call'])->name('tutor.call');
    Route::get('/class/{class_room_id}',[TutorSettingController::class,'start_class'])->name('tutor.start_class');
    Route::get('/testmedia/{class_room_id}',[TutorSettingController::class,'testMedia'])->name('tutor.testmedia');




    Route::post('/save-class-logs',[ClassController::class,'saveClassLogs'])->name('tutor.class.logs');
    Route::post('/end-class',[ClassController::class,'endClass'])->name('tutor.class.end');

    Route::get('/whiteBoard',[TutorSettingController::class,'whiteBoard'])->name('tutor.whiteBoard');

    Route::post('/change-password',[TutorSettingController::class,'change_password'])->name('tutor.change.password');

    Route::get('/get-categories',[TutorSettingController::class,'getAllCategories'])->name('tutor.categories');
    Route::post('/save-ticket',[TutorSettingController::class,'saveTicket'])->name('tutor.save.ticket');

    Route::get('/ticket/{id}',[TutorSettingController::class,'ticket'])->name('tutor.ticket');
    Route::post('/ticket-chat',[TutorSettingController::class,'ticketChat'])->name('tutor.ticketChat');

    Route::post('/save_sloats',[TutorSettingController::class,'saveSlots'])->name('tutor.saveSlots');
    Route::post('/delete_sloats',[TutorSettingController::class,'deleteSlots'])->name('tutor.deleteSlots');

});

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
|
*/

Route::group(['prefix' => '/student','middleware' => ['auth','student']],function () {

    Route::get('/dashboard',[StudentHomeController::class,'index'])->name('student.dashboard');
    Route::get('/chat',[GenChatController::class,'index'])->name('student.chat');

    //Bookings
    Route::get('/bookings',[StudentBookingController::class,'index'])->name('student.bookings');

    Route::get('/book-now/{id}/{b_id}',[StudentBookingController::class,'bookNow'])->name('student.book-now');
    Route::post('/book_now',[StudentBookingController::class,'book_now'])->name('student.book-slot');

    Route::post('/get_slots',[StudentBookingController::class,'getTutorSlots'])->name('student.getTutorSlots');
    Route::post('/get_filtered_slots',[StudentBookingController::class,'getFilteredTimeSlot'])->name('student.getFilteredTutorSlots');


    Route::post('/bookNew',[StudentBookingController::class,'bookingNew'])->name('student.book-new');
    Route::post('/tutor-plan',[StudentBookingController::class,'tutorPlans'])->name('student.tutor.plans');

    Route::get('/booking-detail/{id}',[StudentBookingController::class,'bookingDetail'])->name('student.booking-detail');
    Route::get('/booking/{id}/tutor',[StudentBookingController::class,'directBooking'])->name('student.direct.booking');

    Route::post('/cancelBooking',[StudentBookingController::class,'cancelBooking'])->name('student.booking.cancel');
    Route::post('/rescheduleBooking',[StudentBookingController::class,'rescheduleBooking'])->name('student.booking.reschedule');

    Route::post('/booking/payment/{id}',[StudentBookingController::class,'bookingPayment'])->name('student.booking.payment');
    Route::get('/booking/paymentstatus',[StudentBookingController::class,'getPaymentStatus'])->name('student.paymentstatus');
    Route::post('/payment-done',[StudentBookingController::class,'paymentDone'])->name('student.payment-success');

    Route::post('/course/payment/{id}',[StudentBookingController::class,'coursePayment'])->name('student.course.payment');

    Route::get('/skrlpayment-complete',[StudentBookingController::class,'skrillPaymentComplete'])->name('skrill.payment.complete');

    Route::post('/booked',[StudentBookingController::class,'booked'])->name('student.booked.tutor');

    Route::get('/classroom',[StudentClassController::class,'index'])->name('student.classroom');

    Route::get('/wallet',[WalletController::class,'index'])->name('student.wallet');
    Route::post('/deposit-money',[WalletController::class,'depositMoney'])->name('student.deposit');


    Route::get('/skrillPayment/{amount}',[WalletController::class,'skrillPayment'])->name('skrill.payment');

    Route::get('/deposit-money-status',[WalletController::class,'getPaymentStatus'])->name('deposit.status');
    Route::get('/getskrillstatus',[WalletController::class,'getSkrillStatus']);
    Route::get('/skrillCancel',[WalletController::class,'skrillCancel']);

    Route::post('/save-review',[StudentClassController::class,'saveReview'])->name('student.save.review');

    Route::post('/save-classlogs',[StudentClassController::class,'saveClassLogs'])->name('student.classlogs');

    Route::get('/calendar',[CalendarController::class,'calendarStudent'])->name('student.calendar');
    // Route::get('/history',[HistoryController::class,'index'])->name('tutor.history');
    // Route::get('/payment',[PaymentController::class,'index'])->name('tutor.payment');
    Route::get('/tutor',[StudentTutorController::class,'index'])->name('student.tutor');
    Route::get('/viewtutor/{id}',[StudentTutorController::class,'show'])->name('student.tutor.show');
    Route::post('/tutorfilter',[StudentTutorController::class,'filterTutor'])->name('student.tutor.filter');
    Route::get('/contact/tutor/{id}', [GenChatController::class,'contactTutor']);

    Route::get('/settings',[StudentSettingController::class,'index'])->name('student.settings');
    Route::post('student-paymentmethod',[StudentSettingController::class,'paymentMethod'])->name('student.paymentmethod');
    Route::post('setDefaltPayment', [StudentSettingController::class,'setDefaultPayment']);
    Route::get('checkDfltPymntMthd', [StudentBookingController::class,'checkDefaultPaymentMethod'])->name('check.default.payment');
    Route::post('/change-password',[StudentSettingController::class,'change_password']);

    Route::get('/profile',[StudentProfileController::class,'index'])->name('student.profile');
    Route::get('/subSubject',[StudentProfileController::class,'subSubject'])->name('student.subSubject');
    Route::get('/profile-view/{id}',[StudentProfileController::class,'profile'])->name('student.profileView');
    Route::post('/tutor-plans',[StudentProfileController::class,'showTutorPlans'])->name('student.tutor.show.plans');


    Route::get('/call',[StudentSettingController::class,'call'])->name('student.call');
    Route::get('/class/{class_room_id}',[StudentSettingController::class,'join_class'])->name('student.join_class');
    Route::get('/testmedia/{class_room_id}',[StudentClassController::class,'testMedia'])->name('student.testmedia');


    Route::get('/whiteBoard',[StudentSettingController::class,'whiteBoard'])->name('student.whiteBoard');

    Route::post('/updateprofile',[StudentProfileController::class,'profileUpdate'])->name('student.profile.update');
    Route::post('/update_education',[StudentProfileController::class,'profileEducationRecord'])->name('student.education.update');
    Route::post('/update_verification',[StudentProfileController::class,'profileVerficationRecord'])->name('student.verification.update');

    Route::get('/get-categories',[StudentSettingController::class,'getAllCategories'])->name('student.categories');
    Route::post('/save-ticket',[StudentSettingController::class,'saveTicket'])->name('student.save.ticket');

    Route::get('/support-tickets',[StudentBookingController::class,'history'])->name('student.history');

    Route::post('/fav-tutor',[StudentSettingController::class,'favouriteTutor'])->name('student.fav.tutor');
    Route::get('/ticket/{id}',[StudentSettingController::class,'tickets'])->name('student.ticket');
    Route::post('/ticket-chat',[StudentSettingController::class,'ticketChat'])->name('student.ticketChat');
    /*Course */
    Route::get('/course-details/{id}',[StudentSettingController::class,'courseDetails'])->name('student.course-details');
    Route::get('/courses',[StudentSettingController::class,'courses'])->name('student.courses');
    /*Course  End*/


    Route::post('/save_time_zone',[StudentProfileController::class,'saveTimeZone'])->name('student.timeZone');


});

/*
|--------------------------------------------------------------------------
| General Routes
|--------------------------------------------------------------------------
|
*/
Route::group(['prefix' => '/general','middleware' => ['auth']],function () {

    Route::get('chat',[GenChatController::class,'chatContact'])->name('chat');
    Route::get('chat/fetchmsg/{id}',[GenChatController::class,'fetchMessages'])->name('fetch.msg');
    Route::post('chat/store',[GenChatController::class,'sendMessage'])->name('store.text');
    Route::post('chat/store/class',[GenChatController::class,'sendClassMessage'])->name('store.classtext');
    Route::get('call/signal',[GenChatController::class,'sendSignal'])->name('tutor.sendsignal');
    Route::get('chat/user/talk/{id}',[GenChatController::class,'messages_between'])->name('user.chat');

    Route::post('/save-token',[NotifyController::class,'saveToken'])->name('general.save.token');
    Route::get('/get-notifications',[NotifyController::class,'getAllNotification'])->name('getNotification');
    Route::get('/mark_all_read',[NotifyController::class,'markAllRead'])->name('markAllRead');
    Route::get('/mark_all_seen/{id}',[GenChatController::class,'markAllSeen'])->name('markAllSeen');

});

Route::get('/unreadmsg', [ChatController::class,'unreadMesg']);
Route::get('/contacts', [ChatController::class,'get']);
Route::get('/conversation/{id}', [ChatController::class,'getMessagesFor']);
Route::post('/conversation/send', [ChatController::class,'send']);
Route::post('/attachment/send', [ChatController::class,'sendAttachment']);

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
*/

Auth::routes(['verify' => true]);
//Google
Route::get('/google/redirect/{c_id?}', [LoginController::class,'redirectGoogle'])->name('social.google');
// Route::get('/google/redirect/{c_id?}', [LoginController::class,'redirectGoogle'])->name('social.google');
Route::post('/login/google', [LoginController::class,'googleLoggin'])->name('login.google');
Route::post('/login/check', [LoginController::class,'checkLogin'])->name('login.check');
// Facebook

Route::get('/facebook/redirect/{c_id?}', [LoginController::class,'redirectFacebook'])->name('social.facebook');
Route::get('/login/facebook/callback', [LoginController::class,'handleFacebookCallback']);

Route::get('/student/register',[RegisterController::class,'showStudentRegistrationForm'])->name('student.register')->middleware('guest');
Route::post('/register',[RegisterController::class,'register'])->name('tutor.register')->middleware('guest');
Route::get('/validate_email',[RegisterController::class,'validate_email'])->name('validate.email');
Route::view('/logged','auth.loginpass')->name('logged')->middleware('guest');
//Reset Password
Route::post('/validate_otp',[ResetPasswordController::class,'checkOtp'])->name('check.otp');
Route::view('/resetPassword','auth.reset')->name('reset.password');
Route::post('/updatePassword',[ResetPasswordController::class,'updatePassword'])->name('update.password');
Route::post('/resendOtp',[ResetPasswordController::class,'resendOtp'])->name('resend.otp');


//Route::view('/','welcome');
Route::get('/',[GeneralController  ::class,'home']);
Route::get('/subjects-all/{id}',[GeneralController::class,'displaySub'])->name('subjectGet');
// Route::get('/',[GeneralController::class,'home']);

Route::get('/widget',[FrontTutorController::class,'widgetTech'])->name('whiteBoard.canvas');
Route::get('/student',[FrontTutorController::class,'subjects']);


// Route::get('/widget',[FrontTutorController::class,'widgetTech'])->name('whiteBoard.canvas');
Route::view('/role','role');
Route::get('/register_role',[GeneralController  ::class,'loginOnRole'])->name('register.role');
Route::view('/tutor','frontend.tutor');
// Route::view('/student','frontend.student');
//Route::view('/subject','frontend.subject');
Route::get('/subject',[GeneralController  ::class,'subjects']);
// Route::view('/course','frontend.course');

Route::get('/course',[GeneralController::class,'course']);
Route::get('courseenroll/{id}',[GeneralController::class,'enroll'])->name('course.enroll');

Route::get('/findtutor/{subject?}',[FrontTutorController::class,'index']);
Route::post('/findtutor',[FrontTutorController::class,'filterTutor'])->name('find.tutor');
Route::get('/tutor-profile/{id}',[FrontTutorController::class,'profileTutor'])->name('profile.tutor');


// Blog
Route::get('/blog',[GeneralController::class,'blog'])->name('blog');

Route::get('/career',[GeneralController::class,'career'])->name('career');
Route::get('/knowledge',[GeneralController::class,'knowledge'])->name('knowledge');
Route::get('/privacy-policy',[GeneralController::class,'privacyPolicy'])->name('privacy-policy');
/*
|--------------------------------------------------------------------------
| Ajax Calls Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/universities',[GeneralController::class,'university'])->name('uni.name');
Route::post('/checkEmail',[GeneralController::class,'isEmailTaken'])->name('available.email');


/*
|--------------------------------------------------------------------------
| Api Calls Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/mails', [App\Http\Controllers\HomeController::class, 'mail']); 
    

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
