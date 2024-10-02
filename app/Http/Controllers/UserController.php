<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgetPasswordMail;
use App\Models\Likes;
use App\Models\Logo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //  login method
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $users = User::where('email', $request->email)->first();

        if ($users->role == 'admin') {
            if (Auth::attempt($credentials)) {
                return redirect()->route('HomePage');
            } else {
                return redirect()->route('login.page');
            }
        } else {
            if (Auth::attempt($credentials)) {
                return redirect()->route('HomePage');
            } else {
                return redirect()->route('login.page');
            }
        }
    }

    public function HomePage()
    {

        return redirect()->route('welcomePage');
    }

    // Logout Method
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.page');
    }


    public function MyPost()
    {

        $users = Post::join('post_categories', 'posts.category', '=', 'post_categories.id')
            ->where('posts.user_id', Auth::id())
            ->select('posts.*', 'post_categories.category')
            ->paginate(7);
        return view('user.MyPost', compact('users'));
    }
    // forget Password Methods

    public function forgetPassword()
    {
        return view('user.forgetPassword');
    }

    public function forgetPasswordProcess(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(60);

        DB::table('forgetpasswordtokens')->where('email', $request->email)->delete(); // delete any existing token

        DB::table('forgetpasswordtokens')->insert([
            'email' => $request->email,
            'token' => $token,
        ]);

        $user = User::whereEmail($request->email)->first();

        $formData = [
            'user' => $user,
            'token' => $token,
            'mailSubject' => 'You Have Request For Reset Password',
        ];

        Mail::to($request->email)->send(new ForgetPasswordMail($formData));
        return redirect()->route('forgetPassword')->with('success', 'Password Reset Link Has Been Sent
        To Your Email');
    }

    public function resetPassword($token)
    {
        $tokenExist = DB::table('forgetpasswordtokens')->where('token', $token)->first();

        if (!$tokenExist) {
            return redirect()->route('forgetPassword')->with('error', 'Invalid Token');
        } else {
            return view('user.resetPasswordForm', compact('token'));
        }
    }

    public function resetPasswordProcess(Request $request)
    {
        $request->validate([
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        $tokenExist = DB::table('forgetpasswordtokens')->where('token', $request->token)->first();

        if (!$tokenExist) {
            return redirect()->route('login.page')->with('error', 'Invalid Token');
        } else {
            User::whereEmail($tokenExist->email)->update([
                'password' => hash::make($request->new_password),
            ]);
            DB::table('forgetpasswordtokens')->where('token', $request->token)->delete();
            return redirect()->route('login.page')->with('success', 'Password Has Been Reset');
        }
    }

    // profile setting methods

    public function profileSetting()
    {
        $users = User::whereId(Auth::id())->first();

        return view('user.profilesetting', compact('users'));
    }

    public function accountSetting()
    {
        $users = User::whereId(Auth::id())->first();

        return view('user.accountSetting', compact('users'));
    }

    public function accountSettingProcess(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'password' => 'required',
            'userName' => 'required',
            'email' => 'required|email',
            'userDateOB' => 'required|date',
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Invalid Password');
        } else {
            $user->update([
                'userName' => $request->userName,
                'email' => $request->email,
                'userDateOB' => $request->userDateOB,
            ]);

            return redirect()->route('accountSetting')->with('accountSuccess', 'Your information successfully Updated');
        }
    }


    //  changePassword methods

    public  function changePassword()
    {
        return view('user.changePassword');
    }
    public  function changePasswordProcess(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
            'new_password_confirmation' => 'required',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('changePassword')->with('changeError', 'Invalid Current Password');
        } else {
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return redirect()->route('changePassword')->with('changeSuccess', 'Your Password Successfuly Changed');
        }
    }


    //  Overview section Methods
    public function overviewPosts()
    {
        $users = User::withWhereHas('posts', function ($sql) {
            $sql->where('user_id', Auth::id())
                ->withCount(['likes', 'comments', 'views', 'shares']);;
        })->get();
        $postCount = Post::count();

        return view('user.overviewPosts', compact('users', 'postCount'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::whereHas('posts', function ($sql) {
            $sql->where('state', 'publish');
        })
            ->with(['posts' => function ($sql) {
                $sql->withCount(['likes', 'comments', 'views', 'shares']);
                //  دغه کوډ به مونګ ته په لایک ټیبل کی یو کالم جوړ کړی په نوم ده لایک کونټ او پکی به ده کونټ ویلیو وی
            }])
            ->get();

        // return $users;

        $postCount = Post::count();

        $logo = Logo::get();


        return view('welcome', compact('users', 'postCount', 'logo'));
    }
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
        $request->validate([
            'userName' => 'required',
            'userImage' => 'required|mimes:png,jpg,jpeg,webp,gif|max:3000',
            'userEmail' => 'required|email',
            'userPassword' => 'required',
            'userDateOB' => 'required',
            'userGander' => 'required',

        ]);

        $userImage = $request->userImage->store('userImage', 'public');

        if ($request->role) {
            $user =   User::create([
                'userName' => $request->userName,
                'userImage' => $userImage,
                'email' => $request->userEmail,
                'password' => Hash::make($request->userPassword),
                'userDateOB' => $request->userDateOB,
                'userGander' => $request->userGander,
                'role' => $request->role,
            ]);

            if ($user) {
                return redirect()->back()->with('success', 'You Have Successfully Registered ! Now into Loginded .');
            } else {
                return redirect()->route('registerPage');
            }
        } else {
            $user =   User::create([
                'userName' => $request->userName,
                'userImage' => $userImage,
                'email' => $request->userEmail,
                'password' => Hash::make($request->userPassword),
                'userDateOB' => $request->userDateOB,
                'userGander' => $request->userGander,
            ]);

            if ($user) {
                return redirect()->back()->with('success', 'You Have Successfully Registered ! Now into Loginded .');
            } else {
                return redirect()->route('registerPage');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $request->validate([
            'password' => 'required',
            'profileImg' => 'required|mimes:png,jpg,jpeg.webp|max:3000',
        ]);
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Invalid Password');
        } else {
            if ($request->hasFile('profileImg')) {
                $imageOldPath = public_path('/storage/') . $user->userImage;
                if (file_exists($imageOldPath)) {
                    @unlink($imageOldPath);
                }
                $imagepath = $request->profileImg->store('userImage', 'public');

                $user->userImage = $imagepath;

                $user->save();

                return redirect()->route('profileSetting')->with('profileSuccess', 'Your Image Successfully Updated');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
