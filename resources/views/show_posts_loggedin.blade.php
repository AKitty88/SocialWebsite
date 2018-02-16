@extends ('layouts/master')

@section ('title')
Meet@
@endsection

@section ('content')
<br><br><br>
<div class="row" id="content">
  <div class="col-sm-4" style="border:1px solid #CCC; font: 8pt 'Open Sans', Arial, sans-serif; color:#c0392b; background-color: #ecf0f1;">
    
    <form method="post" action="/post">    {{-- PostController@store --}}
      {{csrf_field()}}
      <br><br>
      <label> Title: </label><br> <input type= "text" name="title"> <br><br>
      <label> Message: </label><br> <textarea rows="7" cols="50" name="message"></textarea> <br><br>
      
      <label> Who do you want to see your post? </label>
      <p><select name="access">
            @foreach ($accesslevels as $accesslevel)
                <option value="{{$accesslevel->id}}">{{$accesslevel->accesslevel}} </option>
            @endforeach
          </select></p><br><br>
      
      <table width="100%">
        <tr>
          <td><input type="submit" value="Post"></td>
          <td><input type="reset" value="Reset"></td>
        </tr>
      </table><br><br><br>
    </form>
  </div>
    
  <div class="col-sm-8"  style="border:1px solid #CCC; font: 8pt 'Open Sans', Arial, sans-serif; background-color: #ecf0f1;">
    
  @unless (empty($posts))
    @foreach ($posts as $post)
      <div width="70%" id="myposts">
        <h1 class="postName">{{get_username($post->user_id)}} </h1>
        <h2 class="postTitle">{{$post->title}} </h2>
        <img src="{{url(get_image($post->user_id))}}" style= "height:50px">
        <p class="postMessage"> {{$post->message}} </p>
        <table>
          <tr>
            @php
              if(is_me($post->user_id))
              {
            @endphp
                <td><input type="button" value="Edit" onclick="window.location.href='post/{{$post->id}}/edit';"></td>
            <td>
              <form method="POST" action="/post/{{$post->id}}">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
                  <input type="submit" value="Delete">
              </form>
            </td>
            @php
              }
            @endphp
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

--}}