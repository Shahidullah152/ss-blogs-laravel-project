<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\fileExists;

class PostController extends Controller
{

    // Draft & Publish Posts Methods

    public function draftPosts()
    {
        $draftPosts = Post::join('post_categories', 'posts.category', 'post_categories.id')
            ->where('posts.user_id', Auth::id())
            ->whereState('draft')
            ->paginate(7);

        return view('user.draftPosts', compact('draftPosts'));
    }
    public function publishPosts()
    {
        $publishPosts = Post::join('post_categories', 'posts.category', 'post_categories.id')
            ->where('posts.user_id', Auth::id())
            ->whereState('publish')
            ->paginate(7);

        return view('user.publishPosts', compact('publishPosts'));
    }


    // Home Page Categories Posts Methods

    public function MobileCategory()
    {

        $users = User::withWhereHas('posts', function ($sql) {
            $sql->where('posts.state', 'publish')
                ->join('post_categories', 'posts.category', '=', 'post_categories.id')
                ->where('post_categories.category', 'Mobile')
                ->withCount(['likes', 'comments', 'views']);
        })->get();

        return view('categories.mobileCategory', compact('users'));
    }

    public function CarCategory()
    {

        $users = User::withWhereHas('posts', function ($sql) {
            $sql->where('posts.state', 'publish')
                ->join('post_categories', 'posts.category', '=', 'post_categories.id')
                ->where('post_categories.category', 'Car')
                ->withCount(['likes', 'comments', 'views']);
        })->get();



        return view('categories.carCategory', compact('users'));
    }
    public function SopportCategory()
    {

        $users = User::withWhereHas('posts', function ($sql) {
            $sql->where('posts.state', 'publish')
                ->join('post_categories', 'posts.category', '=', 'post_categories.id')
                ->where('post_categories.category', 'Sopport')
                ->withCount(['likes', 'comments', 'views']);
        })->get();

        return view('categories.sopportCategory', compact('users'));
    }
    public function ComputerCategory()
    {

        $users = User::withWhereHas('posts', function ($sql) {
            $sql->where('posts.state', 'publish')
                ->join('post_categories', 'posts.category', '=', 'post_categories.id')
                ->where('post_categories.category', 'Computer')
                ->withCount(['likes', 'comments', 'views']);
        })->get();

        return view('categories.computerCategory', compact('users'));
    }

    //  Overview Section Categories Methods
    public function MobileCategoryOverview()
    {

        $users = User::withWhereHas('posts', function ($sql) {
            $sql->where('posts.state', 'publish')
                ->join('post_categories', 'posts.category', '=', 'post_categories.id')
                ->where('post_categories.category', 'Mobile')
                ->withCount(['likes', 'comments', 'views']);
        })->whereId(Auth::id())->get();

        return view('categories.mobileCategoryOverview', compact('users'));
    }

    public function CarCategoryOverview()
    {

        $users = User::withWhereHas('posts', function ($sql) {
            $sql->where('posts.state', 'publish')
                ->join('post_categories', 'posts.category', '=', 'post_categories.id')
                ->where('post_categories.category', 'Car')
                ->withCount(['likes', 'comments', 'views']);
        })->whereId(Auth::id())->get();

        return view('categories.carCategoryOverview', compact('users'));
    }
    public function SopportCategoryOverview()
    {

        $users = User::withWhereHas('posts', function ($sql) {
            $sql->where('posts.state', 'publish')
                ->join('post_categories', 'posts.category', '=', 'post_categories.id')
                ->where('post_categories.category', 'Sopport')
                ->withCount(['likes', 'comments', 'views']);
        })->whereId(Auth::id())->get();

        return view('categories.sopportCategoryOverview', compact('users'));
    }
    public function ComputerCategoryOverview()
    {

        $users = User::withWhereHas('posts', function ($sql) {
            $sql->where('posts.state', 'publish')
                ->join('post_categories', 'posts.category', '=', 'post_categories.id')
                ->where('post_categories.category', 'Computer')
                ->withCount(['likes', 'comments', 'views']);
        })->whereId(Auth::id())->get();

        return view('categories.computerCategoryOverview', compact('users'));
    }


    // post_likes_comments_shares_views methods

    public function post_likes_comments_shares_views($id)
    {
        $posts = Post::with(['comments.user'])->find($id);
        $comments = $posts->comments;

        return view('posts.post_likes_comments_shares_views', compact('posts', 'comments'));
    }



    // YourDashboardPage Methods

    public function YourDashboardPage()
    {
        $posts = Post::with(['likes', 'views', 'comments', 'shares'])
            ->join('post_categories', 'posts.category', '=', 'post_categories.id')
            ->select('posts.*', 'post_categories.category')
            ->withCount(['comments', 'likes', 'shares', 'views'])
            ->whereUser_id(Auth::id())
            ->get();

        // User Posts
        $users = User::whereId(Auth::id())->first();
        $allPosts = Post::whereUser_id(Auth::id())->count();


        // All User Information
        $allPostsCount = Post::count();
        $allUsers = User::count();
        $allUsersInfo = User::with('posts')->withCount('posts')->paginate(5);
        $allCategory = PostCategory::count();
        $allMaleUser = User::where('userGander', 'male')->count();
        $allFemaleUser = User::where('userGander', 'female')->count();

        return view('user.YourDashboardPage', compact('posts', 'allPosts', 'allPostsCount', 'allUsersInfo', 'allCategory', 'allUsers', 'allMaleUser', 'allFemaleUser'));
    }


    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post =   $request->validate([
            'title' => 'required|max:20',
            'description' => 'required|max:150',
            'category' => 'required',
            'Date' => 'required',
            'state' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,webp|max:4000',
        ]);

        if (!$post) {
            return redirect()->back()->with('error', '');
        }

        $image_path = $request->image->store('post_images', 'public');


        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'Date' => $request->Date,
            'state' => $request->state,
            'image' => $image_path,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('post-category.index')->with('success', 'Your Post successfully Added !');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $singePost = Post::whereId($id)->first();

        return view('user.postSingleShow', compact('singePost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $posts = Post::select('posts.*', 'post_categories.category')
            ->join('post_categories', 'posts.category', '=', 'post_categories.id')
            ->where('posts.id', $id)
            ->first();

        $postCategory = PostCategory::all();

        // $posts = DB::table('posts')->join('post_categories', 'posts.category', '=', 'post_categories.Post_Category')
        //     ->select('posts.*', 'post_categories.Post_Category')->where('posts.id', $id)->first();

        // return $posts;
        return view('user.postUpdate', compact('posts', 'postCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $posts = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|max:20',
            'description' => 'required|max:150',
            'category' => 'required',
            'Date' => 'required',
            'state' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,gif,webp|max:4000',
        ]);


        if ($request->hasFile('image')) {
            $image_path_old = public_path('/storage/') . $posts->Image;
            if (file_exists($image_path_old)) {
                @unlink($image_path_old);
            }
        }
        $image_path_new = $request->image->store('post_images', 'public');
        $posts->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'Date' => $request->Date,
            'state' => $request->state,
            'image' => $image_path_new,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('welcomePage')->with('updatePostSuccess', 'Your Post successfully Updated !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $posts = Post::findOrFail($id);
        $image_path_old = public_path('/storage/') . $posts->Image;
        if (file_exists($image_path_old)) {
            @unlink($image_path_old);
        }
        $posts->delete();
        return redirect()->back()->with('success', 'Your Post successfully Deleted
            !');
    }
}
