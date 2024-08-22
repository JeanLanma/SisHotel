<?php

namespace App\Http\Controllers\Contact;

use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\SupportContactEmail;
use Illuminate\Http\Request;

class SupportContactController extends Controller
{
    public function send()
    {
        Mail::to('desarrollo.software@pcbtroniks.com')->send(new SupportContactEmail());
       return redirect()->route('admin.reservations.index')->with('success', 'Mensaje enviado.');
    }
}
