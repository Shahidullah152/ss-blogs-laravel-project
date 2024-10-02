<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SharesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewsController;
use App\Http\Middleware\UserLogin;
use Illuminate\Routing\ViewController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'login')->name('login.page');

Route::get('/welcomePage', [UserController::class, 'index'])->name('welcomePage')->middleware(UserLogin::class);

Route::post('/loginForm', [UserController::class, 'login'])->name('loginForm');

Route::get('/HomePage', [UserController::class, 'HomePage'])->name('HomePage')->middleware(UserLogin::class);

Route::view('/post-form', 'user.post-form')->name('post-form')->middleware(UserLogin::class);

Route::view('/register', 'registraion')->name('registerPage');

Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware(UserLogin::class);



Route::resource('/post', PostController::class)->middleware(UserLogin::class);
Route::resource('post-category', PostCategoryController::class)->middleware(UserLogin::class);
// Route::get('postCategory/{id}', [PostCategoryController::class, 'postCategory'])->name('postCategory')->middleware(UserLogin::class);

Route::get('/MyPost', [UserController::class, 'MyPost'])->name('MyPost');


// draft & Publish Routes

Route::get('/draftPosts', [PostController::class, 'draftPosts'])->name('draftPosts');
Route::get('/publishPosts', [PostController::class, 'publishPosts'])->name('publishPosts');


// user sign up controller

Route::resource('/user', UserController::class);

// Forget Password Process
Route::get('/forgetPassword', [UserController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('/forgetPasswordProcess', [UserController::class, 'forgetPasswordProcess'])->name('forgetPasswordProcess');
Route::get('/resetPassword/{token}', [UserController::class, 'resetPassword'])->name('resetPassword');
Route::post('/resetPasswordProcess', [UserController::class, 'resetPasswordProcess'])->name('resetPasswordProcess');


// pforile setting

Route::get('/profileSetting', [UserController::class, 'profileSetting'])->name('profileSetting')->middleware(UserLogin::class);

// Account Setting

Route::get('/accountSetting', [UserController::class, 'accountSetting'])->name('accountSetting');
Route::put('/accountSettingProcess/{id}', [UserController::class, 'accountSettingProcess'])->name('accountSettingProcess');


// Change Password Routes

Route::get('/changePassword', [UserController::class, 'changePassword'])->name('changePassword');
Route::put('/changePasswordProcess/{id}', [UserController::class, 'changePasswordProcess'])->name('changePasswordProcess');

// update Post  Routes

//  Overview Section Routes
Route::get('/overviewPosts', [UserController::class, 'overviewPosts'])->name('overviewPosts')->middleware(UserLogin::class);


// Home Page Posts Categories Routes

Route::get('/MobileCategory', [PostController::class, 'MobileCategory'])->name('MobileCategory');
Route::get('/CarCategory', [PostController::class, 'CarCategory'])->name('CarCategory');
Route::get('/SopportCategory', [PostController::class, 'SopportCategory'])->name('SopportCategory');
Route::get('/ComputerCategory', [PostController::class, 'ComputerCategory'])->name('ComputerCategory');

// Overview Page Posts Categories Routes

Route::get('/MobileCategoryOverview', [PostController::class, 'MobileCategoryOverview'])->name('MobileCategoryOverview');
Route::get('/CarCategoryOverview', [PostController::class, 'CarCategoryOverview'])->name('CarCategoryOverview');
Route::get('/SopportCategoryOverview', [PostController::class, 'SopportCategoryOverview'])->name('SopportCategoryOverview');
Route::get('/ComputerCategoryOverview', [PostController::class, 'ComputerCategoryOverview'])->name('ComputerCategoryOverview');

// Like Controller
Route::get('/likes/{id}', [LikesController::class, 'postsLikes'])->name('postsLikes');

// Post Comments Routes

Route::get('/postComments/{id}', [CommentsController::class, 'postComments'])->name('postComments');
Route::post('postCommentsProcess/{id}', [CommentsController::class, 'postCommentsProcess'])->name('postCommentsProcess');

//  Post Views Routes
Route::get('/postViews/{id}', [ViewsController::class, 'postViews'])->name('postViews');

// Posts Shares Routes

Route::get('postShares/{id}', [SharesController::class, 'postShares'])->name('postShares');
Route::post('/postShareProcess/{id}', [SharesController::class, 'postShareProcess'])->name('postShareProcess');
// Posts All Like Comments View Shares Watch

Route::get('/post_likes_comments_shares_views/{id}', [PostController::class, 'post_likes_comments_shares_views'])->name('post_likes_comments_shares_views');

// Setting Routes
Route::get('/YourDashboardPage', [PostController::class, 'YourDashboardPage'])->name('YourDashboardPage');


//   Search Routes

Route::get('/search', [SearchController::class, 'search'])->name('search');


// admin dashboard routes

Route::view('/admin.dashboard', 'admin.dashboard')->name('admin.dashboard');

// add admin Routes

Route::view('/add.admin', 'admin.add-admin')->name('add.admin');

//  addLogo Routes

Route::post('/addLogo', [LogoController::class, 'addLogo'])->name('addLogo');
