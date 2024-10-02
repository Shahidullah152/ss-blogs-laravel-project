<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchValue = $request->input('search');

        $users = User::where('userName', 'LIKE', '%' . $searchValue . '%')
            ->orWhere('email', 'LIKE', '%' . $searchValue . '%')
            ->get();



        $posts = Post::with('user')->where('title', 'LIKE', '%' . $searchValue . '%')
            ->orWhere('description', 'LIKE', '%' . $searchValue . '%')
            ->withCount(['comments', 'likes', 'shares', 'views'])
            ->get();

        // $results = $posts->merge($users);

        // return $posts;
        return view('search.searchUsersData', compact('users', 'posts'));


        // if ($searchValue) {
        //     $users = User::where('userName', 'LIKE', '%' . $searchValue . '%')
        //         ->orWhere('email', 'LIKE', '%' . $searchValue . '%')
        //         ->get();
        // } else {
        //     $posts = Post::where('title', 'LIKE', '%' . $searchValue . '%')
        //         ->orWhere('description', 'LIKE', '%' . $searchValue . '%')
        //         ->get();
        //     return view('search.searchPostsData', compact('posts'));
        // }
    }
}
