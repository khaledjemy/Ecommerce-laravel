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
         'email'=>'required|string|max:255',
         'message'=>'required|string|max:255',
      ]);

     Contact::create($data);
     return redirect()->route('contact');
    }

    public function send(Request $request)
    {
      $data = $request->validate([
        'name'=>'required|string|max:255',
         'email'=>'required|string|max:255',
         'message'=>'nullable|string|max:255',
       
      ]);

     Contact::create($data);
     return redirect()->route('contact');
    }

}
