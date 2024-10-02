<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function postCommentsProcess(Request $request, $postId)
    {

        $request->validate([
            'comments' => 'required'
        ]);

        $post = Post::find($postId);
        if (!$post) {
            return redirect()->back()->with('CommentsError', 'Post Not Fount');
        }
        $post->comments()->create([
            'comment' => $request->comments,
            'user_id' => Auth::id()
        ]);
        return redirect()->route('welcomePage')->with('CommentsSuccess', 'Comment Added Successfully');
    }

    public function postComments($postId)
    {
        $postId = Post::findOrFail($postId);

        // return $postId;
        return view('posts.postComments', compact('postId'));
    }
}
