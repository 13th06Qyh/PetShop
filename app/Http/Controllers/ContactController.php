<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\LienHe;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public $data = [];
    private $lienhe;
    public function __construct()
    {
        $this->lienhe = new LienHe();
    }
    public function getContract()
    {
        $this->data['title'] = 'Liên hệ ';
        $this->data['tentieude'] = 'Liên hệ ';
        return view('user.pages.contact', $this->data);
    }
    public function postEmail(Request $request)
    {
        $user_id =  Auth::user()->id;
        // $this->lienhe->insert(['user_id' => $user_id, 'created_at' => date('Y:m:d H:i:s')]);

        $user_send = $request->email;
        $mess_email = $request->message;
        $chude_email = $request->subject;

        $email = $this->buildEmail($user_send, $mess_email, $chude_email);
        Mail::to($user_send)->send($email);
        // return 'true';
        return redirect()->back();
    }
    public function buildEmail($user_send, $mess_email, $chude_email)
    {
        //chaydi

        return new ContactMail($user_send , $mess_email, $chude_email);
    }
}