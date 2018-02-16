@extends ('layouts/master')

@section ('title')
Meet@
@endsection

@section ('content')
<br><br><br>
<div class="row" id="content">
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