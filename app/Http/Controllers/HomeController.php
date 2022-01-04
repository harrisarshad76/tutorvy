<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function mail(){

        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {

            // Email server settings
            $mail->SMTPDebug = 1;
            $mail->isSMTP();
            $mail->Host = 'smtp-relay.sendinblue.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'info@zubairafzal.com';   //  sender username
            $mail->Password = 'BG3c0PCZtOIkpJUw';       // sender password
            $mail->SMTPSecure = 'tls';                  // encryption - ssl/tls
            $mail->Port = 587;                          // port - 587/465

            $mail->setFrom('info@tutorvy.test', 'Tutorvy');
            $mail->addAddress('muhammadkashif70000@gmail.com');

            // if(isset($_FILES['emailAttachments'])) {
            //     for ($i=0; $i < count($_FILES['emailAttachments']['tmp_name']); $i++) {
            //         $mail->addAttachment($_FILES['emailAttachments']['tmp_name'][$i], $_FILES['emailAttachments']['name'][$i]);
            //     }
            // }

            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = 'Testing';
            $mail->Body    = 'Testing';
            // $mail->AltBody = plain text version of email body;
            if( !$mail->send() ) {
                dd($mail->ErrorInfo);exit;

                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
            else {
                dd('Email has been sent.');exit;
                return back()->with("success", "Email has been sent.");
            }

        } catch (Exception $e) {
             return back()->with('error','Message could not be sent.');
        }

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function role()
    {
        return view('role');
    }

}
