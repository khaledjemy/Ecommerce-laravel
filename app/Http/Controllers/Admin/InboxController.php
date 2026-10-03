<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function index(Request $request)
    {
        $kind = $request->query('kind', 'message');
        abort_unless(in_array($kind, ['message', 'subscription'], true), 404);

        return view('admin.inbox', [
            'kind' => $kind,
            'entries' => Contact::where('kind', $kind)->latest()->paginate(20),
        ]);
    }
}
