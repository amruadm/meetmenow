<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Place;
use Mail;
use Session;

class PagesController extends Controller {

    public function getIndex() {
        $places = Place::orderBy('created_at', 'asc')->get(); //переписать код

        return view('pages.welcome')->withPlaces($places);
    }

    public function getAbout() {
        $first = 'MeetMeBabe';
        $last = 'Team';

        $fullname = $first . " " . $last;
        $email = 'meetmebabe@gmail.com';
        $data = [];
        $data['email'] = $email;
        $data['fullname'] = $fullname;

        return view('pages.about')->withData($data);
    }

    public function getContact() {
        return view('pages.contact');
    }

    public function postContact(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'subject' => 'min:3',
            'message' => 'min:10']);

        $data = array(
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message
        );

        Mail::send('emails.contact', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('pashukmint@gmail.com');
            $message->subject($data['subject']);
        });

        Session::flash('success', 'Ваш email послан!');

        return redirect('/');
    }


}