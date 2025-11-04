<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Mail\ContactFormSubmitted;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $allowedCategories = ['daerah', 'nasional', 'internasional', 'opini'];
        $breaking = Article::with('category')
            ->whereHas('category', fn($q) => $q->whereIn('name', $allowedCategories))
            ->where('is_featured',1)
            ->latest('tanggal_posting')
            ->take(2)
            ->get();
        return view('contacts.index', compact(
            'allowedCategories',
            'breaking'
        ));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required','string','max:100'],
            'email'   => ['required','email','max:150'],
            'telp'    => ['required','string','max:12'],
            'subject' => ['required','string','max:150'],
            'message' => ['required','string','max:5000'],
        ]);

        //  $to = config('mail.from.address');
        $to = 'ramadhanrafi871@gmail.com';
        Mail::to($to)->send(new ContactFormSubmitted($data));

        return back()->with('success', 'Pesan berhasil dikirim. Terima kasih!');
    }
}
