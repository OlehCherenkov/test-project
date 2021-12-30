<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFromRequest;
use App\Mail\ContactForm;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::orderByDesc('created_at')->limit(3)->get();
        return view('welcome', compact('posts'));
    }

    public function showContactForm()
    {
        return view('contact_form');
    }

    public function sendContactForm(ContactFromRequest $request)
    {
        Mail::to('samsunggio570@gmail.com')->send(new ContactForm($request->validated()));
        return redirect(route('contactform'));
    }
}
