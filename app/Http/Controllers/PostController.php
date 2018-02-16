<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Accesslevel;
use App\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=> ['index', 'show', 'all_public_posts']]);
    }
    
    public function index()
    {
        return view('home');
    }

    public function create()
    {
        // Not needed
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'title' => 'required|max:50',
           'message' => 'required|max:1000'
           ]);
           
        if(Auth::user()!=null)                                       // someone is logged in
        {
            $post= new Post;
            $post->user_id= Auth::id();
            $post->message= request('message');
            $post->title= request('title');
            $post->access_id= request('access');
            $post->save();
        }
        return redirect('/my_private_friends_public_posts');
    }

    public function show($id)
    {
        $comments= Comment::whereRaw('post_id=? ORDER BY id DESC', array($id)) ->get();
        $post= Post::find($id);
        
        if(!empty($post))
        {
            $post_user_name_ar= DB::select("Select name from users WHERE id=?", array($post->user_id));
            $post_user_name= $post_user_name_ar[0]->name;
            
            if (Auth::user()!=null)
            {
                return view('posts/view_comments_loggedin') ->with('id', $id) ->with('post', $post) ->with('comments', $comments) ->with('post_user_name', $post_user_name);
            } else {
                return view('posts/view_comments_loggedout') ->with('id', $id) ->with('post', $post) ->with('comments', $comments) ->with('post_user_name', $post_user_name);
            }
        }
        else {
            return redirect('/');
        }
    }

    public function edit($id)
    {
        $post= Post::find($id);
        $accesslevels= DB::select('Select * from accesslevels');
        
        return view('posts/edit_post') ->with('post', $post) ->with('id', $id) ->with('accesslevels', $accesslevels);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
           'title' => 'required|max:50',
           'message' => 'required|max:1000'
        ]);
           
        $post_id= request('id');
        $post= Post::find($post_id);
        $post_user_name_ar= DB::select("Select name from users WHERE id=?", array($post->user_id));
        $post_user_name= $post_user_name_ar[0]->name;
        
        $post->message= request('message');
        $post->title= request('title');
        $post->access_id= request('access');
        $post->save();
        
        $comments= DB::select('Select * from comments WHERE post_id=?', array($post_id));
        return view('posts/view_comments_loggedin') ->with('id', $post_id) ->with('post', $post) ->with('comments', $comments) ->with('post_user_name', $post_user_name);
    }

    public function destroy($id)
    {
        $comments= DB::select('Select * from comments WHERE post_id=?', array($id));
        $post= Post::find($id);
        Post::destroy($id);
        
        return redirect('/my_private_friends_public_posts');
    }
}
