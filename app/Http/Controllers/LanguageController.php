<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request): RedirectResponse
    {
        $language = $request->input('language');
        session(['language' => $language]);
        return back();
    }
}
