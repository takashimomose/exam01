<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Support\Facades\Session;   //10/9セッション用に追記

class ContactController extends Controller
{
    public function index()
    {
        // 10/9セッション用に追記　セッションデータをクリア
        Session::forget('contact_data');

        $categories = Category::all();

        return view('index', ['categories' => $categories]);
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel_part1', 'tel_part2', 'tel_part3', 'address', 'building', 'category_id', 'detail']);

        // 10/9セッション用に追記　セッションにデータを保存
        Session::put('contact_data', $contact);

        return view('confirm', compact('contact'));
    }

    public function store(ContactRequest $request)
    {
        $contact = $request->only(['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'category_id', 'detail']);
        Contact::create($contact);

        return redirect()->route('thanks');
    }

    public function back()
    {
        // 10/9セッション用に追記　セッションからデータを取得
        $contactData = Session::get('contact_data');

        // データをフォームに渡す
        return redirect('/')->withInput($contactData);
    }
}
