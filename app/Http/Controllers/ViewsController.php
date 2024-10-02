<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Views;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewsController extends Controller
{
    public function postViews($postId)
    {
        $users = Auth::user();
        $existView = Views::where('user_id', $users->id)->where('post_id', $postId)->first();
        if ($existView) {
            $existView->delete();
            return redirect()->back();
        } else {
            Views::create([
                'post_id' => $postId,
                'user_id' => $users->id,
            ]);
            return redirect()->back();
        }
    }
}
