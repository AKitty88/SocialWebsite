@extends ('layouts/master')

@section ('title')
Users
@endsection

@section ('content')
<br><br><br>
<div class="row" id="content">
  <div class="col-sm-8"  style="border:1px solid #CCC; font: 8pt 'Open Sans', Arial, sans-serif; background-color: #ecf0f1;">
    
    @unless (empty($users))
      @foreach ($users as $user)
        <div width="70%" id="myposts">
          <h1 class="postName">{{$user->name}} </h1>
          <img src="{{url($user->image)}}" style= "height:100px"><br><br>
          <input type="button" value="Show profile" onclick="window.location.href='user/{{$user->id}}';"></td>
        </div> <br><br><br>
      @endforeach
    @endunless
  </div>
</div>
@endsection


{{--

--}}