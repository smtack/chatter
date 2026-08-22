<?php

namespace App\Http\Controllers;

class LocaleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(string $language)
    {
        app()->setLocale($language);

        session()->put('locale', $language);

        return redirect()->back();
    }
}
