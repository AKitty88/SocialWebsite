@extends ('layouts/master')

@section ('title')
   View comments
@endsection

@section ('content')
  <br><br><br>
  <div class="row" id="content" style="margin: 20px; padding: 20px;" >
    <div class="col-sm-3" style="border:1px solid #CCC; font: 8pt 'Open Sans', Arial, sans-serif; color:#c0392b; background-color: #ecf0f1;">
      <br><br>
      <h2>New comment</h2><br><br>
  
      <form method="post" action="/comment">    {{-- CommentController@store --}}
        {{csrf_field()}}
        <p> 
          <label>Comment:</label> 
          <input type="text" name="comment"> 
        </p>
        <input type="hidden" name="id" value={{$id}}>
        
        <table width="100%">
        <tr>
          <td><input type="submit" value="Save"></td>
          <td><input type="button" value="Cancel" onclick="window.location.href='/my_private_friends_public_posts';"></td>
        </tr>
      </table>
      </form><br><br>
    </div>
    <div class="col-sm-8"  style="border:1px solid #CCC; font: 8pt 'Open Sans', Arial, sans-serif; background-color: #ecf0f1;"><br><br>
      <div width="100%" id="myposts">
        <h1 class="postName">{{$post_user_name}} </h1>
        <h2 class="postTitle">{{$post->title}} </h2>
        <img src="{{url(get_image($post->user_id))}}" style= "height:50px">
        <p class="postMessage"> {{$post->message}} </p>
      </div><br><br><br><br>
      
      @foreach ($comments as $comment)
      <div width="100%" id="mycomments">
        <p>{{get_username($comment->user_id)}}'s comment: <br></p>
        <p>{{$comment->comment}}</p>
        @php
          if(is_me($comment->user_id))
          {
        @endphp
        <p><form method="post" action="/comment/{{$comment->id}}">
            {{csrf_field()}}
            {{ method_field('DELETE') }}
            <input type="submit" value="Delete"<br>
        </form></p>
        @php
          }
        @endphp
      </div>
      @endforeach
  </div>
@endsection