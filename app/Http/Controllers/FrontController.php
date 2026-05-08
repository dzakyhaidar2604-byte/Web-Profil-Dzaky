<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use App\Models\Contact;

class FrontController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::latest()->take(6)->get();
        return view('welcome', compact('portfolios'));
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Contact::create($request->all());
        return back()->with('success', 'Pesan berhasil dikirim!');
    }
}
