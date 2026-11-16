<?php

use App\Http\Controllers\Payment\StripeGatewayController;
use App\Http\Controllers\Web\AboutUsController;
use App\Http\Controllers\Web\ArticleController;
use App\Http\Controllers\Web\BookingProcessController;
use App\Http\Controllers\Web\CertificationController;
use App\Http\Controllers\Web\ChooseRoleController;
use App\Http\Controllers\Web\CommunityController;
use App\Http\Controllers\Web\CommunityUserPostCommentController;
use App\Http\Controllers\Web\CommunityUserPostCommentLikeController;
use App\Http\Controllers\Web\CommunityUserPostCommentReplyLikeController;
use App\Http\Controllers\Web\CommunityUserPostController;
use App\Http\Controllers\Web\CommunityUserPostLikeController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\EmailVerificationController;
use App\Http\Controllers\Web\GroupController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\NewsletterController;
use App\Http\Controllers\Web\PickNameController;
use App\Http\Controllers\Web\PrivacyPolicyController;
use App\Http\Controllers\Web\ProviderController;
use App\Http\Controllers\Web\SkillController;
use App\Http\Controllers\Web\TourCommentController;
use App\Http\Controllers\Web\TourCommentLikeController;
use App\Http\Controllers\Web\TourCommentReplyLikeController;
use App\Http\Controllers\Web\TourController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\UserPostCommentController;
use App\Http\Controllers\Web\UserPostCommentLikeController;
use App\Http\Controllers\Web\UserPostCommentReplyLikesController;
use App\Http\Controllers\Web\UserPostController;
use App\Http\Controllers\Web\UserPostLikeController;
use App\Http\Controllers\Web\VerifyEmailController;
use App\Livewire\PostsPage;
use App\Livewire\Profile;
use App\Models\Ticket;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;

use App\Providers\GoogleStorageServiceProvider;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/test", function () {
    return view('emails.change-password.change-password')->with("user", \App\Models\User::first());
});

Route::get("test2",[\App\Http\Controllers\Api\BookingController::class, 'update']);

// panels
Route::group(['middleware' => ['auth']], function () {

    Route::any("/manager-panel/{path?}/{path2?}/{path3?}/{path4?}", [UserController::class, 'managerPanel'])->name("manager-panel");

    Route::group(['middleware' => ['verified']], function () {
        Route::any("/admin-panel/{path?}/{path2?}/{path3?}/{path4?}", [UserController::class, 'adminPanel'])->name("admin-panel");
        Route::any("/teacher-panel/{path?}/{path2?}/{path3?}/{path4?}", [UserController::class, 'teacherPanel'])->name("teacher-panel");
        Route::any("/agent-panel/{path?}/{path2?}/{path3?}/{path4?}", [UserController::class, 'agentPanel'])->name("agent-panel");
        Route::any("/user-panel/{path?}/{path2?}/{path3?}/{path4?}", [UserController::class, 'userPanel'])->name("user-panel");
    });

    // Verifications
    Route::resource('/email/verify', EmailVerificationController::class)->only("index")->name('index', 'verification.notice');
    Route::resource('/email/verify/{id}/{hash}', EmailVerificationController::class)->only("store")->name('store', 'verification.verify')->middleware(['signed', 'throttle:6,1']);
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['throttle:6,1'])->name('verification.send');

    Route::get('/register-by-provider', [ProviderController::class, 'registerRole'])->name("registered-by-provider");
    Route::post('/register-by-provider', [ProviderController::class, 'update'])->name("update-registered-by-provider");


    Route::resource('choose-role', ChooseRoleController::class)->only(['index', 'store'])->name('index', 'choose-role');
    Route::resource('pick-name', PickNameController::class)->only(['index', 'store'])->name('index', 'pick-name');

    //Booking Process
    Route::prefix("tour/{tour:slug}/group/{group:slug}")->name("booking-process.")->group(function () {
        // Route::get('step1', function() {
        //     dd("jafar");
        // })->name("step1");

        Route::get('step1', [BookingProcessController::class, "step1"])->name("step1");
        Route::get('step2', [BookingProcessController::class, "step2"])->name("step2");
        Route::get('step3', [BookingProcessController::class, "step3"])->name("step3");
        Route::get('step4', [BookingProcessController::class, "step4"])->name("step4");

        Route::middleware("auth:sanction")->group(function () {
            Route::get('step5', [BookingProcessController::class, "step5"])->name("step5");
            Route::get('step6', [BookingProcessController::class, "step6"])->name("step6");
        });
    });

    //Strip Gateway
    Route::name('stripe.')
        ->controller(StripeGatewayController::class)
        ->prefix('stripe')
        ->group(function () {
            Route::get('payment', 'index')->name('index');
            Route::post('payment', 'store')->name('store');
            Route::post('success', 'success')->name('success');
        });

    Route::name('verify-email.')
        ->controller(VerifyEmailController::class)
        ->prefix('verify-email')
        ->group(function () {
            Route::get('', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::post('resend', 'resend')->name('resend');
        });

    Route::get("asghar", [StripeGatewayController::class, 'store']);
});

