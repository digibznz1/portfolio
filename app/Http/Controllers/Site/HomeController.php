<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Member;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.index');

    }//end of index

    public function about()
    {
        $members = Member::all();

        return view('site.about', compact('members'));

    }//end of about

    public function changeLanguage(Language $language)
    {
        abort_if(!in_array($language->code, Language::pluck('code')->toArray()), 400);

        session()->put('code', $language->code);
        session()->put('dir', $language->dir);
        
        return redirect()->back();

    }//end of changeLanguage

}//end of controller