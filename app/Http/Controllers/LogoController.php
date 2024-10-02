<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function addLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|mimes:jpg,jpeg,png,gif,svg|max:3000'
        ]);
        $logoPath = $request->logo->store('logos', 'public');

        Logo::create([
            'logoURL' => $logoPath
        ]);
        return redirect()->back()->with('succss', 'Logo Updated Succeefuly');
    }
}
