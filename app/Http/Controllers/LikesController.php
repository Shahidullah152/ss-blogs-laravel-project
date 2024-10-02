<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    public function postsLikes($postId)
    {
        $users = Auth::user();
        $existLikes = Likes::where('user_id', $users->id)->where('post_id', $postId)->first();
        if ($existLikes) {
            $existLikes->delete();
            return redirect()->back();
        } else {
            Likes::create([
                'post_id' => $postId,
                'user_id' => $users->id,
            ]);
            return redirect()->back()->with('Likesuccess', 'liked');
        }
    }
}