//Google Sign in
Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect'])->name("third-party.auth.redirect");
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback'])->name("third-party.auth.callback");

//Group
Route::resource('group', GroupController::class)->only('show');


//Route::get('livewire',\App\Livewire\ProfileLivewire::class);

Route::get('profile/{user:slug}', Profile::class)->name('profile');
Route::get('profile/{user:slug}/posts', PostsPage::class)->name('posts-page');


// Pages
Route::get('/', [HomeController::class, 'index'])->name("home-page");
Route::get('about-us', [AboutUsController::class, 'index'])->name("about-us");
Route::resource('contact-us', ContactController::class)->only(['index', 'store']);
Route::resource('verify', CertificationController::class)->only('index', 'store');
Route::resource('skill', SkillController::class)->scoped(['skill' => 'slug']);
Route::resource('newsletter', NewsletterController::class)->only('store');
//  article
Route::resource("blog", ArticleController::class)->only(['index', 'show'])->parameters(['blog' => 'article']);

//Route::get('pusher/auth', 'PusherController@pusherAuth');

// Tour
Route::resource('tour', TourController::class)->only('index');
Route::resource('tour', TourController::class)->only('show');
Route::resource('tour/{tour:slug}/comment', TourCommentController::class)->only('store')->middleware('auth');

Route::get('/tour/{slug}/tour-operation/{id}/booking', [TourController::class, 'booking'])->middleware(['auth', 'verified'])->name('tour-booking');

// Payment
Route::get('/payment/verify', [TourController::class, 'verification'])->name('verification');
//Route::get('/payment/verify/{Authority}/{Status}', [TourController::class, 'verification'])->name('verification');

// social media : profile, community, group
//  Profile
//Route::resource('profile', UserController::class)->only("show")->parameters(['profile' => 'user']);
Route::resource('profile/{user:slug}/post', UserPostController::class, ['as' => 'userPost'])->only("store");

Route::any('profile/{user:slug}/follow', [UserController::class, 'follow'])->name('profile.follow')->middleware('auth');
Route::any('profile/{user:slug}/unfollow', [UserController::class, 'unfollow'])->name('profile.unfollow')->middleware('auth');

Route::any('profile/{user:slug}/post/{userPost:id}/like', [UserPostLikeController::class, 'like'])->name('profile.post.like')->middleware('auth');
Route::any('profile/{user:slug}/post/{userPost:id}/like/{userPostLike:id}', [UserPostLikeController::class, 'dislike'])->name('profile.post.dislike')->middleware('auth');

