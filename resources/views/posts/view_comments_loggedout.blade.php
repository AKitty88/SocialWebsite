@extends ('layouts/master')

@section ('title')
   View comments
@endsection

@section ('content')
  <br><br><br>
  <div class="row" id="content" style="margin: 20px; padding: 20px;" >
    <div class="col-sm-8"  style="border:1px solid #CCC; font: 8pt 'Open Sans', Arial, sans-serif; background-color: #ecf0f1;"><br><br>
      <div width="100%" id="myposts">
        <h1 class="postName">{{$post_user_name}} </h1>
        <h2 class="postTitle">{{$post->title}} </h2>
        <img src="{{url(get_image($post->user_id))}}" style= "height:50px">
        <p class="postMessage"> {{$post->message}} </p>
      </div> <br><br>
      
      @foreach ($comments as $comment)
        <table width="100%" id="mycomments">
          <tr>
            <td>{{get_username($comment->user_id)}}'s comment: <br></td>
          </tr>
          <tr>
            <td>{{$comment->comment}} <br><br></td>
          </tr>
        </table><br><br>
      @endforeach
    </div>
  </div>
@endsection