<?php

use App\Post;
use App\Comment;
use App\User;
use App\Friendship;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::resource('post', 'PostController');
Route::resource('comment', 'CommentController');
Route::resource('user', 'UserController');

Route::get('/', 'PostController@index')->name('home');
Auth::routes();


Route::get('/user/add_friend/{id}', 'UserController@add_friend');
Route::get('/user/add_friend/{id}', function($id)
{
    $loggedin_user_id= Auth::id();
    $shown_user= (int)$id;
    
    $primary_key= DB::select('Select id
                              From friendships
                              WHERE user_id_A=? AND user_id_B=?
                              UNION
                              Select id
                              From friendships
                              WHERE user_id_B=? AND user_id_A=?', array($loggedin_user_id, $shown_user, $shown_user, $loggedin_user_id));
    
    if(empty($primary_key))
    {
        $friendship= new Friendship;
        $friendship->user_id_A= Auth::id();
        $friendship->user_id_B= $id;
        $friendship->save();
    }
    return redirect()->action('UserController@show', $id);
});


Route::get('/user/remove_friend/{id}', 'UserController@remove_friend');
Route::get('/user/remove_friend/{id}', function($id)
{
    $loggedin_user_id= Auth::id();
    $shown_user= (int)$id;
    
    $primary_k= DB::select('Select id
                            From friendships
                            WHERE user_id_A=? AND user_id_B=?
                            UNION
                            Select id
                            From friendships
                            WHERE user_id_B=? AND user_id_A=?', array($loggedin_user_id, $shown_user, $shown_user, $loggedin_user_id));
    
    if (!empty($primary_k))
    {
        $primary_key= $primary_k[0]->id;
        Friendship::destroy($primary_key);
    }
    return redirect()->action('UserController@index');
});


Route::get('/all_public_posts', 'PostController@all_public_posts');
Route::get('/all_public_posts', function()
{
    $posts= DB::select('Select * From posts WHERE access_id=? ORDER BY updated_at DESC', array(3));
    $accesslevels= DB::select('Select * from accesslevels');
    
    if (!empty($posts))
    {
        return view('show_posts_loggedout') ->with('posts', $posts) ->with('accesslevels', $accesslevels);
    } else {
        return view('no_posts');
    }
});


Route::get('/my_private_friends_public_posts', 'PostController@my_private_friends_public_posts');
Route::get('/my_private_friends_public_posts', function()
{
    $accesslevels= DB::select('Select * From accesslevels');
    $loggedin_user_id= Auth::id();
    $posts= new Collection;
    
    $public_posts= DB::select('Select * From posts WHERE access_id=? ORDER BY updated_at DESC', array(3));

    $users_db_arr= DB::select('Select *
                               From friendships
                               WHERE user_id_A=? OR
                               user_id_B=?', array($loggedin_user_id, $loggedin_user_id));
    
    if(!empty($users_db_arr))
    {
        $user_ids= array();                                                                                                         // collects friends' ids
        
        foreach($users_db_arr as $user)
        {
            if($user->user_id_B != $loggedin_user_id)
            {
                $user_ids[]= $user->user_id_B;
            } 
            else if($user->user_id_A != $loggedin_user_id) 
            {
                $user_ids[]= $user->user_id_A;
            }
        }
        $friend_posts= array();
        
        for ($i=0; $i <= count($user_ids)-1; $i++)
        {
            $friend_posts_arr= DB::select('Select * From posts WHERE user_id=? AND access_id=? ORDER BY updated_at DESC', array($user_ids[$i], 2));
            $friend_posts[]= $friend_posts_arr[count($friend_posts_arr)-1];
        }
    }
    
    if (!empty($friend_posts))
    {
        foreach ($friend_posts as $friend_post)
        {
            $posts->add($friend_post);
        }
    }
    
    $private_posts= DB::select('Select * From posts WHERE user_id=? AND (access_id=? OR access_id=?) ORDER BY updated_at DESC', array($loggedin_user_id, 1, 2));
    
    if (!empty($public_posts))
    {
        foreach ($public_posts as $public_post)
        {
            $posts->add($public_post);
        }
    }
    
    if (!empty($private_posts))
    {
        foreach ($private_posts as $private_post)
        {
            $posts->add($private_post);
        }
    }
    $posts= $posts->sortByDesc('updated_at');
    
    if (!empty($posts))
    {
        return view('show_posts_loggedin') ->with('posts', $posts) ->with('accesslevels', $accesslevels);
    } else {
        return view('no_posts');
    }
});


Route::get('/show_friends', 'UserController@show_friends');
Route::get('/show_friends', function()
{
    $loggedin_user_id= Auth::id();
    
    $friendships= DB::select('Select *
                          From friendships
                          WHERE user_id_A=? OR
                          user_id_B=?', array($loggedin_user_id, $loggedin_user_id));
    $users= array();
    
    if(!empty($friendships))
    {
        $friend_ids= array();                                                                                                         // collects friends' ids
        
        foreach($friendships as $friend)
        {
            if($friend->user_id_B != $loggedin_user_id)
            {
                $friend_ids[]= $friend->user_id_B;
            } 
            else if($friend->user_id_A != $loggedin_user_id) 
            {
                $friend_ids[]= $friend->user_id_A;
            }
        }
    
        for ($i=0; $i <= count($friend_ids)-1; $i++)
        {
            $users_arr= DB::select('Select * from users WHERE id=? ORDER BY (updated_at) DESC', array($friend_ids[$i]));
            $users[]= $users_arr[count($users_arr)-1];
        }
    }
    
    if (!empty($users))
    {
        return view('user/all_user') ->with ('users', $users);
    } else {
        return view('user/no_friends');
    }
});


Route::post('/user/change_image/{id}', 'UserController@change_image');
Route::post('/user/change_image/{id}', function($id)
{
    $image_store= request()->file('image')->store('profile_images', 'public');
    $user= User::find($id);
    $user->image= $image_store;
    $user->save();
    
    return redirect()->action('UserController@show', $id);
});


// --------------


function get_comments($id)
{
    $comments= Comment::whereRaw('post_id=? ORDER BY id DESC', array($id))->get();
    return $comments;
}


function get_username($user_id)
{
    $user_name_ar= DB::select("Select name from users WHERE id=?", array($user_id));
    
    if(!empty($user_name_ar))
    {
        $user_name= $user_name_ar[0]->name;
        return $user_name;
    } else {
        return "Deleted user";
    }
}


function is_friend($shown_user)
{
    $loggedin_user_id= Auth::id();

    $primary_key= DB::select('Select id
                              From friendships
                              WHERE user_id_A=? AND user_id_B=?
                              UNION
                              Select id
                              From friendships
                              WHERE user_id_B=? AND user_id_A=?', array($loggedin_user_id, $shown_user, $shown_user, $loggedin_user_id));
    
    if(empty($primary_key))
    {
        return 0;
    } else {
        return 1;
    }
}


function is_me($user_id)
{
    $loggedin_user_id= Auth::id();

    if($loggedin_user_id != $user_id)
    {
        return 0;
    } else {
        return 1;
    }
}

function get_image($user_id)
{
    $user= User::find($user_id);
    return $user->image;
}

?>