Route::resource('profile/{user:slug}/post/{userPost:id}/comment', UserPostCommentController::class, ['as' => 'profile.post'])->only('store')->middleware('auth');
Route::any('profile/{user:slug}/post/{userPost:id}/comment/{userPostComment:id}/like', [UserPostCommentLikeController::class, 'like'])->name('profile.post.comment.like')->middleware('auth');
Route::any('profile/{user:slug}/post/{userPost:id}/comment/{userPostComment:id}/like/{userPostCommentLike:id}', [UserPostCommentLikeController::class, 'dislike'])->name('profile.post.comment.dislike')->middleware('auth');

Route::any('profile/{user:slug}/post/{userPost:id}/comment/{userPostComment:id}/reply/{userPostCommentReply:id}/like', [UserPostCommentReplyLikesController::class, 'like'])->name('profile.post.comment.reply.like')->middleware('auth');
Route::any('profile/{user:slug}/post/{userPost:id}/comment/{userPostComment:id}/reply/{userPostCommentReply:id}/like/{userPostCommentReplyLike:id}/like', [UserPostCommentReplyLikesController::class, 'dislike'])->name('profile.post.comment.reply.dislike')->middleware('auth');

//  Community
Route::post('community/{community:slug}/follow', [CommunityController::class, 'follow'])->name('community.follow')->middleware('auth');
Route::post('community/{community:slug}/unfollow', [CommunityController::class, 'unfollow'])->name('community.unfollow')->middleware('auth');

Route::resource('community/{community:slug}/post', CommunityUserPostController::class, ['as' => 'community'])->only('store')->middleware('auth');
Route::resource('community/{community:slug}/post/{communityUserPost:id}/comment', CommunityUserPostCommentController::class, ['as' => 'community.userPost'])->only('store')->middleware('auth');
Route::any('community/{community:slug}/post/{communityUserPost:id}/like', [CommunityUserPostLikeController::class, 'like'])->name('community.post.like')->middleware('auth');
Route::any('community/{community:slug}/post/{communityUserPost:id}/like/{communityUserPostLike:id}', [CommunityUserPostLikeController::class, 'dislike'])->name('community.post.dislike')->middleware('auth');
Route::any('community/{community:slug}/post/{communityUserPost:id}/comment/{communityUserPostComment:id}/like', [CommunityUserPostCommentLikeController::class, 'like'])->name('community.post.comment.like')->middleware('auth');
Route::any('community/{community:slug}/post/{communityUserPost:id}/comment/{communityUserPostComment:id}/like/{communityUserPostCommentLike:id}', [CommunityUserPostCommentLikeController::class, 'dislike'])->name('community.post.comment.dislike')->middleware('auth');
Route::any('community/{community:slug}/post/{communityUserPost:id}/comment/{communityUserPostComment:id}/reply/{communityUserPostCommentReply:id}/like', [CommunityUserPostCommentReplyLikeController::class, 'like'])->name('community.post.comment.reply.like')->middleware('auth');
Route::any('community/{community:slug}/post/{communityUserPost:id}/comment/{communityUserPostComment:id}/reply/{communityUserPostCommentReply:id}/like/{communityUserPostCommentReplyLik:id}', [CommunityUserPostCommentReplyLikeController::class, 'dislike'])->name('community.post.comment.reply.dislike')->middleware('auth');
Route::resource('community', CommunityController::class);


Route::resource('privacy-policy', PrivacyPolicyController::class)->only("index");

Route::get('/mailable', function () {
    $invoice = App\Models\User::where("fname", "=", "mohammad amin")->first();
//    $invoice = App\Models\Group::where("title", "=", "IELTS, preparation course 2022 02")->first();
//    $invoice = App\Models\Tour::where("title", "=", "Think Strategically and Make Your Ideas a Reality")->first();
//    dd($invoice);
//    \App\Events\CreateTourEvent::dispatch($invoice);
//    dd($invoice);
    return new \App\Mail\MembershipMail($invoice);
});


// change language
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
})->name('changeLanguage');
