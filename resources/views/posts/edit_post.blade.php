@extends ('layouts/master')

@section ('title')
   Edit post form
@endsection

@section ('content')
<br><br><br>
<div class="row" id="content">
  <div class="col-sm-3" style="border:1px solid #CCC; font: 8pt 'Open Sans', Arial, sans-serif; margin: 20px; padding: 20px; color:#c0392b; background-color: #ecf0f1;">
    <br><br><h1>Edit post</h1><br>
    
    <form method="POST" action="/post/{{$id}}">          {{-- PostController@update --}}
      {{csrf_field()}}
      {{ method_field('PUT') }}
      <p> 
        <label>Title:</label>
        <input type="text" name="title" value="{{$post->title}}"> 
      </p>
      <p>
        <label>Message:</label>
        <textarea rows="7" name="message">{{$post->message}}</textarea>
      </p>
      <label> Who do you want to see your post? </label>
      <p><select name="access">
            @foreach ($accesslevels as $accesslevel)
                @if ($accesslevel->id === $post->access_id)
                    <option value="{{$accesslevel->id}}" selected="selected"> {{$accesslevel->accesslevel}} </option>
                @else
                    <option value="{{$accesslevel->id}}">{{$accesslevel->accesslevel}} </option>
                @endif
            @endforeach
        </select>
      </p>
      <input type="hidden" name="id" value={{$id}}>
      
      <table width="100%">
        <tr>
          <td><input type="submit" value="Save"></td>
          <td><input type="button" value="Cancel" onclick="window.location.href='/my_private_friends_public_posts';"></td>
        </tr>
      </table>
    </form><br><br><br>
  </div>
</div>
@endsection
