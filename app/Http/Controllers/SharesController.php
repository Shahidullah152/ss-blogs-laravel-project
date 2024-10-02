<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Shares;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SharesController extends Controller
{
    public function postShares($postId)
    {
        $posts = Post::select('posts.*', 'post_categories.category')
            ->join('post_categories', 'posts.category', 'post_categories.id')
            ->where('posts.id', $postId)
            ->get();
        $post_category = PostCategory::all();
        return view('posts.postShares', compact('posts', 'post_category'));
    }

    public function postShareProcess(Request $request, $postId)
    {
        $request->validate([
            'title' => 'required|max:20',
            'description' => 'required|max:150',
            'category' => 'required',
            'Date' => 'required',
            'state' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,webp|max:4000',
        ]);



        $image_path = $request->image->store('post_images', 'public');


        $postShare =  Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'Date' => $request->Date,
            'state' => $request->state,
            'image' => $image_path,
            'user_id' => Auth::id(),
        ]);
        if ($postShare) {
            Shares::create([
                'post_id' => $postId,
                'user_id' => Auth::id(),
            ]);
            return redirect()->back()->with('success', 'Post Share Successfully');
        } else {
            return redirect()->back()->with('error', 'Post Share Failed');
        }
    }
}
