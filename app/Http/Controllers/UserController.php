<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=> ['index', 'show']]);
    }
    
    public function index()
    {
        $users= User::all();
        
        if (!empty($users))
        {
            return view('user/all_user') ->with ('users', $users);
        } else {
            return redirect()->action('PostController@index');
        }
        
    }

    public function create()
    {
        // Not needed
    }

    public function store(Request $request)
    {
        // Not needed
    }

    public function show($id)
    {
        $user_id= $id;
        $user= User::find($user_id);
        
        if(Auth::id() != 0 && Auth::id() != $user_id && is_friend($user_id))                                                                                // My friend
        {
            $posts= DB::select("Select * from posts WHERE user_id=? AND (access_id=? OR access_id=?) ORDER BY (updated_at) DESC", array($user_id, 2, 3));
            return view('user/user_profile_loggedin_friends') ->with ('user', $user) ->with ('posts', $posts);
        }
        
        else if (Auth::id() != 0 && Auth::id() == $user_id)                                                                                                 // Me
        {
            $posts= DB::select("Select * from posts WHERE user_id=? ORDER BY (updated_at) DESC", array($user_id));
            return view('user/user_profile_loggedin_me') ->with ('user', $user) ->with ('posts', $posts);
        }
        
        else if (Auth::id() != 0 && Auth::id() != $user_id && !is_friend($user_id))                                                                         // Not friend
        {
            $posts= DB::select("Select * from posts WHERE user_id=? AND access_id=? ORDER BY (updated_at) DESC", array($user_id, 3));
            return view('user/user_profile_loggedin_notfriends') ->with ('user', $user) ->with ('posts', $posts);
        }
        
        else if (Auth::id() == 0)                                                                                                                           // Logged out
        {
            $posts= DB::select("Select * from posts WHERE user_id=? AND access_id=? ORDER BY (updated_at) DESC", array($user_id, 3));
            return view('user/user_profile_loggedout') ->with ('user', $user) ->with ('posts', $posts);
        }
    }

    public function edit($id)
    {
        // Not needed
    }

    public function update(Request $request, $id)
    {
        // Later
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->action('PostController@index');
    }
}
