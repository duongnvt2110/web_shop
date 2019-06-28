<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    //
    public function uploadImage()
    {
        request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // $imageName = time().'.'.request()->image->getClientOriginalExtension();

        // request()->image->move(public_path('images'), $imageName);

        request()->file('image')->store('images', 'public');

    }
}
