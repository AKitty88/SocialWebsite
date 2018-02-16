@extends ('layouts/master')

@section ('title')
Profile
@endsection

@section ('content')
<br><br><br>
<div class="row" id="content">
  <div class="col-sm-8"  style="border:1px solid #CCC; font: 8pt 'Open Sans', Arial, sans-serif; background-color: #ecf0f1;">
    
    @unless (empty($user))
        <div width="70%" id="myposts">
          <h1 class="postName">{{$user->name}} </h1><br><br><br>
          <img src="{{url($user->image)}}" style= "height:450px"><br><br><br>
          <table>
            <tr>
              <td>
                <form method="POST" action="/user/change_image/{{$user->id}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" name="image">
                    <input type="submit" value="Upload new profile picture">
                </form><br><br>
              </td>
            </tr>
            <tr>
              <td>
                <form method="POST" action="/user/{{$user->id}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" value="Delete my profile">
                </form>
              </td>
            </tr>
          </table>
        </div> <br><br><br>
    @endunless
    
    @unless (empty($posts))
      @foreach ($posts as $post)
        <div width="70%" id="myposts">
          <h2 class="postTitle">{{$post->title}} </h2>
          <img src="{{url($user->image)}}" style= "height:50px">
          <p class="postMessage"> {{$post->message}} </p>
          <table>
            <tr>
              <td><input type="button" value="Edit" onclick="window.location.href='post/{{$post->id}}/edit';"></td>
              
              <td>
                <form method="POST" action="/post/{{$post->id}}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" value="Delete">
                </form>
              </td>
              <td><input type="button" value="View comments: {{count(get_comments($post->id))}}" onclick="window.location.href='/post/{{$post->id}}';"></td>
            </tr>
          </table>
        </div> <br><br><br>
      @endforeach
    @endunless
  </div>
</div>
@endsection


{{--

add image upload form !!!

--}}