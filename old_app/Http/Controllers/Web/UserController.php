<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use App\Models\UserPost;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display manager panel
     * @return string
     */
    public function managerPanel()
    {
        if (auth()->user()->hasRole("manager")) {
            return view("panels.manager-panel.manager-panel");
        }
        return redirect()->route("login");
    }

    /**
     * Display admin panel
     * @return string
     */
    public function adminPanel()
    {
        if (auth()->user()->hasRole("admin")) {
            return view("panels.admin-panel.admin-panel");
        }
        return redirect()->route("login");
    }

    /**
     * Display teacher panel
     * @return string
     */
    public function teacherPanel()
    {
        if (auth()->user()->hasRole("teacher")) {
            return view("panels.teacher-panel.teacher-panel");
        }
        return redirect()->route("login");
    }

    /**
     * Display teacher panel
     * @return string
     */
    public function agentPanel()
    {
        if (auth()->user()->hasRole("agent")) {
            return view("panels.agent-panel.agent-panel");
        }
        return redirect()->route("login");
    }

    /**
     * Display user panel
     *
     * @return View|RedirectResponse
     */
    public function userPanel()
    {
        if (auth()->user()->hasRole("user")) {
            return view("panels.user-panel.user-panel");
        }
        return redirect()->route("login");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Inertia\Response
     */
    public function show($slug)
    {
//        $user = User::with(
//            "userPosts","userPosts.contentImage","userPosts.userPostLikes","userPosts.userPostComments", "userPosts.userPostComments.user"
//            , "userPosts.userPostComments.user.profileImage","userPosts.userPostComments.userPostCommentLikes","userPosts.userPostComments.userPostCommentReplies"
//            ,"userPosts.userPostComments.userPostCommentReplies.user.profileImage","userPosts.userPostComments.userPostCommentReplies.userPostCommentReplyLikes",
//            "groups", "groups.thumbnailImage","communities","communities.thumbnailImage","profileImage","headerImage","socialMedia")->where("slug", "=", $slug)->where('email_verified_at', "<>", null)->first();
//
//        if($user) {
//            if (!$user->suspended && $user->hasRole(['user', 'teacher', 'agent'])) {
////            return view('profile.profile')->with('user', $user);
//                if(auth()->user()) {
//                    $follow = auth()->user()->following()->where('followed_id', $user->id)->first() ? "true" : "false";
//                    return Inertia::render('public/index', [
//                        'user'  =>  $user,
//                        'auth'  =>  User::with("profileImage")->find(auth()->user()->id),
//                        'follow'=>  $follow
//                    ]);
//                }
//            $follow = auth()->user()->following()->where('followed_id', $user->id)->first() ? "true" : "false";
//                return Inertia::render('public/index', [
//                    'user'  =>  $user,
//                    'auth'  =>  null,
//                    'follow'=>  false
//                ]);
//            dd("Not Auth");
//            }
//        }
//
//        return abort(404, "This user is not available");

        return view('profile.profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function follow(User $user): RedirectResponse
    {
        $user->followers()->attach(Auth::user());
        return redirect()->back();
    }

    public function unfollow(User $user): RedirectResponse
    {
        $user->followers()->detach(Auth::user());
        return redirect()->back();
    }
}
