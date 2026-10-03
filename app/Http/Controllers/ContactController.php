<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
      $data = $request->validate([
        'name'=>'required|string|max:255',
         'email'=>'required|email|max:255',
         'message'=>'required|string|max:2000',
      ]);

     Contact::create($data + ['kind' => 'message']);
     return redirect()->route('contact')->with('status', 'Your message was received.');
    }

    public function send(Request $request)
    {
      $data = $request->validate([
        'name'=>'required|string|max:255',
         'email'=>'required|email|max:255',
         'message'=>'nullable|string|max:255',
       
      ]);

     Contact::create($data + ['kind' => 'subscription']);
     return redirect()->route('contact')->with('status', 'Your subscription was received.');
    }

}
