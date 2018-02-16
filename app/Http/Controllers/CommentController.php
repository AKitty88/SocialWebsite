<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // Not needed
    }

    public function create()
    {
        // Not needed
    }

    public function store(Request $request)
    {
        $this->validate($request, [
           'comment' => 'required|max:1000',
           'id' => 'required|numeric|min:0|exists:posts,id'
           ]);
           
        $post_id= request('id');
        
        $comment= new Comment;
        $comment->user_id= Auth::id();
        $comment->comment= request('comment');
        $comment->post_id= $post_id;
        $comment->save();

        return redirect()->action('PostController@show', $comment->post_id);
    }

    public function show($id)
    {
        // Not needed
    }

    public function edit($id)
    {
        // Not needed
    }

    public function update(Request $request, $id)
    {
        // Not needed
    }

    public function destroy($id)
    {
        $comment= Comment::find($id);
        $post_id= $comment->post_id;
        $post= Post::find($post_id);
        $post_user_name_ar= DB::select("Select name from users WHERE id=?", array($post->user_id));
        $post_user_name= $post_user_name_ar[0]->name;
        
        Comment::destroy($id);
        $comments= get_comments($post_id);
        
        return view('posts/view_comments_loggedin') ->with('id', $post_id) ->with('post', $post) ->with('comments', $comments) ->with('post_user_name', $post_user_name);
    }
}
